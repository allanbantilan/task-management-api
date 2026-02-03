<?php

use Illuminate\Support\Facades\Route;

// Catch all routes and return the Vue app
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
