<?php

use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ThreadController;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::post('/threads/replies', [ReplyController::class, 'store'])->name('replies.store');

Route::resource('threads', ThreadController::class)->except(['create', 'show', 'edit', 'destroy']);


Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');


Route::get('/threads/{slug}', [ThreadController::class, 'show'])->name('threads.show');


Route::get('/threads/edit/{slug}', [ThreadController::class, 'edit'])->name('threads.edit');


Route::delete('/threads/destroy/{slug}', [ThreadController::class, 'destroy'])->name('threads.destroy');




/*
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
*/