<?php
use App\Http\Controllers\JocController;
Route::post('/play', [JocController::class, 'play']);