<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Merchant extends Authenticatable
{
    use HasFactory;
    protected $table = "merchant";
    public $timestamps = false;
    protected $fillable = ["MID", "merchant_name", "address_1", "address_2", "email", "service_point"];
}
