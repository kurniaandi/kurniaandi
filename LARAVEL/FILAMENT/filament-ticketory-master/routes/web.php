<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use Filament\Facades\Filament;

Route::get('/login', function () {
    return redirect(Filament::getLoginUrl());
})->name('login');

Route::get('/', function () {
    return redirect()->route('login');
});
