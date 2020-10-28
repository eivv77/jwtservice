<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        //
    }

    public function render($request, \Throwable $exception)
    {
        if ($exception instanceof
            \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return response()->json(['error' => 'TOKEN_EXPIRED']);
        } else if ($exception instanceof
            \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return response()->json(['error' => 'TOKEN_INVALID']);
        } else if ($exception instanceof
            \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
            return response()->json(['error' => 'TOKEN_BLACKLISTED']);
        }
        if ($exception->getMessage() === 'Token not provided') {
            return response()->json(['error' => 'Token not provided']);
        }
        if ($exception instanceof UnauthorizedHttpException)
            return response()->json(['error' => 'Unauthorized']);

//        if( $exception->getStatusCode() == 403){
//            return response()->json(['error' => 'Unauthorized'],403);
//        }

        return $exception;
    }
}
