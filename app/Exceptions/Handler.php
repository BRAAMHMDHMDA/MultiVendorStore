<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

//    public function render($request, $exception)
//    {
//        $dashboard = $request->is('dashboard/*');
//        if ($exception instanceof NotFoundHttpException) {
//            if ($dashboard) {
//                return response()->view('dashboard.content.errors.404', [], 404);
//            } else {
//                return response()->view('website.content.errors.404', [], 404);
//            }
//        }
//
//        return parent::render($request, $exception);
//    }
    public function render($request, $exception)
    {
        $dashboard = $request->is('dashboard/*');
        $errorView = $dashboard ? 'dashboard.content.errors.' : 'website.content.errors.';

        if ($exception instanceof NotFoundHttpException ||$exception instanceof ModelNotFoundException  || $exception instanceof AuthorizationException) {
            $statusCode = $exception instanceof AuthorizationException ? 403 : 404;
            return response()->view($errorView . $statusCode, [], $statusCode);
        }

        return parent::render($request, $exception);
    }

}
