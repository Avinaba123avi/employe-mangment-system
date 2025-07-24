<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave extends Model
{
    use HasFactory;

    protected $table = 'leaves';
    protected $primaryKey = 'leave_id';

    public $timestamps = false;

    protected $fillable = [
        'regiuser_id',
        'leave_dates',
        'reason',
        'status'
    ];

    protected $casts = [
        'leave_dates' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(registeruser::class, 'regiuser_id');
    }


}
