<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class LocaleServiceProvider extends ServiceProvider
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
        $this->setRouteLang();
    }

    public function setRouteLang ()
    {
        $lang = Request::segment(1);
        $language = '';

        if ( isset(config('app.locales')[$lang]) ):
            App::setLocale($lang);
            $language = $lang;
        else:
            App::setLocale('uz');
            $language = 'uz';
        endif;

        Config::set('language', $language);    
    }
}
