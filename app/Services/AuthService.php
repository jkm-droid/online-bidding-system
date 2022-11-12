<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserVerification;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * @param $request
     * @return RedirectResponse
     */
    public function createNewBuyer($request)
    {
//        dd($request->all());
        $request->validate([
            'username'=>'required|unique:users',
            'full_name'=>'required|min:8|string',
            'email'=>'required|email|unique:users',
            'phone_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20|unique:users',
            'password'=>'required|min:6',
            'password_confirm'=>'required|min:6|same:password',
        ]);

        User::create([
            'username' => $request['username'],
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('buyer.show.login')
            ->with('success', 'Registered successfully. Your account will be approved shortly');
    }

    /**
     * @param $token
     * @return RedirectResponse
     */
    public function verifyBuyer($token)
    {
        $userVerify = UserVerification::where('token', $token)->first();
        $message = 'Email cannot be recognized';

        if (!is_null($userVerify)){
            $user = $userVerify->user;

            if (!$user->is_email_verified){
                $userVerify->user->is_email_verified = 1;
                $userVerify->user->email_verified_at = Carbon::now();
                $userVerify->user->save();
                $message = "Email has been verified. You can now login";
            }else{
                $message = "Seems like your email is already verified. Kindly login";
            }
        }

        return redirect()->route('user.show.login')->with('success', $message);
    }

    /**
     * @param $loginRequest
     * @return RedirectResponse
     */
    public function signInBuyer($loginRequest)
    {
        $credentials = filter_var(trim($loginRequest['username']), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(Auth::attempt(array($credentials=>trim($loginRequest['username']), 'password'=>trim($loginRequest['password'])))){//,'is_approved'=>1
            return redirect()->intended(route('buyer.portal'))
                ->with('success', 'logged in successfully');
        }

        return redirect()->route('buyer.show.login')
            ->with('error', 'Error, login details are incorrect');
    }

    /**
     * @return RedirectResponse
     */
    public function logoutBuyer($request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        return redirect()->route('buyer.show.login')->with('success', 'Logged out successfully');
    }

    /**
     * @param $request
     * @return RedirectResponse
     */
    public function processForgotPassForm($request)
    {
        $request->validate([
            'email'=>'required|email',
        ]);

        //check if email exists in our database
        $user_exists = DB::table('users')->where('email', $request->email)->first();
        if ($user_exists == null)
            return Redirect::back()
                ->with('success','if you have an account with us, you will receive a reset email shortly at '.$request->email);

        //generate token
        $token = Str::random(65);
        DB::table('password_resets')->insert([
            'email'=>trim($request->email),
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);

        Mail::send('mail.forgot_pass', ['token'=>$token], function ($message) use($request){
            $message->to($request->email);
            $message->from('no-reply@stawika-investment.com','Stawika Investment Group');
            $message->subject('Ask and you shall receive...Password reset');
        });

        return redirect()->route('buyer.show.forgot_pass_form')->with('success', 'We have emailed a reset link to '.$request->email);
    }

    /**
     * @param $request
     * @return RedirectResponse
     */
    public function processResetPassword($request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string|min:6|same:password_confirm',
            'password_confirm'=>'required|min:6'
        ]);

        $info = $request->all();
        $email = trim($info['email']);
        $password = trim($info['password']);
        $token = $request->token;

        $new_password = DB::table('password_resets')->where([
            'email'=>$email,
            'token'=>$token
        ])->first();

        if (!$new_password){
            return back()->withInput()->with('error','Invalid token');
        }

        User::where('email', $email)->update(['password'=>Hash::make($password)]);
        DB::table('password_resets')->where(['email'=>$email])->delete();

        return redirect()->route('buyer.show.login')->with('success', 'password changed successfully, you can now login');
    }
}
