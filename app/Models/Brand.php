<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}