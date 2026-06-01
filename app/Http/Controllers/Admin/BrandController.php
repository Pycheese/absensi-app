<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.brand-session');
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        Brand::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.brand-session')
            ->with('success', 'Brand berhasil ditambahkan');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        $brand->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.brand-session')
            ->with('success', 'Brand berhasil diupdate');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();

        return back()
            ->with('success', 'Brand berhasil dihapus');
    }
}