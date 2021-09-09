<?php

namespace App\Providers;

use _PHPStan_0ebfea013\Nette\Neon\Exception;
use App\Auth\CacheUserProvider;
use App\Auth\JwtGuard;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<string, string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('jwt', function ($app, $name, array $config) {
            // TODO[Gabriel Menezes](2021-47-05): change exception
            $provider = Auth::createUserProvider($config['provider']) ?? throw new Exception("Something went wrong");
            return new JwtGuard($provider, $app->request);
        });

        Auth::provider('cache-user', function() {
            return resolve(CacheUserProvider::class);
        });
    }
}
