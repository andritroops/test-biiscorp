<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/employee');
});

// Auth::routes();

Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
Route::post('/employee/upload/{id}', [App\Http\Controllers\EmployeeController::class, 'storeFile'])->name('employee.storeFile');
Route::get('/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');

