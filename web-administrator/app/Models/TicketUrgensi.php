<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUrgensi extends Model
{
    use HasFactory;
    protected $table = "m_ticketurgensi";
    public $timestamps = false;

    protected $fillable = [
        "id", "urgensi"
    ];
}
