@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Event Terbaru</h1>
    </div>

    <!-- Search and Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Events</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.acara') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="search" placeholder="Search events..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="type">
                        <option value="">All Types</option>
                        <option value="conference" {{ request('type') == 'conference' ? 'selected' : '' }}>Conference</option>
                        <option value="workshop" {{ request('type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                        <option value="seminar" {{ request('type') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="month">
                        <option value="">All Months</option>
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="year">
                        <option value="">All Years</option>
                        @foreach(range(date('Y'), date('Y')+2) as $y)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="venue">
                        <option value="">All Venues</option>
                        @foreach($venues as $venue)
                            <option value="{{ $venue }}" {{ request('venue') == $venue ? 'selected' : '' }}>{{ $venue }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Events List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Upcoming Events</h6>
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
                                <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Tidak ada event yang ditemukan.
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 