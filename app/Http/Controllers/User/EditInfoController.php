<?php

namespace App\Http\Controllers\User;

use App\Helpers\uploadedFilesHelper;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Throwable;

class EditInfoController extends Controller
{

    // show edit user info page 
    public function editInfo(User $user)
    {

        Gate::authorize('update', $user);

        $user->load(['userProfile', 'resume', 'contactInfo', 'location.governorate']);
        $governorates = Governorate::all();
        return Inertia::render(
            'User/Profile/EditInfo',
            [
                'user' => $user,
                'governorates' => $governorates
            ]
        );
    }


    // update user info 
    public function updateInfo(Request $request, User $user)
    {

        $validation = $request->validate([

            'first_name' => ['required', 'string', 'min:2', 'max:20'],
            'last_name' => ['required', 'string', 'min:2', 'max:20'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required'],
            'governorate_id' => ['required', 'exists:governorates,id'],
            'address' => ['required'],
            'website' => ['nullable', 'url', "unique:contact_infos,website,{$user->id},user_id"],
            'phone' => ['required', "unique:contact_infos,phone,{$user->id},user_id"],
            'linkedin' => ['nullable', 'url', "unique:contact_infos,linkedIn,{$user->id},user_id"],
            'about_me' => ['nullable', 'string', 'min:20', 'max:500'],
            'resume' => ['nullable', 'file', 'mimes:pdf,docx', 'max:2048'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
        ]);



        $oldAvatar = $user->userProfile->avatar ?? null;
        $oldResume = $user->resume->resume ?? null;
        $newAvatar = null;
        $newResume = null;

        if ($request->hasFile('avatar')) {
            $newAvatar = uploadedFilesHelper::handleFile($request->file('avatar'));
        }

        if ($request->hasFile('resume')) {
            $newResume = uploadedFilesHelper::handleFile($request->file('resume'));
        }

        DB::beginTransaction();
        try {

            $user->userProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'avatar' =>  $newAvatar ?? $oldAvatar,
                    'first_name' => $validation['first_name'],
                    'last_name' => $validation['last_name'],
                    'gender' => $validation['gender'],
                    'date_of_birth' => $validation['date_of_birth'],
                    'about_me' => $validation['about_me'],
                ]
            );

            $user->resume()->updateOrCreate(
                ['user_id' => $user->id],
                ['resume' => $newResume ?? $oldResume,]
            );

            $user->location()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'governorate_id' => $validation['governorate_id'],
                    'address' => $validation['address'],
                ]
            );

            $user->contactInfo()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone' => $validation['phone'],
                    'website' => $validation['website'],
                    'linkedin' => $validation['linkedin'],
                ]
            );

            DB::commit();

            if ($newResume && $oldResume && Storage::disk('public')->exists($oldResume)) {
                Storage::disk('public')->delete($oldResume);
            }

            if ($newAvatar && $oldAvatar && Storage::disk('public')->exists($oldAvatar)) {
                Storage::disk('public')->delete($oldAvatar);
            }

            return redirect()->route('user.profile.show', $user)->with('success', 'your profile has been updated');
        } catch (Throwable $e) {
            DB::rollBack();

            if ($newAvatar && Storage::disk('public')->exists($newAvatar)) {

                Storage::disk('public')->delete($newAvatar);
            }

            if ($newResume && Storage::disk('public')->exists($newResume)) {

                Storage::disk('public')->delete($newResume);
            }

            return redirect()->back()->with('error', 'something went wrong');
        }
    }

    // delete avatar image from database
    public function deleteAvatar(User $user)
    {

        $userProfile = $user->userProfile;


        if ($userProfile && $userProfile->avatar && Storage::disk('public')->exists($userProfile->avatar)) {
            Storage::disk('public')->delete($userProfile->avatar);
        }

        if ($userProfile) {
            $userProfile->update(['avatar' => null]);
        }
    }
}
