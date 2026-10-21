<?php

use App\Http\Controllers\LlmsTxtController;
use App\Livewire\Portfolio\BlogIndex;
use App\Livewire\Portfolio\BlogPost;
use App\Livewire\Portfolio\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('portfolio.home');
Route::get('/blog', BlogIndex::class)->name('portfolio.blog.index');
Route::get('/blog/{slug}', BlogPost::class)->name('portfolio.blog.show');
Route::get('/llms.txt', LlmsTxtController::class)->name('portfolio.llms');
Route::get('/llms-full.txt', \App\Http\Controllers\LlmsFullTxtController::class)->name('portfolio.llms-full');
