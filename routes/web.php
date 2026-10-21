<?php

use App\Http\Controllers\LlmsFullTxtController;
use App\Http\Controllers\LlmsTxtController;
use App\Http\Controllers\SitemapController;
use App\Livewire\Portfolio\BlogIndex;
use App\Livewire\Portfolio\BlogPost;
use App\Livewire\Portfolio\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('portfolio.home');
Route::get('/blog', BlogIndex::class)->name('portfolio.blog.index');
Route::get('/blog/{slug}', BlogPost::class)->name('portfolio.blog.show');
Route::get('/sitemap.xml', SitemapController::class)->name('portfolio.sitemap');
Route::get('/llms.txt', LlmsTxtController::class)->name('portfolio.llms');
Route::get('/llms-full.txt', LlmsFullTxtController::class)->name('portfolio.llms-full');
