<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $primaryKey = 'permission_id';
    public $timestamps = false;

    protected $fillable = ['permission_type'];

    public function roles()
    {
        return $this->belongsToMany(usertype::class, 'role_permission', 'permission_id', 'usertype_id');
    }
}

