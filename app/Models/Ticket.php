<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'admin_id', 'status', 'subject', 'last_updated_by', 'code'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function lastUpdatedBy()
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(TicketMessage::class)->latest();
    }
}
