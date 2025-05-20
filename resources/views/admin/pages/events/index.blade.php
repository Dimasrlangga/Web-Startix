@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Daftar Event</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="mb-3">
        @if(auth()->check() && auth()->user()->role === 'superadmin')
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Tambah Event</a>
        @endif
    </div>
    <div class="card shadow mb-4 rounded-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Venue</th>
                            <th>Kota</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->formatted_date ?? $event->event_date }}</td>
                            <td>{{ $event->venue }}</td>
                            <td>{{ $event->city }}</td>
                            <td>{{ ucfirst($event->type) }}</td>
                            <td>Rp {{ number_format($event->price, 0, ',', '.') }}</td>
                            <td>
                                @if($event->status == 'upcoming')
                                    <span class="badge bg-success">Upcoming</span>
                                @else
                                    <span class="badge bg-secondary">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm mb-1"><i class="fas fa-eye"></i></a>
                                @if(auth()->check() && auth()->user()->role === 'superadmin')
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Belum ada event.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 