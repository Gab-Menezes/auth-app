<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidRefreshToken extends Exception
{
    public function __construct(string $message = "Invalid Refresh Token", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
