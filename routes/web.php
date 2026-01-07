<?php

use Illuminate\Support\Facades\Route;

Route::resource('', \App\Http\Controllers\HomeController::class)->names('home');
Route::get('/recherche', [\App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
Route::post('/send_email', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
