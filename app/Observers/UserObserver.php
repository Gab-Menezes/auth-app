<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    private int $ttl = 15*60;
    /**
     * Handle the User "saved" event.
     *
     * @param User $user
     * @return void
     */
    public function saved(User $user)
    {
        Cache::put("user.$user->id", $user, $this->ttl);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user)
    {
        Cache::put("user.$user->id", $user, $this->ttl);
    }

    /**
     * Handle the User "retrieved" event.
     *
     * @param User $user
     * @return void
     */
    public function retrieved(User $user)
    {
        Cache::add("user.$user->id", $user, $this->ttl);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        Cache::forget("user.$user->id");
    }


    /**
     * Handle the User "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        Cache::forget("user.$user->id");
    }
}
