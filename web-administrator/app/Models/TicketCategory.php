<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    use HasFactory;
    protected $table = "tiket_category";
    public $timestamps = false;

    protected $fillable = [
        "category_id",
        "category"
    ];
}
