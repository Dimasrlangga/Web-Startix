@extends('layouts.app')

@section('title', 'Tiket Saya')

@section('content')
<div class="container">
    <h1 class="mb-4">Tiket Saya</h1>

    <div class="row">
        @forelse($tickets as $ticket)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">{{ $ticket->event->title }}</h5>
                                <p class="text-muted mb-0">
                                    <small>{{ $ticket->event->event_date->format('d M Y H:i') }}</small>
                                </p>
                            </div>
                            <span class="badge bg-{{ $ticket->status === 'paid' ? 'success' : ($ticket->status === 'pending' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <p class="mb-1">
                                <strong>Kode Tiket:</strong> {{ $ticket->ticket_code }}
                            </p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                @if($ticket->status === 'pending')
                                    Menunggu Pembayaran ({{ $ticket->payment_deadline->diffForHumans() }})
                                @elseif($ticket->status === 'paid')
                                    Pembayaran Berhasil
                                @elseif($ticket->status === 'used')
                                    Tiket Sudah Digunakan
                                @else
                                    Tiket Kadaluarsa
                                @endif
                            </p>
                        </div>

                        @if($ticket->status === 'paid')
                            <div class="text-center mb-3">
                                <img src="data:image/png;base64,{{ base64_encode($ticket->qr_code) }}" 
                                    alt="QR Code" class="img-fluid" style="max-width: 200px;">
                                <p class="text-muted mt-2">
                                    <small>Tunjukkan QR Code ini saat masuk event</small>
                                </p>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('events.show', $ticket->event) }}" class="btn btn-outline-primary">
                                Detail Event
                            </a>
                            @if($ticket->status === 'pending')
                                <a href="{{ route('tickets.payment', $ticket) }}" class="btn btn-primary">
                                    Bayar Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Anda belum memiliki tiket. 
                    <a href="{{ route('events.index') }}" class="alert-link">Lihat daftar event</a>
                </div>
            </div>
        @endforelse
    </div>

    @if($tickets->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
@endsection 