<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home.index')->name('home');
Route::livewire('/genres/{slug}/{id}', 'pages::genres.show')->name('genres');
Route::livewire('film/{slug}/{id}', 'pages::movie.show')->name('movie.show');
Route::livewire('/contact', 'pages::contact.index')->name('contact');
Route::livewire('/actuellement-en-salle', 'pages::projection.projection-list')->name('projection.list');
Route::livewire('/finalisation-de-votre-achat', 'pages::checkout')->name('checkout');
Route::livewire('/retour-sur-votre-achat', 'pages::checkout-status')->name('status');
