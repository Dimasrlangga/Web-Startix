@extends('layouts.app')

@section('title', 'Beli Tiket - ' . $event->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Form Pembelian Tiket</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tickets.store', $event) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="identity_type" class="form-label">Jenis Identitas</label>
                                <select class="form-select @error('identity_type') is-invalid @enderror" 
                                    id="identity_type" name="identity_type" required>
                                    <option value="">Pilih Jenis Identitas</option>
                                    <option value="KTP" {{ old('identity_type') == 'KTP' ? 'selected' : '' }}>KTP</option>
                                    <option value="SIM" {{ old('identity_type') == 'SIM' ? 'selected' : '' }}>SIM</option>
                                    <option value="Kartu Pelajar" {{ old('identity_type') == 'Kartu Pelajar' ? 'selected' : '' }}>Kartu Pelajar</option>
                                    <option value="Passport" {{ old('identity_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                                    <option value="KTA" {{ old('identity_type') == 'KTA' ? 'selected' : '' }}>KTA</option>
                                    <option value="KTM" {{ old('identity_type') == 'KTM' ? 'selected' : '' }}>KTM</option>
                                </select>
                                @error('identity_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="identity_number" class="form-label">Nomor Identitas</label>
                                <input type="text" class="form-control @error('identity_number') is-invalid @enderror" 
                                    id="identity_number" name="identity_number" value="{{ old('identity_number') }}" required>
                                @error('identity_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="province" class="form-label">Provinsi</label>
                                <select class="form-select @error('province') is-invalid @enderror" 
                                    id="province" name="province" required>
                                    <option value="">Pilih Provinsi</option>
                                    <!-- Daftar provinsi akan diisi dengan JavaScript -->
                                </select>
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">Kota/Kabupaten</label>
                                <select class="form-select @error('city') is-invalid @enderror" 
                                    id="city" name="city" required>
                                    <option value="">Pilih Kota/Kabupaten</option>
                                    <!-- Daftar kota akan diisi dengan JavaScript -->
                                </select>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="whatsapp" class="form-label">Nomor WhatsApp</label>
                                <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" 
                                    id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" required>
                                @error('whatsapp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5 class="alert-heading">Informasi Pembayaran</h5>
                            <p class="mb-0">
                                Total Pembayaran: <strong>Rp {{ number_format($event->price, 0, ',', '.') }}</strong><br>
                                Batas Waktu Pembayaran: <strong>30 menit</strong><br>
                                QR Code akan dikirim ke email Anda setelah pembayaran berhasil
                            </p>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Lanjutkan ke Pembayaran
                            </button>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-outline-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Script untuk mengisi daftar provinsi dan kota
document.addEventListener('DOMContentLoaded', function() {
    // Contoh data provinsi dan kota (dalam implementasi nyata, data ini bisa diambil dari API)
    const provinces = {
        'Jawa Barat': ['Bandung', 'Bekasi', 'Bogor', 'Cimahi', 'Depok'],
        'Jawa Tengah': ['Semarang', 'Solo', 'Yogyakarta', 'Magelang', 'Salatiga'],
        'Jawa Timur': ['Surabaya', 'Malang', 'Sidoarjo', 'Gresik', 'Pasuruan']
    };

    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');

    // Isi daftar provinsi
    for (const province in provinces) {
        const option = new Option(province, province);
        provinceSelect.add(option);
    }

    // Event listener untuk perubahan provinsi
    provinceSelect.addEventListener('change', function() {
        const selectedProvince = this.value;
        citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';

        if (selectedProvince && provinces[selectedProvince]) {
            provinces[selectedProvince].forEach(city => {
                const option = new Option(city, city);
                citySelect.add(option);
            });
        }
    });

    // Set nilai awal jika ada
    if ('{{ old('province') }}') {
        provinceSelect.value = '{{ old('province') }}';
        provinceSelect.dispatchEvent(new Event('change'));
        citySelect.value = '{{ old('city') }}';
    }
});
</script>
@endpush 