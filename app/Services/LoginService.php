<?php

namespace App\Services;

use App\Exceptions\InvalidRefreshToken;
use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function login(string $username, string $password): User|null
    {
        $user = User::firstWhere('username', $username);
        if (!$user) return null;
        if (!Hash::check($password, $user->password)) return null;
        return $user;
    }

    /**
     * @param string $refreshToken
     * @return User
     * @throws InvalidRefreshToken if the refresh token decode fails
     */
    public function refreshToken(string $refreshToken): User
    {
        try {
            $payload = (array)JWT::decode($refreshToken, Cache::get('public_refresh_token_key'), array('RS256'));
        } catch(Exception) {
            throw new InvalidRefreshToken();
        }

        /** @var User $user */
        $user = User::findOrFail($payload['sub']);
        if ($user->token_version !== $payload['token_version']) throw new InvalidRefreshToken();
        return $user;
    }
}

