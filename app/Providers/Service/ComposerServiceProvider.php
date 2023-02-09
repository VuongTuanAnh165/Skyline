<?php

namespace App\Providers\Service;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
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
        View::composer('restaurant.ceo.layouts.aside', function ($view) {
            $ceo = Auth::guard('ceo')->user();
            return $view->with([
                'ceo' => $ceo,
            ]);
        });
    }
}
