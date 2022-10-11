<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::define('isTeacher', function($user){            
            foreach($user->roles as $role)
            {                
            }
            return $role->id == 2;
        });

        Gate::define('isTeacherOnDuty', function($user){
            foreach($user->roles as $role)
            {                
            }
            return $role->id == 3;
        });

        Gate::define('isHeadTeacher', function($user){
            foreach($user->roles as $role)
            {                
            }
            return $role->id == 4;
        });

        Gate::define('isWardOfficer', function($user){
            foreach($user->roles as $role)
            {                
            }
            return $role->id == 5;
        });

        Gate::define('isDistrictOfficer', function($user){
            foreach($user->roles as $role)
            {                
            }
            return $role->id == 6;
        });
        
        Gate::define('isAdmin', function($user){
            foreach($user->roles as $role)
            {                
            }
            return $role->id == 1;
        });


    }
}
