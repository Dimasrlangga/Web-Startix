<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketConfirmation;

class TicketController extends Controller
{
    public function create(Event $event)
    {
        return view('tickets.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'identity_type' => 'required|string|in:KTP,SIM,Kartu Pelajar,Passport,KTA,KTM',
            'identity_number' => 'required|string|max:255',
            'address' => 'required|string',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20'
        ]);

        $ticket = new Ticket($validated);
        $ticket->event_id = $event->id;
        $ticket->ticket_code = $ticket->generateTicketCode();
        $ticket->status = 'pending';
        $ticket->payment_deadline = now()->addMinutes(30);
        
        // Generate QR Code
        $qrCode = QrCode::format('png')
            ->size(300)
            ->generate(route('tickets.verify', $ticket->ticket_code));
        
        $ticket->qr_code = $qrCode;
        $ticket->save();

        // Kirim email konfirmasi
        Mail::to($ticket->email)->send(new TicketConfirmation($ticket));

        return redirect()->route('tickets.payment', $ticket)
            ->with('success', 'Tiket berhasil dibuat! Silakan lakukan pembayaran dalam 30 menit.');
    }

    public function verify($ticketCode)
    {
        $ticket = Ticket::where('ticket_code', $ticketCode)
            ->where('status', 'paid')
            ->first();

        if (!$ticket) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Tiket tidak valid atau belum dibayar'
            ]);
        }

        if ($ticket->status === 'used') {
            return response()->json([
                'status' => 'used',
                'message' => 'Tiket sudah digunakan'
            ]);
        }

        // Update status tiket menjadi used
        $ticket->update(['status' => 'used']);

        return response()->json([
            'status' => 'valid',
            'message' => 'Tiket valid, silakan masuk'
        ]);
    }
} 