<?php

namespace App\Providers;

use Exception;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Cache::macro('getOrThrow', function(string $key) {
        //     return $this->get($key, function() {
        //         throw new Exception('Key not found.');
        //     });
        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
