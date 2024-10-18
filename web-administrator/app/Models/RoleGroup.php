<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleGroup extends Model
{
    use HasFactory;
    protected $table = "role";
    public $timestamps = false;
    protected $fillable = ["role_id", "role"];
}
