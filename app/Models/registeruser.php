<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class registeruser extends Authenticatable
{
    use Notifiable;
    protected $table = 'registerusers';
    protected $primaryKey = 'regiuser_id';

    public $timestamps = false;

    protected $fillable = ['first_name', 'last_name', 'email', 'usertype_id', 'password'];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    public function userType()
    {
        return $this->belongsTo(usertype::class, 'usertype_id', 'usertype_id');
    }

    public function loginUser()
    {
        return $this->hasOne(loginuser::class, 'regiuser_id', 'regiuser_id');
    }

    public function tasks()
    {
        return $this->hasMany(task::class,'regiuser_id', 'regiuser_id');
    }

    public function salaries()
    {
        return $this->hasMany(salary::class, 'regiuser_id', 'regiuser_id');
    }

    public function attendances()
    {
        return $this->hasMany(attendance::class, 'regiuser_id', 'regiuser_id');
    }

    public function leaves()
    {
        return $this->hasMany(leave::class, 'regiuser_id');
    }

    public function hasRole($role)
    {
        return $this->userType->user_type === $role;
    }

    public function hasPermission($permission)
    {
        return $this->permissions()->contains($permission);
    }

    public function permissions()
    {
        return $this->userType->permissions->pluck('permission_type')->unique();
    }

}
