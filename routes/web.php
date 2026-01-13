<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use App\Notifications\TicketNotification;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     Ticket::create;
// });
