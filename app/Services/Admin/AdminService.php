<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminService
{

    /**
     * @param $request
     * @return RedirectResponse
     */
    public function registerAdmin($request)
    {
        $request->validate([
            'username'=>'required|unique:admins',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:6',
            'password_confirm'=>'required|min:6|same:password',
        ]);

        Admin::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('admin.show.login')
            ->with('success', 'Registered successfully. You can now login');

    }

    /**
     * @param $loginRequest
     * @return RedirectResponse
     */
    public function loginAdmin($loginRequest)
    {
        $loginRequest->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $credentials = filter_var($loginRequest['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(Auth::guard('admin')->attempt(array($credentials=>$loginRequest['username'], 'password'=>$loginRequest['password']))){
            return redirect()->intended(route('dashboard'))
                ->with('success', 'logged in successfully');
        }

        return redirect()->route('admin.show.login')
            ->with('error', 'Error, login details are incorrect');
    }

    /**
     * @return RedirectResponse
     */
    public function logoutAdmin($request)
    {
        if (Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }else {
            Auth::logout();
            Session::flush();
        }
        $request->session()->invalidate();
        return redirect()->route('admin.show.login')->with('success', 'Logged out successfully');
    }
}
