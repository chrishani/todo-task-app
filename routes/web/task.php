<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::resource('tasks', TaskController::class)
    ->except(['create','destroy','show','edit','update']);
