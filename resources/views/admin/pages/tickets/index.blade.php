@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Daftar Pembelian Tiket</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin'))
    <a href="{{ route('admin.tickets.export-excel') }}" class="btn btn-success mb-3">
        <i class="fas fa-file-excel"></i> Download Excel (QR Code)
    </a>
    @endif
    <div class="card shadow mb-4 rounded-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Event</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No WhatsApp</th>
                            <th>Status</th>
                            <th>Bukti Transfer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="fw-semibold">{{ $order->event->title ?? '-' }}</span></td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->whatsapp }}</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark px-3 py-2"><i class="fas fa-hourglass-half me-1"></i> Pending</span>
                                @else
                                    <span class="badge bg-success px-3 py-2"><i class="fas fa-check-circle me-1"></i> Confirmed</span>
                                @endif
                            </td>
                            <td>
                                @if($order->proof)
                                    <a href="{{ asset('storage/'.$order->proof) }}" target="_blank" class="btn btn-outline-primary btn-sm px-2 py-1"><i class="fas fa-image me-1"></i> Lihat Bukti</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.tickets.show', $order->id) }}" class="btn btn-info btn-sm px-2 py-1 mb-1">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                @if($order->status == 'confirmed')
                                    <a href="{{ route('admin.tickets.download-qr', $order->id) }}" class="btn btn-success btn-sm px-2 py-1 mb-1">
                                        <i class="fas fa-qrcode"></i> Download QR
                                    </a>
                                @else
                                    <button type="button" class="btn btn-secondary btn-sm px-2 py-1 mb-1" onclick="alert('Tiket belum dikonfirmasi!')" disabled>
                                        <i class="fas fa-qrcode"></i> Download QR
                                    </button>
                                @endif
                                @if($order->status == 'pending')
                                <form action="{{ route('admin.tickets.update', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm px-2 py-1 mb-1" onclick="return confirm('Konfirmasi order ini?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada pembelian tiket.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 