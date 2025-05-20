@extends('layouts.app')

@section('title', 'Kelola Tiket')

@section('content')
<div class="container">
    <h1 class="mb-4">Kelola Tiket</h1>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kode Tiket</th>
                            <th>Event</th>
                            <th>Pembeli</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Tanggal Pembelian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->ticket_code }}</td>
                                <td>{{ $ticket->event->title }}</td>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ $ticket->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $ticket->status === 'paid' ? 'success' : ($ticket->status === 'pending' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.tickets.show', $ticket) }}" 
                                            class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($ticket->status === 'pending')
                                            <form action="{{ route('admin.tickets.approve', $ticket) }}" 
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui pembayaran tiket ini?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.tickets.destroy', $ticket) }}" 
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada tiket</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($tickets->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 