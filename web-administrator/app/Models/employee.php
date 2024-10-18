<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class employee extends Authenticatable implements AuthenticatableContract
{
    use HasFactory;

    protected $table = "employee";
    public $timestamps = false;

    protected $fillable = [
        "nip",
        "first_name",
        "last_name",
        "email",
        "role",
        "created_by",
        "service_point",
        "insert_datetime",
        "update_by",
        "update_datetime",
    ];
    public function roleGroup()
    {
        return $this->belongsTo(RoleGroup::class, 'role', 'role_id');
    }
}
