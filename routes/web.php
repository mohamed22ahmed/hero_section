<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\PromptController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// API Routes
Route::post('/api/prompts/improve', [PromptController::class, 'improve'])->name('api.prompts.improve');

