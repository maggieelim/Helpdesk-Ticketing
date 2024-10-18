<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTask extends Model
{
    use HasFactory;
    protected $table = "ticket_task";
    public $timestamps = false;

    protected $fillable = [
        "id",
        "NIP"
    ];
    public function employee()
    {
        return $this->belongsTo(employee::class, 'NIP', 'NIP');
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id', 'id');
    }
}
