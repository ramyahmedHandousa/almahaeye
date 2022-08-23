<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ChangeLangController extends Controller
{
    public function __invoke($locale)
    {
        Artisan::call('cache:clear');
        Cache::forget('translations');
        session()->put('locale', $locale);

        app()->setLocale($locale);

        $this->langPath = resource_path( 'lang/'. App::getLocale() );
        Cache::rememberForever( 'translations', function () {
            return collect( File::allFiles( $this->langPath ) )->flatMap( function ( $file ) {
                return [
                    $translation = $file->getBasename( '.php' ) => trans( $translation ),
                ];
            } )->toJson();
        } );

        return redirect()->back();
    }
}
