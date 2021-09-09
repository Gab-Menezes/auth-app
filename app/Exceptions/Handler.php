<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

        $this->renderable(function (ValidationException $e, $request) {
            return Response::error($e->errors());
        });

        $this->renderable(function (NotFoundHttpException|ModelNotFoundException $e, $request) {
            $msg = $e->getMessage();
            if (str_contains($msg, 'model')) {
                $match = '';
                preg_match("/\\[(.*?)\\]/", $msg, $match);
                if ($match[1]) {
                    $model = explode('\\', $match[1]);
                    $model = $model[count($model) - 1];
                    $model = preg_replace('/([a-z])([A-Z])/s','$1 $2', $model);
                    $msg = "$model not found";
                }
            }
            if (!$msg) $msg = "Not found";
            return Response::error($msg, 404);
        });

        $this->renderable(function (AuthenticationException|InvalidToken|InvalidRefreshToken $e, $request) {
            return Response::error($e->getMessage(), 401);
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            return Response::error($e->getMessage(), 403);
        });

        $this->renderable(function (Throwable $e, $request) {
//            dd($e);
            return Response::error($e->getMessage(), 500);
        });
    }
}
