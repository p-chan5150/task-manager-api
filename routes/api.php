<?php

use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tasks/report', [TasksController::class, 'report']);

Route::apiResource('tasks', TasksController::class);
Route::patch('/tasks/{task}/status', [TasksController::class, 'updateStatus']);
Route::post('/tasks', [TasksController::class, 'store']);
