<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    use HasFactory;
    protected $table = "m_prefix";
    public $timestamps = false;

    protected $fillable = [
        "prefix", "counter", "length"
    ];
}
