<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider
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
//        $this->langPath = resource_path( 'lang/'. App::getLocale() );
////        Log::info(print_r(App::getLocale(),true));
//        Log::info(print_r(session()->get('locale'),true));
//        Cache::rememberForever( 'translations', function () {
//            return collect( File::allFiles( $this->langPath ) )->flatMap( function ( $file ) {
//                return [
//                    $translation = $file->getBasename( '.php' ) => trans( $translation ),
//                ];
//            } )->toJson();
//        } );
    }
}
