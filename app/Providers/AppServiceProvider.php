<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (!isset($view->getData()['settings'])) {
                try {
                    $view->with('settings', Setting::allKeyed());
                } catch (\Throwable) {
                    $view->with('settings', []);
                }
            }
        });
    }
}
