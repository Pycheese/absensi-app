<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $now = now();

        $selectedDate = $request->filled('date')
            ? Carbon::parse($request->date)
            : today();

        $startCalendar = today();
        $endCalendar = today()->copy()->addMonth();

        $calendarDays = collect();

        for ($date = $startCalendar->copy(); $date->lte($endCalendar); $date->addDay()) {
            $calendarDays->push($date->copy());
        }

        $schedules = Schedule::with('brand')
            ->whereHas('users', function ($query) {
                $query->where('users.id', auth()->id());
            })
            ->where('is_active', true)
            ->whereDate('session_date', $selectedDate)
            ->orderBy('start_time')
            ->get()
            ->map(function ($schedule) use ($now) {
                $startTime = Carbon::parse(
                    $schedule->session_date->format('Y-m-d') . ' ' . $schedule->start_time
                );

                $endTime = Carbon::parse(
                    $schedule->session_date->format('Y-m-d') . ' ' . $schedule->end_time
                );

                if ($endTime->lt($startTime)) {
                    $endTime->addDay();
                }

                if ($now->lt($startTime)) {
                    $schedule->ui_status = 'upcoming';
                    $schedule->status_label = 'Belum Mulai';
                } elseif ($now->between($startTime, $endTime)) {
                    $schedule->ui_status = 'ongoing';
                    $schedule->status_label = 'Berlangsung';
                } else {
                    $schedule->ui_status = 'finished';
                    $schedule->status_label = 'Selesai';
                }

                $schedule->start_datetime = $startTime;
                $schedule->end_datetime = $endTime;

                return $schedule;
            });

        return view('user.schedule.index', compact(
            'schedules',
            'calendarDays',
            'selectedDate'
        ));
    }
    public function calendar()
    {
        $selectedDate = request('date')
            ? \Carbon\Carbon::parse(request('date'))
            : today();

        $startCalendar = today()->startOfMonth();
        $endCalendar = today()->copy()->addMonth()->endOfMonth();

        $calendarDays = collect();

        for ($date = $startCalendar->copy(); $date->lte($endCalendar); $date->addDay()) {
            $calendarDays->push($date->copy());
        }

        return view('user.schedule.calendar', compact(
            'calendarDays',
            'selectedDate'
        ));
    }
}