<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        RateLimiter::for('global', function ($request) {
            // return Limit::perMinute(1)->by(optional($request->user())->id ?: $request->ip()); // pembatasan request dalam 1 menit hanya 10 kali request
            // return Limit::perSecond(1)->by(optional($request->user())->id ?: $request->ip()); // pembatasan request dalam 1 detik hanya 1 kali request
        });
    }
}
