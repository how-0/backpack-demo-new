<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Notifications\TicketNotification;
use Illuminate\Support\Facades\Notification;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class SendTicketMailCrudController extends CrudController
{
    public function sendMailToCreator($id)
    {
        $entry = Ticket::findOrFail($id);
        
        $creator = $entry->creator;

        Notification::send($creator, new TicketNotification($entry));

        return response()->json([
            'message' => 'Email sent successfully to ' . $creator->email,
        ]);
    }
}
