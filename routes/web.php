<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportConfigurationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PositionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute Autentikasi (Login, Register, dll.) yang dibuat oleh laravel/ui
Auth::routes();

// Rute utama ('/') - selalu redirect ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
})->name('welcome');


// Grup rute yang WAJIB LOGIN untuk diakses
Route::middleware(['auth'])->group(function () {

    // Dashboard redirect - jika user sudah login dan akses /home
    Route::get('/home', function () {
        return redirect()->route('employees.index');
    })->name('home');

    // Rute Resource untuk Employee
    Route::resource('employees', EmployeeController::class);

    // Rute Resource untuk Department
    Route::resource('departments', DepartmentController::class);

    // Rute Resource untuk Attendance (menggunakan plural form)
    Route::resource('attendances', AttendanceController::class);

    // Rute Laporan
    Route::resource('reports', ReportConfigurationController::class)->except(['show']);
    Route::get('/reports/{reportConfiguration}', [ReportConfigurationController::class, 'show'])->name('reports.show');

    // Rute Pengaturan
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('positions', PositionController::class);

    // Rute /home tidak diperlukan lagi jika HOME di RouteServiceProvider adalah /employees
    // Route::get('/home', function(){ return redirect()->route('employees.index'); })->name('home');

}); // Akhir Grup Middleware Auth