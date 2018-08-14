<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
//        HttpException::class,
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if(!$exception instanceof HttpException)
        {
            $message = $exception->getMessage();
            $trace = $exception->getTraceAsString();
            $url = request()->url();
            Log::critical("Exception Occurred", [
                "Action URL" =>  $url,
                "Exception" => $message ,
                "Trace" => $trace,
            ]);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($request->ajax())
        {
            return response()->json(['error' => $exception->getMessage()]);
        }
        else if(app()->environment(['production', 'staging']))
        {
            return response()->view('static.500');
        }

        return parent::render($request, $exception);
    }
}
