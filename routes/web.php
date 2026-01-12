<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;

Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

