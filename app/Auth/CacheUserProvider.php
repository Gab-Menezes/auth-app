<?php

namespace App\Auth;

use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Support\Facades\Cache;

class CacheUserProvider extends EloquentUserProvider
{
    public function __construct(HasherContract $hasher)
    {
        parent::__construct($hasher, User::class);
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        return Cache::get("user.$identifier") ?? parent::retrieveById($identifier);
    }
}
