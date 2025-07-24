<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usertype extends Model
{
    protected $table = 'usertypes';
    protected $primaryKey = 'usertype_id';
    public $timestamps = false;

    protected $fillable = ['user_type'];

    public function registerUsers()
    {
        return $this->hasMany(registeruser::class, 'usertype_id', 'usertype_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(permission::class, 'role_permission', 'usertype_id', 'permission_id');
    }
}
