<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use App\Support\Aramex\Aramex;
use App\Support\Aramex\Aramex as AramexClass;
use App\Support\JsonResponder;
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
        $this->app->singleton('responder', fn ($app) => new JsonResponder());

//        $this->app->singleton(Aramex::class, fn () =>new AramexClass() );


        view()->composer('admin.settings.*', function ($view) {

            $setting = new Setting();

            $view->with(compact('setting'));
        });

        view()->composer('website.layouts.*', function ($view) {

            $mainCategories = Category::whereIsSuspended(0)->whereNull('parent_id')->take(3)->get(['id']);

            $setting = Setting::all()->mapWithKeys(fn($set) => [$set['key'] => $set['body']]);

            $view->with(compact('mainCategories','setting'));
        });
    }
}
