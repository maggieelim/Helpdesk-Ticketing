<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = "ticket";
    public $timestamps = false;

    protected $fillable = [
        "TID",
        "note",
        "MID",
        "action",
        "status_id",
        "urgency_id",
        "category_id",
        "created_at",
        "updated_at",
        "title"
    ];
    public function ticketStatus()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }
    public function ticketUrgensi()
    {
        return $this->belongsTo(TicketUrgensi::class, 'urgency_id');
    }
    public function ticketCategory()
    {
        return $this->belongsTo(ticketCategory::class, 'category_id', 'category_id');
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'MID', 'MID');
    }
    public function task()
    {
        return $this->belongsTo(TicketTask::class, 'TID', 'id');
    }
    public function employee()
    {
        return $this->belongsTo(employee::class, 'action', 'NIP');
    }
}
