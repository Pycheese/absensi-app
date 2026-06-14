<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| USER CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ScheduleController as UserScheduleController;
use App\Http\Controllers\User\HistoryController as UserHistoryController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\AttendanceController as UserAttendanceController;
use App\Http\Controllers\User\NotificationController as UserNotificationController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\BrandSessionController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AttendanceReportController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (auth()->check()) {

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::get('/scan', function () {
    return redirect()->route('login');
})->name('scan');
/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/schedule', [UserScheduleController::class, 'index'])
        ->name('schedule.index');

    Route::get('/history', [UserHistoryController::class, 'index'])
        ->name('attendance.history');

    Route::get('/profile', [UserProfileController::class, 'index'])
        ->name('profile.edit');

    Route::middleware(['auth'])->group(function () {
        Route::post('/user/attendance/{schedule}/check-in', [UserAttendanceController::class, 'checkIn'])
            ->name('user.attendance.checkin');

        Route::post('/user/attendance/{schedule}/check-out', [UserAttendanceController::class, 'checkOut'])
            ->name('user.attendance.checkout');
    });

    Route::get('/notifications', [UserNotificationController::class, 'index'])
        ->name('notifications.index');

    Route::get('/schedule/calendar', [UserScheduleController::class, 'calendar'])
        ->name('user.schedule.calendar');

    Route::get('/history/calendar', [UserHistoryController::class, 'calendar'])
        ->name('history.calendar');

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')->name('admin.')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [AdminProfileController::class, 'index'])
            ->name('profile.index');

        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [AdminProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('/profile/password', [AdminProfileController::class, 'password'])
            ->name('profile.password');

        Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])
            ->name('profile.password.update');

        /*
        |--------------------------------------------------------------------------
        | Employees
        |--------------------------------------------------------------------------
        */

        Route::get('/employees', [AdminEmployeeController::class, 'index'])
            ->name('employees.index');

        Route::get('/employees/create', [AdminEmployeeController::class, 'create'])
            ->name('employees.create');

        Route::post('/employees/store', [AdminEmployeeController::class, 'store'])
            ->name('employees.store');

        Route::get('/employees/edit/{id}', [AdminEmployeeController::class, 'edit'])
            ->name('employees.edit');

        Route::post('/employees/update/{id}', [AdminEmployeeController::class, 'update'])
            ->name('employees.update');

        Route::delete('/employees/delete/{id}', [AdminEmployeeController::class, 'destroy'])
            ->name('employees.destroy');

        /*
        |--------------------------------------------------------------------------
        | Brands
        |--------------------------------------------------------------------------
        */

        Route::get('/brands', [BrandController::class, 'index'])
            ->name('brands.index');

        Route::get('/brands/create', [BrandController::class, 'create'])
            ->name('brands.create');

        Route::post('/brands/store', [BrandController::class, 'store'])
            ->name('brands.store');

        Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])
            ->name('brands.edit');

        Route::post('/brands/update/{id}', [BrandController::class, 'update'])
            ->name('brands.update');

        Route::delete('/brands/delete/{id}', [BrandController::class, 'destroy'])
            ->name('brands.destroy');

        /*
        |--------------------------------------------------------------------------
        | Schedules
        |--------------------------------------------------------------------------
        */

        Route::get('/schedules', [ScheduleController::class, 'index'])
            ->name('user.schedules.index');

        Route::get('/schedules/create', [ScheduleController::class, 'create'])
            ->name('schedules.create');

        Route::post('/schedules/store', [ScheduleController::class, 'store'])
            ->name('schedules.store');

        Route::get('/schedules/edit/{id}', [ScheduleController::class, 'edit'])
            ->name('schedules.edit');

        Route::put('/schedules/update/{id}', [ScheduleController::class, 'update'])
            ->name('schedules.update');

        Route::delete('/schedules/delete/{id}', [ScheduleController::class, 'destroy'])
            ->name('schedules.destroy');

        /*
        |--------------------------------------------------------------------------
        | Brand Session
        |--------------------------------------------------------------------------
        */

        Route::get('/brand-session', [BrandSessionController::class, 'index'])
            ->name('brand-session');

        /*
  |--------------------------------------------------------------------------
  | Attendance Report
  |--------------------------------------------------------------------------
  */

        Route::get('/attendance-report', [AttendanceReportController::class, 'index'])
            ->name('attendance.report');

        Route::get('/attendance-report/export/excel', [AttendanceReportController::class, 'exportExcel'])
            ->name('attendance.report.export.excel');

        Route::get('/attendance-report/export/pdf', [AttendanceReportController::class, 'exportPdf'])
            ->name('attendance.report.export.pdf');

        /*
        |--------------------------------------------------------------------------
        | PAYROLL / KEUANGAN
        |--------------------------------------------------------------------------
        */

        Route::get('/keuangan', [PayrollController::class, 'index'])
            ->name('payroll.index');

        Route::post('/keuangan/generate', [PayrollController::class, 'generate'])
            ->name('payroll.generate');

        Route::post('/keuangan/{id}/paid', [PayrollController::class, 'markAsPaid'])
            ->name('payroll.paid');

        Route::get('/keuangan/export/excel', [PayrollController::class, 'export'])
            ->name('payroll.export');

    });


});

require __DIR__ . '/auth.php';
