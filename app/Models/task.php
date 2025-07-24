<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';

    public $timestamps = false;

    protected $fillable = ['task_id', 'title', 'description', 'status','start_date','submit_date'];

    public function registerUser()
    {
        return $this->belongsTo(registeruser::class, 'regiuser_id', 'regiuser_id');
    }
}
