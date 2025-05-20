<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfidCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'name',
        'email',
        'nim',
        'role',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
} 