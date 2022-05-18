<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\HttpClientException;
use Throwable;

class Handler extends ExceptionHandler
{

    protected $exceptionAnswer = [];
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
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
        $this->reportable(function (Throwable $e) {
            $this->exceptionAnswer['error']['code'] = $e->getCode();
            $this->exceptionAnswer['error']['message'] = $e->getMessage();
            return response()->json($this->exceptionAnswer, 500);
        });

        /**
         *
         */
        $this->renderable(function (HttpClientException $e, $request) {
            $this->exceptionAnswer['error']['code'] = $e->getCode();
            $this->exceptionAnswer['error']['message'] = $e->getMessage();
            return response()->json($this->exceptionAnswer, $e->getCode());
        });
    }

}
