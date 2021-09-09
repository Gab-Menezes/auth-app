<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Response::macro('standard', function (
                                    $data = [],
                                    bool $success = true,
                                    int $status = 200,
                                    array $headers = [],
                                    int $options = 0): JsonResponse
        {
            $field = $success ? 'data' : 'error';
            $resp = [
                'success' => $success,
                $field => $data,
            ];

            /** @var Response $this */
            return $this->json($resp, $status, $headers, $options);
        });

        Response::macro('success', function ($data = [],
                                        int $status = 200,
                                        array $headers = [],
                                        int $options = 0): JsonResponse
        {
            /** @var Response $this */
            return $this->standard($data, true, $status, $headers, $options);
        });

        Response::macro('error', function ($data = [],
                                        int $status = 400,
                                        array $headers = [],
                                        int $options = 0): JsonResponse
        {
            /** @var Response $this */
            return $this->standard($data, false, $status, $headers, $options);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
