<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Services\Buyer\AuthService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var authService
     */
    private $_authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('guest')->except('logoutBuyer');
        $this->_authService = $authService;
    }

    /**
     * show the register page
     * */
    public function showRegisterPage()
    {
        return view('buyer.register');
    }

    /**
     * Register a new buyer
     *
     * This endpoint lets you add a new buyer into the storage
     * @param Request $request
     * @return RedirectResponse
     */
    public function registerBuyer(Request $request)
    {
        return $this->_authService->createNewBuyer($request);
    }

    /**
     * Verify user email
     *
     * @param $token
     * @return RedirectResponse
     */
    public function verifyBuyerEmail($token)
    {
        return $this->_authService->verifyBuyer($token);
    }

    /**
     * show the login page
     * */
    public function showLoginPage()
    {
        return view('buyer.login');
    }

    /**
     * Login user into the system
     *
     * This endpoint lets you sign in a user into the system
     * Throws an error if the login credentials are incorrect
     * @param Request $loginRequest
     * @return RedirectResponse
     */
    public function loginBuyer(Request $loginRequest)
    {
        return $this->_authService->signInBuyer($loginRequest);
    }

    /**
     * Logout a user
     *
     * This endpoint lets you sign out a user from the system
     * @param Request $request
     * @return RedirectResponse
     */
    public function logoutBuyer(Request $request)
    {
        return $this->_authService->logoutBuyer($request);
    }

    /**
     * Show the form for sending forgot password request
     *
     * @return Application|Factory|View
     */
    public function showForgotPassForm()
    {
        return view('buyer.forgot_pass');
    }

    /**
     * Process the forgot password form
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function submitForgotPassForm(Request $request)
    {
        return $this->_authService->processForgotPassForm($request);
    }

    /**
     * Show the form for resetting a new password
     *
     * @param $token
     * @return Application|Factory|View
     */
    public function showResetPassForm($token)
    {
        return view('buyer.reset_pass', ['token'=>$token]);
    }

    /**
     * Process the reset password request
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function resetPass(Request $request)
    {
        return $this->_authService->processResetPassword($request);
    }
}
