<?php

namespace App\Providers;

use App\Events\JobPostDeleted;
use App\Listeners\DeleteResumes;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ProvidersEventServiceProvider;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ProvidersEventServiceProvider
{

    protected $listen = [
        JobPostDeleted::class => [
            DeleteResumes::class,
        ],
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
