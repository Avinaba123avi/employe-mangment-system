<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(roles::class);
    }
}
