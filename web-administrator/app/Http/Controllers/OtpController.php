<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OtpMail;
use App\Models\Merchant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $MID = $request->input('MID');
        $email = Merchant::select('email')->where('MID', $MID)->distinct()->get();
        $otp = rand(10000, 999999);
        Cache::put("otp:$email", $otp, 300); // Store OTP for 5 minutes
        Mail::to($email)->send(new OtpMail($email, $otp));
        return view('session.otpVerification');
    }
}
