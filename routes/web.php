<?php
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $employees = \App\Models\Employee::latest()->paginate(5);
    return view('employees.index', compact('employees'));
});

Route::resource('employees', EmployeeController::class);

