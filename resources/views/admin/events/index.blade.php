@extends('layouts.app')

@section('title', 'Daftar Event (Admin)')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Event</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Harga</th>
                            <th>Tiket Tersedia</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->event_date }}</td>
                                <td>{{ $event->venue ?? $event->location }}</td>
                                <td>Rp {{ number_format($event->price, 0, ',', '.') }}</td>
                                <td>{{ $event->available_tickets ?? $event->capacity }} / {{ $event->capacity }}</td>
                                <td>
                                    @if(isset($event->event_date) && \Carbon\Carbon::parse($event->event_date)->isPast())
                                        <span class="badge bg-secondary">Selesai</span>
                                    @elseif(($event->available_tickets ?? $event->capacity) === 0)
                                        <span class="badge bg-danger">Habis</span>
                                    @else
                                        <span class="badge bg-success">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.events.show', $event) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada event</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 