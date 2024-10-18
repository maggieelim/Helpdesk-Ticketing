<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyOTP extends Model
{
    use HasFactory;
    protected $table = "merchant_otp";
    public $timestamps = false;

    protected $fillable = [
        "MID",
        "otp",
        "issued_date",
        "exp_date"
    ];
}
