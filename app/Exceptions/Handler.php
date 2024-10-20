<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Response;
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
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if($request->wantsJson()){
                return ResponseFormatter::error(__('message.route_not_found'), ResponseFormatter::$errorNotFound, null);
            } else
                return new Response(view('pages-404'), 404);
        });

        // $this->renderable(function (ThrottleRequestsException $e, $request) {
        //     $header = $e->getHeaders();

        //     if($request->wantsJson()){
        //         $data = [
        //             'retry_after' => $header['Retry-After'] ?? 10
        //         ];
        //         return ResponseFormatter::error(__('message.retry_after'), ResponseFormatter::$toManyRequest, $data);
        //     }
        //     return view('pages-429');
        // });
    }
}
