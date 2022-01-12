<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessengerTopic extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'subject',
        'sender_id',
        'receiver_id',
        'sent_at'
    ];
}
