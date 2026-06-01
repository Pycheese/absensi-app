<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'brand_id',
        'session_name',
        'session_date',
        'start_time',
        'end_time',
        'location',
        'is_active',
    ];

    protected $casts = [
        'session_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // relasi ke brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // relasi ke attendance
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}