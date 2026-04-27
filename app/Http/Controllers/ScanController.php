<?php

namespace App\Http\Controllers;

use App\Models\QrCode;

class ScanController extends Controller
{
    public function handle($token)
    {
        $qr = QrCode::where('token', $token)
            ->where('is_active', true)
            ->first();

        if (!$qr) {
            abort(404, 'QR tidak valid');
        }

        return view('dashboard.scan', compact('qr'));
    }
}