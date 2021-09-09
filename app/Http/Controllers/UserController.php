<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return Response::success(User::paginate());
    }

//    public function show(int $user): JsonResponse
    public function show(User $user): JsonResponse
    {
//        $user = Cache::get("user.$user");
        return Response::success($user);
    }

    public function delete(User $user): JsonResponse
    {
        return Response::success($user->delete());

//        return Response::success($user->hasPermissionTo('repudiandae::saepe'));
//        $user->hasPermissionTo('repudiandae::saepe');
//        return Response::success($user->getAllPermissions());
    }

    public function destroy(User $user): JsonResponse
    {
        return Response::success($user->forceDelete());
    }

    public function me(): JsonResponse
    {
        return Response::success(auth()->user());
    }

    public function all(): JsonResponse
    {
        return Response::success(User::pluck('username'));
    }
}
