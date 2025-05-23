@extends('layouts.app')

@section('title', 'Daftar Event')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Event</h1>

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($event->image)
                        <img src="{{ Storage::url($event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                    @else
                        <img src="{{ asset('images/default-event.jpg') }}" class="card-img-top" alt="Default Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text text-muted">
                            <i class="fas fa-calendar"></i> {{ $event->event_date->format('d M Y H:i') }}
                        </p>
                        <p class="card-text text-muted">
                            <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                        </p>
                        <p class="card-text">
                            {{ Str::limit($event->description, 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $events->links() }}
    </div>
</div>
@endsection 