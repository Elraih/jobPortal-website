<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Throwable;

class RegisterController extends Controller
{
    public function registerAsCompany(){
        return Inertia::render('Auth/RegisterCompany');

    }
    public function registerAsJobSeeker(){
        return Inertia::render('Auth/RegisterJobSeeker');

    }

    public function storeAsCompany(Request $request){

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'password' => ['required', 'confirmed'] 
        ]);

        DB::beginTransaction();
        try{

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $c = CompanyProfile::create([
                'user_id' => $user->id,
                'name' => $request->name,
            ]);

            $user->contactInfo()->create([
                'phone' => $request->phone,
            ]);
        
            DB::commit();
        }catch(Throwable $e){
            DB::rollBack();
            dd($e);
        }
    }

    public function storeAsJobSeeker(Request $request){
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'confirmed'],
            
        ]);
    }
}
