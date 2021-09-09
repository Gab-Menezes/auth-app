<?php

namespace App\Providers;

use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\PermissionRegistrar;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if ($this->app->isLocal()) {
//            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
//            $this->app->register(TelescopeServiceProvider::class);
//        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws FileNotFoundException if file not found
     */
    public function boot()
    {
        Model::preventLazyLoading($this->app->isLocal());

        Cache::forever('token_key', Storage::get(env('TOKEN_KEY')));
        Cache::forever('public_token_key', Storage::get(env('PUBLIC_TOKEN_KEY')));
        Cache::forever('refresh_token_key', Storage::get(env('TOKEN_KEY')));
        Cache::forever('public_refresh_token_key', Storage::get(env('PUBLIC_TOKEN_KEY')));
    }
}
