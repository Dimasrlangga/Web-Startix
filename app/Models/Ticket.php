<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'ticket_code',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'identity_type',
        'identity_number',
        'address',
        'price',
        'status',
        'payment_proof',
        'paid_at',
        'used_at'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'paid_at' => 'datetime',
        'used_at' => 'datetime'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
} 