<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(users::class);
    }
}
