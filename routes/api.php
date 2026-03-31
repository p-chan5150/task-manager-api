<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks/report', [TasksController::class, 'report']);

Route::apiResource('tasks', TasksController::class);
Route::patch('/tasks/{task}/status', [TasksController::class, 'updateStatus']);
Route::post('/tasks', [TasksController::class, 'store']);
