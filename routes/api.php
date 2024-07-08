<?php

use Illuminate\Support\Facades\Route;

Route::get('/employee', [App\Http\Controllers\Api\EmployeeController::class, 'index']);
