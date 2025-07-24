<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loginuser extends Model
{
    protected $table = 'loginusers';
    protected $primaryKey = 'login_id';

    public $timestamps = false;

    protected $fillable = ['regiuser_id', 'email', 'password'];

    public function registerUser()
    {
        return $this->belongsTo(registeruser::class, 'regiuser_id', 'regiuser_id');
    }

}
