@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Pembayaran Tiket</h4>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">{{ $event->title }}</h5>
                    <div class="alert alert-info">
                        Silakan transfer ke rekening berikut:<br>
                        <strong>{{ $rekening['no'] }} A/n {{ $rekening['an'] }}</strong>
                    </div>
                    <form action="{{ route('events.payment.process', $event) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="sender_name" class="form-label">Nama Pengirim</label>
                            <input type="text" class="form-control" id="sender_name" name="sender_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="proof" class="form-label">Upload Bukti Transfer</label>
                            <input type="file" class="form-control" id="proof" name="proof" accept="image/*,application/pdf" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Konfirmasi Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 