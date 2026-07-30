<?php

use App\Livewire\Portfolio\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('portfolio.home');
