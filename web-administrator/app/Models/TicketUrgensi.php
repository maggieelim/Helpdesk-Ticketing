<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUrgensi extends Model
{
    use HasFactory;
    protected $table = "tiket_urgency";
    public $timestamps = false;

    protected $fillable = [
        "urgency_id",
        "urgency"
    ];
}
