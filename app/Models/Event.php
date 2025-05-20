<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'event_date',
        'venue',
        'city',
        'type',
        'price',
        'capacity',
        'available_tickets',
        'status'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'price' => 'decimal:2'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedDateAttribute()
    {
        return $this->event_date->format('d M Y H:i');
    }

    public function getMonthAttribute()
    {
        return $this->event_date->format('m');
    }

    public function getYearAttribute()
    {
        return $this->event_date->format('Y');
    }
} 