<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Property' => 'App\Policies\PropertyPolicy',
    ];


    // app/Providers/AuthServiceProvider.php



    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
