<?php

namespace App\Providers\User;

use App\Models\Branch;
use App\Models\Ceo;
use App\Models\Restaurant;
use App\Models\Skyline;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ComposerUserProvider extends ServiceProvider
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
        View::composer('user.layouts.footer', function ($view) {
            $skyline = Skyline::first();
            return $view->with([
                'skyline' => $skyline,
            ]);
        });
    }
}
