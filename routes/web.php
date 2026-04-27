<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])
        ->middleware('auth')
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/scan/{token}', [ScanController::class, 'handle'])
            ->name('scan.handle');

        Route::post('/attendance/store', [AttendanceController::class, 'store'])
            ->name('attendance.store');

        Route::get('/schedule', [ScheduleController::class, 'index'])
            ->name('schedule.index');

        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('profile.index');
    });
    Route::get('/attendance/store/{token}', [AttendanceController::class, 'store'])
        ->middleware('auth')
        ->name('attendance.store');
    Route::get('/history', [AttendanceController::class, 'history'])
        ->middleware('auth')
        ->name('attendance.history');
});
Route::get('/admin/dashboard', [AttendanceController::class, 'admin'])
    ->middleware('auth')
    ->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/export/pdf', [AttendanceController::class, 'exportPdf'])
        ->name('export.pdf');
});
require __DIR__ . '/auth.php';
