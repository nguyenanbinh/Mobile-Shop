<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $listShare = [
            'categories' => \App\Models\Category::all(),
            'test' => '123',
        ];

        $categories = \App\Models\Category::all();
        View::share(compact('categories', 'listShare'));
    }
}
