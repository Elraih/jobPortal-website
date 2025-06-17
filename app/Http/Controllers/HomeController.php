<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->query('search');
        $page = $request->query('page');

        $users = User::query()
            ->when($search, fn($q) => $q->where('email', 'like', "%" . $search ."%"))
            ->paginate(2)
            ->appends(['search' => $search]);
        
        if($page > $users->lastPage()){
            return Inertia::location(route('users.index', ['page' => $users->lastPage()]));
        }
        // dd($request->query());
        
        return Inertia::render('home', [
            'users' => $users,
        ]);
    }
}
