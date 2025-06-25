<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $fillable = ['ticket_id', 'user_id', 'message', 'attachment'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function is_admin()
    {
        return $this->user->is_admin();
    }
}
