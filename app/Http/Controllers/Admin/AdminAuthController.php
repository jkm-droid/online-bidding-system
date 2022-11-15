<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    /**
     * @var AdminService
     */
    private $_adminService;

    public function __construct(AdminService $adminService)
    {
        $this->middleware('guest:admin')->except('signOutAdmin');
        $this->_adminService = $adminService;
    }

    /**
     * Show the form to register an admin
     *
     * @return Application|Factory|View
     */
    public function adminShowRegisterPage()
    {
        return view('admin.register');
    }

    /**
     * Add a new admin to storage
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function createAdmin(Request $request)
    {
        return $this->_adminService->registerAdmin($request);
    }

    /**
     * Show the form for signing a registered admin
     *
     * @return Application|Factory|View
     */
    public function adminShowLoginPage(){
        return view('admin.login');
    }

    /**
     * Login admin to the system
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function signInAdmin(Request $request)
    {
        return $this->_adminService->loginAdmin($request);
    }

    /**
     * Logout admin from the system
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function signOutAdmin(Request $request)
    {
        return $this->_adminService->logoutAdmin($request);
    }

}
