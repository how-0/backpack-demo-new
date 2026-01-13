<?php

namespace App\Models;

use App\Notifications\NewTicketCreationNotification;
use App\Notifications\TicketDeletedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\TicketNotification;
use App\Notifications\TicketUpdatedNotification;
use Illuminate\Support\Facades\Notification;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use CrudTrait;
    protected $fillable = ['created_by', 'name', 'gender', 'inquiry', 'status'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    protected static function booted()
    {
        static::saved(function ($ticket) {
            $creator = $ticket->creator;
            if ($ticket->wasRecentlyCreated) {
                Notification::send($creator, new TicketNotification($ticket));
                return;
            } else if ($ticket->wasChanged(['status'])) {
                Notification::send($creator, new TicketUpdatedNotification($ticket));
            }
        });

        static::deleting(function ($ticket) {
            $creator = $ticket->creator;
            $ticketData = $ticket->toArray();
            Notification::send($creator, new TicketDeletedNotification($ticketData));
        });
    }
}
