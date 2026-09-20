<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

<<<<<<< HEAD
class ForgotPasswordController extends Controller {
=======
class ForgotPasswordController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
<<<<<<< HEAD
     */
    public function __construct() {
        parent::__construct();
=======
     *
     * @return void
     */
    public function __construct()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $this->middleware('guest');
    }
}
