<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    use HasFactory;
    protected $table = "m_ticketstatus";
    public $timestamps = false;

    protected $fillable = [
        "id", "status"
    ];
}
