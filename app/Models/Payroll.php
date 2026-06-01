<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'user_id',
        'position',
        'type',
        'month',
        'year',
        'total_present',
        'daily_salary',
        'bonus',
        'deduction',
        'total_salary',
        'payment_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}