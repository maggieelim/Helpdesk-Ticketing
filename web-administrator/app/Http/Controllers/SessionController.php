<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\Employee;
use App\Models\Merchant;
use App\Models\VerifyOTP;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class SessionController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('session.home');
    }
    public function employeeLogin()
    {
        return view('session.employeeLogin');
    }
    public function merchantLogin()
    {
        return view('session.merchantLogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email field is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Password field is required',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin) && Auth::user()->role_id == 1) {
            return redirect('/ticket')->with('success', 'Successed Login');
        } elseif (Auth::attempt($infologin) && Auth::user()->role_id == 2) {
            return redirect('/ticketTask')->with('success', 'Successed Login');
        } else {
            return redirect()->back()->withErrors('Email and Password not valid');
        }
    }

    public function sendOtp(Request $request)
    {
        $MID = $request->input('MID');
        session(['MID' => $MID]);

        $email = Merchant::select('email')->where('MID', $MID)->distinct()->first();
        if (!$email) {
            return redirect()->back()->withErrors('Merchant not found.');
        }

        $otp = rand(10000, 999999);
        Cache::put("otp:{$MID}", $otp, 300); // Store OTP for 5 minutes

        Mail::to($email)->send(new OtpMail($email, $otp));

        $data = [
            'MID' => $MID,
            'otp' => $otp,
            'issued_date' => Carbon::now()->setTimezone('Asia/Jakarta'),
            'exp_date' => Carbon::now()->setTimezone('Asia/Jakarta')->addMinutes(5),

        ];
        VerifyOTP::create($data);
        return redirect('otp-verification')->with('success', 'OTP Created Successfully');
    }

    public function inputOtp()
    {
        return view('session.otpVerification');
    }

    public function loginWithOtp(Request $request)
    {
        $request->validate([
            'MID' => 'required',
            'otp' => 'required',
        ]);

        $MID = $request->input('MID');
        $otp = $request->input('otp');
        $verifyOTP = VerifyOTP::where('MID', $MID)->where('otp', $otp)->first();
        $now = Carbon::now();
        // Verify OTP from cache
        $cachedOtp = Cache::get("otp:$MID");

        if (!$verifyOTP) {
            return redirect()->back()->withErrors('Invalid OTP.');
        } elseif ($verifyOTP && $now->isAfter($verifyOTP->exp_date)) {
            return redirect()->route('session.merchantLogin')->withErrors('Your OTP has been expired');
        }

        // Find merchant and log them in
        $merchant = Merchant::where('MID', $MID)->first();

        if ($merchant) {
            Auth::loginUsingId($merchant->MID);
            $user = Auth::id();
            return redirect('/merchantTicket')->with('success', 'You are successfully logged in.');
        } else {
            return redirect()->back()->withErrors('Merchant not found.');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('')->with('success', 'Berhasil logout');
    }
}
