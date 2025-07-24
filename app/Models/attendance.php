<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $primaryKey = 'attendance_id';

    public $timestamps = false;

    protected $fillable = ['attendance_id','regiuser_id', 'date', 'status'];

    public function registerUser()
    {
        return $this->belongsTo(RegisterUser::class, 'regiuser_id', 'regiuser_id');
    }
}
