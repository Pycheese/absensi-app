<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $fillable = [
        'schedule_id',
        'token',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}