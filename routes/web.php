<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController; 


Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');

Route::post('/upload', [GalleryController::class, 'store'])->name('gallery.store');

Route::delete('/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');