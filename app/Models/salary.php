<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salary extends Model
{
    use HasFactory;

    protected $table = 'salaries';
    protected $primaryKey = 'salary_id';

    public $timestamps = false;

    protected $fillable = ['regiuser_id','amount', 'pay_date'];

    public function registerUser()
    {
        return $this->belongsTo(registeruser::class, 'regiuser_id', 'regiuser_id');
    }
}
