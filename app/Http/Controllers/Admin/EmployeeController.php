<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::latest()->get();

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $employee = User::findOrFail($id);

        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($employee->id),
            ],
            'role' => 'required|in:user,admin',
        ]);

        $employee->update($validated);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return back()->with('success', 'Karyawan berhasil dihapus.');
    }
}