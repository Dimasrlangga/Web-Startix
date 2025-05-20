@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Event</h1>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Event Details -->
            <div class="card shadow mb-4">
                <img src="{{ $event->image_url }}" class="card-img-top" alt="{{ $event->title }}" style="height: 400px; object-fit: cover;">
                <div class="card-body">
                    <h2 class="card-title mb-3">{{ $event->title }}</h2>
                    
                    <div class="mb-4">
                        <h5 class="text-primary">Deskripsi Event</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <div class="mb-2">
                            <span class="badge bg-info text-dark">{{ $sold }}/{{ $event->capacity }} tiket sudah terjual</span>
                        </div>
                        @guest
                        <a href="{{ route('events.order', $event) }}" class="btn btn-success mt-3">
                            <i class="fas fa-ticket-alt me-2"></i> Beli Tiket
                        </a>
                        @endguest
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Informasi Event</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    {{ $event->formatted_date }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    {{ $event->venue }}, {{ $event->city }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-tag me-2"></i>
                                    {{ ucfirst($event->type) }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-ticket-alt me-2"></i>
                                    Rp {{ number_format($event->price, 0, ',', '.') }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-users me-2"></i>
                                    Kapasitas: {{ $event->capacity }} orang
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-ticket-alt me-2"></i>
                                    Tiket Tersedia: {{ $event->available_tickets }} tiket
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Status Event</h5>
                            <div class="alert {{ $event->status === 'upcoming' ? 'alert-success' : 'alert-warning' }}">
                                <i class="fas fa-info-circle me-2"></i>
                                {{ ucfirst($event->status) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Event Stats -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Event</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Total Tiket Terjual</h6>
                        <h4>{{ $sold }} / {{ $event->capacity }}</h4>
                    </div>
                    @auth
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Pendapatan</h6>
                        <h4>Rp {{ number_format($revenue, 0, ',', '.') }}</h4>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 