<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} - Event Ticketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: 1rem;
        }
        .sidebar .nav-link:hover {
            color: rgba(255,255,255,1);
            background: rgba(255,255,255,.1);
        }
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,.1);
        }
        .event-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }
        .event-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }
        .event-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .event-info i {
            width: 30px;
            color: #0d6efd;
        }
        .ticket-card {
            border: 2px solid #0d6efd;
            border-radius: 10px;
            padding: 20px;
        }
        .ticket-price {
            font-size: 2rem;
            color: #0d6efd;
            font-weight: bold;
        }
        .ticket-availability {
            font-size: 1.2rem;
            color: #198754;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="p-3">
                    <h4 class="text-center mb-4">Event Ticketing</h4>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('events.index') }}">
                                <i class="fas fa-home me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/events">
                                <i class="fas fa-calendar-alt me-2"></i> Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-4 py-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>{{ $event->title }}</h2>
                    <a href="{{ route('events.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>

                <div class="row">
                    <!-- Event Image -->
                    <div class="col-md-8 mb-4">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://via.placeholder.com/800x400' }}" 
                             class="event-image" 
                             alt="{{ $event->title }}">
                    </div>

                    <!-- Ticket Information -->
                    <div class="col-md-4">
                        <div class="ticket-card">
                            <h4 class="mb-4">Informasi Tiket</h4>
                            <div class="ticket-price mb-3">
                                {{ $event->formatted_price }}
                            </div>
                            <div class="ticket-availability mb-3">
                                <i class="fas fa-ticket-alt me-2"></i>
                                {{ $event->available_tickets }} tiket tersedia
                            </div>
                            <div class="mb-3">
                                <i class="fas fa-users me-2"></i>
                                Kapasitas: {{ $event->capacity }} orang
                            </div>
                            <button class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Beli Tiket
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Event Details -->
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="event-details">
                            <h4 class="mb-4">Detail Event</h4>
                            <div class="event-info">
                                <i class="fas fa-calendar"></i>
                                <div>
                                    <strong>Tanggal & Waktu</strong><br>
                                    {{ $event->formatted_date }}
                                </div>
                            </div>
                            <div class="event-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <strong>Lokasi</strong><br>
                                    {{ $event->venue }}, {{ $event->city }}
                                </div>
                            </div>
                            <div class="event-info">
                                <i class="fas fa-tag"></i>
                                <div>
                                    <strong>Jenis Event</strong><br>
                                    {{ ucfirst($event->type) }}
                                </div>
                            </div>
                            <div class="event-info">
                                <i class="fas fa-info-circle"></i>
                                <div>
                                    <strong>Deskripsi</strong><br>
                                    {{ $event->description }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Status -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Status Event</h5>
                                <div class="d-flex align-items-center mt-3">
                                    @if($event->status == 'upcoming')
                                        <span class="badge bg-success me-2">Upcoming</span>
                                    @elseif($event->status == 'ongoing')
                                        <span class="badge bg-primary me-2">Ongoing</span>
                                    @elseif($event->status == 'completed')
                                        <span class="badge bg-secondary me-2">Completed</span>
                                    @else
                                        <span class="badge bg-danger me-2">Cancelled</span>
                                    @endif
                                    <span>{{ ucfirst($event->status) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 