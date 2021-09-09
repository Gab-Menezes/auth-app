<?php

namespace App\Auth;

use App\Exceptions\InvalidToken;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use stdClass;

class JwtGuard implements Guard
{

    private Authenticatable|null $user = null;
    private stdClass|null $token = null;

    /**
     * @throws AuthenticationException if authentication fails
     * @throws InvalidToken if the token is invalid
     */
    public function __construct(
        private UserProvider $provider,
        private Request $request
    )
    {
        $this->authenticate();
    }

    /**
     * @return bool
     */
    public function check()
    {
        return !is_null($this->user());
    }

    /**
     * @return bool
     */
    public function guest()
    {
        return !$this->check();
    }

    /**
     * @return Authenticatable|null
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @return int|null
     */
    public function id()
    {
        return $this->user()?->id;
    }

    /**
     * @param array<string, string> $credentials
     * @return bool
     * @throws AuthenticationException if token is not present or the user not found
     */
    public function validate(array $credentials = [])
    {
        if (!$this->token) throw new AuthenticationException();

        $user = $this->provider->retrieveByCredentials($credentials);
        if (!$user) throw new AuthenticationException();
        $this->setUser($user);

        return true;
    }

    /**
     * @return void
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }

    /**
     * @throw
     * @return stdClass|null
     */
    public function token()
    {
        return $this->token;
    }


    /**
     * @throws InvalidToken if the token decode fails
     * @throws AuthenticationException if the token is expired or user not found
     * @return void
     */
    private function authenticate(): void
    {
        $token = $this->request->bearerToken();
        if (!$token) return;

        try {
            $this->token = JWT::decode($token, Cache::get('public_token_key'), array('RS256'));
        } catch(Exception) {
            throw new InvalidToken();
        }

        $exp = $this->token->exp;
        if (now()->timestamp > $exp) throw new AuthenticationException();

        $user = $this->provider->retrieveById($this->token->sub);
        if (!$user) throw new AuthenticationException();
        $this->setUser($user);
    }
}
