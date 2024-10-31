<?php

namespace App\Providers;

use App\Contracts\VoiceMail;
use App\Repositories\VoiceMailRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        VoiceMail::class => VoiceMailRepository::class
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Str::contains(Config::get('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);
    }
}
