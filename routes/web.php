<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home.index')->name('home');
Route::livewire('/genres/{slug}/{id}', 'pages::genres.show')->name('genres');
Route::livewire('film/{id}', 'pages::movie.show')->name('movie.show');
Route::livewire('/contact', 'pages::contact.index')->name('contact');
