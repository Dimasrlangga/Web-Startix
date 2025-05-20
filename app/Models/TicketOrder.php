<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id', 'name', 'identity_type', 'identity_number', 'address', 'province', 'city', 'email', 'whatsapp', 'sender_name', 'proof', 'status'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
} 