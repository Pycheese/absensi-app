<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'brand_name',
        'session_name',
        'session_date',
        'start_time',
        'end_time',
        'location',
        'qr_code_id',
        'is_active',
    ];
}