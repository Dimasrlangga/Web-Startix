@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-primary">Detail Pembelian Tiket</h4>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">Event: <span class="fw-semibold">{{ $order->event->title ?? '-' }}</span></h5>
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>Nama:</strong> {{ $order->name }}</li>
                        <li class="list-group-item"><strong>Jenis Identitas:</strong> {{ $order->identity_type }}</li>
                        <li class="list-group-item"><strong>Nomor Identitas:</strong> {{ $order->identity_number }}</li>
                        <li class="list-group-item"><strong>Alamat:</strong> {{ $order->address }}</li>
                        <li class="list-group-item"><strong>Provinsi:</strong> {{ $order->province }}</li>
                        <li class="list-group-item"><strong>Kabupaten/Kota:</strong> {{ $order->city }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $order->email }}</li>
                        <li class="list-group-item"><strong>No WhatsApp:</strong> {{ $order->whatsapp }}</li>
                        <li class="list-group-item"><strong>Status:</strong> 
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-success">Confirmed</span>
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Nama Pengirim:</strong> {{ $order->sender_name }}</li>
                        <li class="list-group-item"><strong>Bukti Transfer:</strong>
                            @if($order->proof)
                                <a href="{{ asset('storage/'.$order->proof) }}" target="_blank" class="btn btn-outline-primary btn-sm ms-2"><i class="fas fa-image me-1"></i> Lihat Bukti</a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </li>
                    </ul>
                    @if($order->status == 'pending')
                    <form action="{{ route('admin.tickets.update', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success"><i class="fas fa-check me-1"></i> Konfirmasi Order</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 