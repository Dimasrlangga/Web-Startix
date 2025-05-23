@extends('user.layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">{{ $event->title }}</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Deskripsi</dt>
                        <dd class="col-sm-8">{{ $event->description }}</dd>
                        <dt class="col-sm-4">Tanggal</dt>
                        <dd class="col-sm-8">{{ $event->event_date }}</dd>
                        <dt class="col-sm-4">Venue</dt>
                        <dd class="col-sm-8">{{ $event->venue }}</dd>
                        <dt class="col-sm-4">Kota</dt>
                        <dd class="col-sm-8">{{ $event->city }}</dd>
                        <dt class="col-sm-4">Tipe</dt>
                        <dd class="col-sm-8">{{ ucfirst($event->type) }}</dd>
                        <dt class="col-sm-4">Harga</dt>
                        <dd class="col-sm-8">Rp {{ number_format($event->price, 0, ',', '.') }}</dd>
                        <dt class="col-sm-4">Kapasitas</dt>
                        <dd class="col-sm-8">{{ $event->capacity }}</dd>
                        <dt class="col-sm-4">Tiket Terjual</dt>
                        <dd class="col-sm-8">{{ $sold }} / {{ $event->capacity }}</dd>
                    </dl>
                    @if($event->status === 'upcoming' && $sold < $event->capacity)
                        <a href="{{ route('events.order', $event->id) }}" class="btn btn-success w-100">Pesan Tiket</a>
                    @else
                        <div class="alert alert-warning text-center mt-3">Tiket sudah habis atau event telah selesai.</div>
                    @endif
                    <a href="{{ route('events.index') }}" class="btn btn-secondary w-100 mt-2">Kembali ke Daftar Event</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 