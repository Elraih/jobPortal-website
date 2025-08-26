<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\User;
use App\Notifications\VerifyEmail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Throwable;

class RegisterController extends Controller
{

    // show register company form page 
    public function registerAsCompany()
    {

        return Inertia::render('Auth/RegisterCompany');
    }

    // show register jobseeker form page 
    public function registerAsJobSeeker()
    {
        return Inertia::render('Auth/RegisterJobSeeker');
    }


    // store company data 
    public function storeAsCompany(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'phone' => ['required'],
            'password' => ['required', 'confirmed']
        ]);

        DB::beginTransaction();
        try {

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => UserRoles::Company,
            ]);

            $user->companyProfile()->create([
                'name' => $request->name,
            ]);

            $user->contactInfo()->create([
                'phone' => $request->phone,
            ]);

            DB::commit();

            Auth::login($user);

            // send notification to db and email after regstration 
            $user->notify(new VerifyEmail($user));

            return redirect()->route('verification.notice')->with('success', 'your account has been created');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }

    // store jobseeker data 
    public function storeAsJobSeeker(Request $request)
    {


        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
        ]);


        DB::beginTransaction();
        try {

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => UserRoles::JobSeeker,
            ]);


            $user->userProfile()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);

            $user->contactInfo()->create([
                'phone' => $request->phone,
            ]);

            DB::commit();
            Auth::login($user);

            // send notification to db and email after jobseeker register 
            $user->notify(new VerifyEmail($user));

            return redirect()->route('verification.notice')->with('success', 'your account has been created');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }
}
