<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            //
            'auth' => function() use($request){
                return 
                [
                    'logo' => fn () => $request->user()?->role == 'company' ? $request->user()?->companyProfile?->logo : '',
                    'user' => fn () => $request->user()?->role == 'job_seeker' ? $request->user() : '',
                    'company' => fn () => $request->user()?->role == 'company' ? $request->user() : '',
                    'admin' => fn () => $request->user()?->role == 'admin' ? $request->user() : '',
                    'avatar' => fn () => $request->user()?->role == 'job_seeker' ? $request->user()?->userProfile?->avatar : '',
                ];
            },
            'flash' => function(){
               return [
                'error' => Session::get('error'),
                'success'=> Session::get('success'),
               ];

            },
        ];
    }
}
