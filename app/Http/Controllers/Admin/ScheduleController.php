<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['brand', 'users'])
            ->latest()
            ->get();

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $brands = Brand::where('status', 'active')
            ->orderBy('name')
            ->get();

        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        return view('admin.schedules.create', compact('brands', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'session_name' => 'required|string|max:255',
            'session_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
        ]);

        $schedule = Schedule::create([
            'brand_id' => $validated['brand_id'],
            'session_name' => $validated['session_name'],
            'session_date' => $validated['session_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'location' => $validated['location'],
            'is_active' => $validated['is_active'],
        ]);

        $schedule->users()->sync($validated['user_ids']);

        return redirect()
            ->route('admin.brand-session')
            ->with('success', 'Sesi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $schedule = Schedule::with('users')->findOrFail($id);

        $brands = Brand::where('status', 'active')
            ->orderBy('name')
            ->get();

        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        return view('admin.schedules.edit', compact(
            'schedule',
            'brands',
            'users'
        ));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'session_name' => 'required|string|max:255',
            'session_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
        ]);

        $schedule->update([
            'brand_id' => $validated['brand_id'],
            'session_name' => $validated['session_name'],
            'session_date' => $validated['session_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'location' => $validated['location'],
            'is_active' => $validated['is_active'],
        ]);

        $schedule->users()->sync($validated['user_ids']);

        return redirect()
            ->route('admin.brand-session')
            ->with('success', 'Sesi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return back()->with('success', 'Sesi berhasil dihapus.');
    }
}