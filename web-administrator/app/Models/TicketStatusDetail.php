<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatusDetail extends Model
{
    use HasFactory;
    protected $table = "tiket_status_detail";
    public $timestamps = false;

    protected $fillable = [
        "id",
        "TID",
        "status_id",
        "created_at"
    ];
}
