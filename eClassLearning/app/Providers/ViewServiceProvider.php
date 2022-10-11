<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MainCategory;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('includes.header', function ($mainCategories) {
            $mainCategories->with('mainCategories', MainCategory::all());
        });


        View::composer('includes.header', function ($role) {
            // Check User Logged In
            if(Auth::check()){
                $userRole = Auth::user()->role;
            }else{
                $userRole = "guest";
            }

            $role->with('role', $userRole);
        });
    }
}
