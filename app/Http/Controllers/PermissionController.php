<?php

namespace App\Http\Controllers;

use App\Http\Requests\SyncPermissionsRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    public function syncPermissions(SyncPermissionsRequest $request, User $user): JsonResponse
    {
        $user->syncPermissions($request->permissions);
//            ->setCachedPermissionsName();

        return Response::success(true);
    }

    public function myPermissions(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        return Response::success($user->getCachedPermissions());
//        return Response::success($user->can());
    }

    public function canI(Permission $permission): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
//        return Response::success($user->hasPermissionTo($permission));
        return Response::success($user->hasCachedPermissionTo($permission));
//        return Response::success(true);
    }


    public function canUser(Permission $permission, User $user): JsonResponse
    {
        return Response::success($user->hasPermissionTo($permission));
    }

    public function userPermissions(User $user): JsonResponse
    {
        return Response::success($user->getCachedPermissions());
    }

    public function all(): JsonResponse
    {
        return Response::success(Permission::all()->pluck('id'));
    }
}
