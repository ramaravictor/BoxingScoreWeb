<?php

namespace App\Providers;

use App\Models\Room;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $rooms = Room::where('availability', true)->get();
            $view->with('rooms', $rooms);
        });
    }
}
