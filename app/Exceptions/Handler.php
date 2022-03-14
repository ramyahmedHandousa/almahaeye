<?php

namespace App\Exceptions;

use App\Support\Facade\Responder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
            //
        });
    }

    public function render($request, Throwable $exception)
    {

        if ($request->wantsJson()) {

            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {

                return response()->json(['status' => 401 , 'errors' => (array)trans('global.user_not_found')],401);
            }
            if ($exception instanceof ModelNotFoundException) {
                return  Responder::error( (array)'تاكد من وجود هذا العنصر');
            }

            if($exception instanceof AuthorizationException  ){
                return  Responder::error( (array)$exception->getMessage());
            }
        }
        return parent::render($request, $exception);
    }

}
