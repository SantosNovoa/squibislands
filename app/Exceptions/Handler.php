<?php

namespace App\Exceptions;

<<<<<<< HEAD
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler {
=======
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
>>>>>>> Cylunny/extension/polls-and-forms
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
     * Report or log an exception.
     *
<<<<<<< HEAD
     * @param \Exception $exception
     */
    public function report(Throwable $exception) {
=======
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        if ($exception instanceof ValidationException) {
            foreach ($exception->validator->errors()->all() as $message) {
                flash($message)->error();
            }
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
<<<<<<< HEAD
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
>>>>>>> Cylunny/extension/polls-and-forms
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
<<<<<<< HEAD
        if ($exception instanceof ThrottleRequestsException) {
            Log::channel('too_many_attempts')->warning('Too many attempts: ', ['user' => $request->user()->name, 'parameters' => $request->all()]);
            flash('Too many attempts, this will be logged for the admins. Your action may have still worked as intended, please check your inventory/characters/MYOs before retrying.')->warning();
            return redirect()->back(); 
        }
=======
>>>>>>> Cylunny/extension/polls-and-forms
        return parent::render($request, $exception);
    }
}
