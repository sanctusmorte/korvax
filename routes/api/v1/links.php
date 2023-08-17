<?php

use App\Http\Controllers\LinksController;
use Illuminate\Support\Facades\Route;

Route::get('/links', [LinksController::class, 'getList']);
Route::post('/links', [LinksController::class, 'create']);
