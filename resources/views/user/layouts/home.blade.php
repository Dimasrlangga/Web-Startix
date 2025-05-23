@extends('user.layouts.header')

@section('content')
<style>
    .carousel-inner img {
        height: 538px;
        object-fit: cover;
        object-position: center;
        width: 100%;
    }
    .carousel {
        width: 100vw;
        margin-left: calc(-50vw + 50%);
    }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
    }
</style>

<!-- Carousel -->
<div id="coverSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/alam.jpg') }}" class="d-block w-100" alt="Cover 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/bukit.jpg') }}" class="d-block w-100" alt="Cover 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/logo4.png') }}" class="d-block w-100" alt="Cover 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#coverSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Sebelumnya</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#coverSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Berikutnya</span>
    </button>
</div>

<!-- Upcoming Events -->
<div class="card shadow mb-4 mt-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Events</h6>
    </div>
    <div class="card-body">
        <div class="row">
            @forelse($events as $event)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">
                                <i class="fas fa-calendar-alt"></i> {{ $event->formatted_date }}<br>
                                <i class="fas fa-map-marker-alt"></i> {{ $event->venue }}, {{ $event->city }}<br>
                                <i class="fas fa-tag"></i> {{ ucfirst($event->type) }}<br>
                                <i class="fas fa-ticket-alt"></i> Rp {{ number_format($event->price, 0, ',', '.') }}
                            </p>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-success">
                                <i class="bi bi-bag-heart"></i> Beli
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Tidak ada event yang ditemukan.</div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
