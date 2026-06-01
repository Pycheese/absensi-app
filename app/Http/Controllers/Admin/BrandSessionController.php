<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Schedule;

class BrandSessionController extends Controller
{
    public function index()
    {
        $search = request('search');

        /*
        |--------------------------------------------------------------------------
        | BRAND DATA
        |--------------------------------------------------------------------------
        */

        $brands = Brand::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
            ->latest()
            ->get();

        $totalBrands = Brand::count();

        $activeBrands = Brand::where('status', 'active')->count();

        $inactiveBrands = Brand::where('status', 'inactive')->count();


        /*
        |--------------------------------------------------------------------------
        | SESSION DATA
        |--------------------------------------------------------------------------
        */

        $schedules = Schedule::with([
            'brand',
            'users',
            'attendances.user',
        ])
            ->latest()
            ->get();


        return view('admin.brand-session.index', compact(
            'brands',
            'schedules',
            'totalBrands',
            'activeBrands',
            'inactiveBrands'
        ));
    }
}