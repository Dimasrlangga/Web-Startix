@extends('layouts.app')

@section('title', 'Edit Event (Superadmin)')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Edit Event</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Event</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $event->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga Tiket</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $event->price) }}" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="event_date" class="form-label">Tanggal Event</label>
                            <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="venue" class="form-label">Venue</label>
                            <input type="text" class="form-control" id="venue" name="venue" value="{{ old('venue', $event->venue) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $event->city) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe Event</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">Pilih Tipe</option>
                                <option value="seminar" {{ old('type', $event->type) == 'seminar' ? 'selected' : '' }}>Seminar</option>
                                <option value="konser" {{ old('type', $event->type) == 'konser' ? 'selected' : '' }}>Konser</option>
                                <option value="workshop" {{ old('type', $event->type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="lainnya" {{ old('type', $event->type) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Kapasitas Tiket</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $event->capacity) }}" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Event (opsional)</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            @if($event->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$event->image) }}" alt="Gambar Event" class="img-fluid rounded" style="max-height:150px;">
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 