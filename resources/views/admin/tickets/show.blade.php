@extends('layouts.app')

@section('title', 'Detail Tiket')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Detail Tiket</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informasi Event</h5>
                            <p class="mb-1">
                                <strong>Event:</strong> {{ $ticket->event->title }}
                            </p>
                            <p class="mb-1">
                                <strong>Tanggal:</strong> {{ $ticket->event->event_date->format('d M Y H:i') }}
                            </p>
                            <p class="mb-1">
                                <strong>Lokasi:</strong> {{ $ticket->event->location }}
                            </p>
                            <p class="mb-1">
                                <strong>Harga:</strong> Rp {{ number_format($ticket->event->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Status Tiket</h5>
                            <p class="mb-1">
                                <strong>Kode Tiket:</strong> {{ $ticket->ticket_code }}
                            </p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                <span class="badge bg-{{ $ticket->status === 'paid' ? 'success' : ($ticket->status === 'pending' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </p>
                            <p class="mb-1">
                                <strong>Tanggal Pembelian:</strong> {{ $ticket->created_at->format('d M Y H:i') }}
                            </p>
                            @if($ticket->status === 'pending')
                                <p class="mb-1">
                                    <strong>Batas Pembayaran:</strong> {{ $ticket->payment_deadline->format('d M Y H:i') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h5>Data Pembeli</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1">
                                        <strong>Nama:</strong> {{ $ticket->name }}
                                    </p>
                                    <p class="mb-1">
                                        <strong>Email:</strong> {{ $ticket->email }}
                                    </p>
                                    <p class="mb-1">
                                        <strong>WhatsApp:</strong> {{ $ticket->whatsapp }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1">
                                        <strong>Jenis Identitas:</strong> {{ $ticket->identity_type }}
                                    </p>
                                    <p class="mb-1">
                                        <strong>Nomor Identitas:</strong> {{ $ticket->identity_number }}
                                    </p>
                                    <p class="mb-1">
                                        <strong>Alamat:</strong> {{ $ticket->address }}
                                    </p>
                                    <p class="mb-1">
                                        <strong>Kota:</strong> {{ $ticket->city }}, {{ $ticket->province }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($ticket->status === 'paid')
                        <div class="text-center mb-4">
                            <h5>QR Code</h5>
                            <img src="data:image/png;base64,{{ base64_encode($ticket->qr_code) }}" 
                                alt="QR Code" class="img-fluid" style="max-width: 200px;">
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary">
                            Kembali
                        </a>
                        <div>
                            @if($ticket->status === 'pending')
                                <form action="{{ route('admin.tickets.approve', $ticket) }}" 
                                    method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success" 
                                        onclick="return confirm('Apakah Anda yakin ingin menyetujui pembayaran tiket ini?')">
                                        Setujui Pembayaran
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.tickets.destroy', $ticket) }}" 
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">
                                    Hapus Tiket
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 