<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        $now = now();

        $upcomingSchedules = Schedule::with('brand')
            ->whereDate('session_date', today())
            ->where('is_active', true)
            ->whereTime('start_time', '>', $now->format('H:i:s'))
            ->orderBy('start_time')
            ->get();

        return view('user.notifications.index', compact('upcomingSchedules'));
    }
}