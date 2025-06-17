<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ContactController extends Controller
{



    public function create()
    {

        return Inertia::render('contact');
    }
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => ['required'],
        ]);

        if($validate->fails()){
        return redirect()->back()->withErrors($validate);
        }

        return redirect()->to('/');
    }
}
