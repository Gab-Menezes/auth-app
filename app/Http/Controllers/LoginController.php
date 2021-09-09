<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRefreshToken;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\LoginService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function __construct(
        private LoginService $loginService
    ) {}

    /**
     * @throws AuthenticationException if user not found
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $user = $this->loginService->login($username, $password);
        if (!$user) throw new AuthenticationException();
        // //TODO[Gabriel Menezes](2021-09-02): Send refresh token as cookie
        return Response::success($user->tokens);
    }

    /**
     * @throws InvalidRefreshToken if the token is not valid
     * @throws Exception if the refresh token is not present
     */
    public function refreshToken(Request $request): JsonResponse
    {
        $refreshToken = $request->cookie('refresh_token');
        // TODO[Gabriel Menezes](2021-47-05): change exception
        if (!is_string($refreshToken)) throw new Exception("Invalid refresh token");
        $user = $this->loginService->refreshToken($refreshToken);
        //TODO[Gabriel Menezes](2021-09-02): Send refresh token as cookie
        return Response::success($user->tokens);
    }

    public function revokeRefreshToken(User $user): JsonResponse
    {
        $user->revokeToken();
        return Response::success(true);
    }

//    public function add(User $user): JsonResponse
//    {
//        $role = Role::create(['name' => 'test-role']);
//        $role->givePermissionTo('culpa::aut');
//        $user->assignRole('test-role');
//        return Response::json([]);
//    }
}
