<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'title' => 'Summer Music Festival 2024',
            'description' => 'Festival musik terbesar di Indonesia dengan berbagai artis ternama',
            'event_date' => '2024-07-15 19:00:00',
            'venue' => 'Central Park',
            'city' => 'Jakarta',
            'type' => 'concert',
            'price' => 500000,
            'capacity' => 1000,
            'available_tickets' => 1000,
            'status' => 'upcoming'
        ]);

        Event::create([
            'title' => 'Tech Conference 2024',
            'description' => 'Konferensi teknologi terbesar di Indonesia',
            'event_date' => '2024-08-20 09:00:00',
            'venue' => 'Jakarta Convention Center',
            'city' => 'Jakarta',
            'type' => 'conference',
            'price' => 750000,
            'capacity' => 500,
            'available_tickets' => 500,
            'status' => 'upcoming'
        ]);

        Event::create([
            'title' => 'Web Development Workshop',
            'description' => 'Workshop pengembangan web modern dengan Laravel',
            'event_date' => '2024-06-10 13:00:00',
            'venue' => 'Digital Hub',
            'city' => 'Bandung',
            'type' => 'workshop',
            'price' => 300000,
            'capacity' => 50,
            'available_tickets' => 50,
            'status' => 'upcoming'
        ]);
    }
} 