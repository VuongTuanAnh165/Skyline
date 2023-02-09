<?php

namespace App\Providers\Admin;

use App\Models\Ceo;
use App\Models\Policy;
use App\Models\Promotion;
use App\Models\Restaurant;
use App\Models\Service;
use App\Models\ServiceGroup;
use App\Models\Skyline;
use Carbon\Carbon;
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
        View::composer('admin.be.layouts.aside', function ($view) {
            $admin = Auth::guard('admin')->user();
            return $view->with([
                'admin' => $admin,
            ]);
        });

        View::composer('admin.fe.layouts.header', function ($view) {
            $service_groups = ServiceGroup::all();
            $policys = Policy::all();
            $promotions = Promotion::whereDate('ended_at', '>=', Carbon::today())->get();
            $ceo = Auth::guard('ceo')->user();
            $skyline = Skyline::first();
            return $view->with([
                'service_groups' => $service_groups,
                'policys' => $policys,
                'promotions' => $promotions,
                'ceo' => $ceo,
                'skyline' => $skyline,
            ]);
        });

        View::composer('admin.fe.layouts.footer', function ($view) {
            $services = Service::all();
            return $view->with([
                'services' => $services,
            ]);
        });

        View::composer('admin.fe.layouts.near_footer', function ($view) {
            $ceos = Ceo::all();
            return $view->with([
                'ceos' => $ceos,
            ]);
        });
    }
}
