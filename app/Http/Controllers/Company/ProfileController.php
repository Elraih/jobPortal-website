<?php

namespace App\Http\Controllers\Company;

use App\Enums\CompanySize;
use App\Helpers\uploadedFilesHelper;
use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Governorate;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;
use Throwable;

use function PHPUnit\Framework\fileExists;

class ProfileController extends Controller
{
    public function show(User $user){

        // Gate::authorize("view", $user);

        $user->load(['contactInfo', 'companyProfile', 'location.governorate']);
        
        $jobPosts = $user->jobPosts()
        ->with([
            'jobType:id,job_type',
            'jobCategory:id,name',
            'governorate:id,name',
        ])
        ->withCount('jobApplications') // optional
        ->latest()
        ->paginate(3);

        return Inertia::render('Company/Profile/Show',
        [
            'user' => $user,
            'jobPosts' => $jobPosts,
            
        ]
    );
    }

    public function edit(User $user){

        // dd(Storage::url($user->companyProfile->logo));

        $user->load(['contactInfo', 'companyProfile', 'location.governorate']);
        // dd($user->companyProfile->company_size);

        $governorates = Governorate::all();

        $companySize = CompanySize::keyValue();
        
        return Inertia::render('Company/Profile/Edit', 
    [
        'user' => $user,
        'governorates' => $governorates,
        'companySize' => $companySize,
    ]
    );
    }

    public function update(Request $request, User $user){

        // dd($request->company_size);

        $validated = $request->validate([
            'logo'=> ['nullable', 'image', 'mimes:png,jpg', 'max:2024'],
            'name'=> ['required'],
            'industry' => ['required'],
            'website' => ['required'],
            'about_us' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'governorate_id' => ['required'],
            'linkedin' => ['required'],
            'company_size' => ['nullable', new Enum(CompanySize::class)]
        ]);



        $newLogo = null;
        $oldLogo = $user->companyProfile->logo ?? null;

        if($request->hasFile('logo')){

            $newLogo = uploadedFilesHelper::handleFile($request->file('logo'));
        }


        DB::beginTransaction();
        try{

            $user->companyProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
            'name'=> $validated['name'],
            'about_us'=> $validated['about_us'],
            'industry'=> $validated['industry'],
            'company_size'=> $validated['company_size'],
            'logo'=> $newLogo ?? $oldLogo,
            ]
        );

            $user->contactInfo()->updateOrCreate(
            ['user_id' => $user->id],
            [
            'phone'=> $validated['phone'],
            'website'=> $validated['website'],
            'linkedin'=> $validated['linkedin'],
            ]
        );

            $user->location()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'address'=> $validated['address'],
                    'governorate_id'=> $validated['governorate_id'],
                ]
        );

            DB::commit();

            if($oldLogo && $newLogo && Storage::disk('public')->exists($oldLogo)){
                Storage::disk('public')->delete($oldLogo);
            }

        return redirect()->route('company.profile.show', $user)->with('success','your profile updated');

        }catch(Throwable $e){
            DB::rollBack();

            if($newLogo && Storage::disk('public')->exists($newLogo)){
                Storage::disk('public')->delete($newLogo);
            }

            dd($e);

            return redirect()->route('company.profile.show', $user)->with('error','something went wrong');
        }


    }


     public function deleteLogo(User $user)
    {
        $companyProfile = $user->companyProfile; // singular, the profile instance


        if ($companyProfile && $companyProfile->logo && Storage::disk('public')->exists($companyProfile->logo)) {
            Storage::disk('public')->delete($companyProfile->logo);
        }

        if ($companyProfile) {
            $companyProfile->update(['logo' => null]);
        }
    }

}
