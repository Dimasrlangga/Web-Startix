@extends('user.layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Formulir Pemesanan Tiket</h4>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">{{ $event->title }}</h5>
                    <form id="orderForm" action="{{ route('events.order.process', $event) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="identity_type" class="form-label">Jenis Identitas</label>
                            <select class="form-select" id="identity_type" name="identity_type" required>
                                <option value="">Pilih Jenis Identitas</option>
                                <option value="KTP">KTP</option>
                                <option value="SIM">SIM</option>
                                <option value="Kartu Pelajar">Kartu Pelajar</option>
                                <option value="Paspor">Paspor</option>
                                <option value="KTA">KTA</option>
                                <option value="KTM">KTM</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="identity_number" class="form-label">Nomor Identitas</label>
                            <input type="text" class="form-control" id="identity_number" name="identity_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="province" class="form-label">Provinsi</label>
                                <select class="form-select" id="province" name="province" required>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province }}">{{ $province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">Kabupaten/Kota</label>
                                <select class="form-select" id="city" name="city" required>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="whatsapp" class="form-label">No WhatsApp</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" required>
                        </div>
                        <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#confirmModal">Lanjutkan Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Data -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Data Pemesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item"><strong>Nama Lengkap:</strong> <span id="conf_name"></span></li>
          <li class="list-group-item"><strong>Jenis Identitas:</strong> <span id="conf_identity_type"></span></li>
          <li class="list-group-item"><strong>Nomor Identitas:</strong> <span id="conf_identity_number"></span></li>
          <li class="list-group-item"><strong>Alamat:</strong> <span id="conf_address"></span></li>
          <li class="list-group-item"><strong>Provinsi:</strong> <span id="conf_province"></span></li>
          <li class="list-group-item"><strong>Kabupaten/Kota:</strong> <span id="conf_city"></span></li>
          <li class="list-group-item"><strong>Email:</strong> <span id="conf_email"></span></li>
          <li class="list-group-item"><strong>No WhatsApp:</strong> <span id="conf_whatsapp"></span></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-success" id="submitOrder">Ya, data sudah benar</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
// Isi data konfirmasi saat tombol diklik
const orderForm = document.getElementById('orderForm');
document.querySelector('[data-bs-target="#confirmModal"]').addEventListener('click', function() {
    document.getElementById('conf_name').innerText = orderForm.name.value;
    document.getElementById('conf_identity_type').innerText = orderForm.identity_type.value;
    document.getElementById('conf_identity_number').innerText = orderForm.identity_number.value;
    document.getElementById('conf_address').innerText = orderForm.address.value;
    document.getElementById('conf_province').innerText = orderForm.province.value;
    document.getElementById('conf_city').innerText = orderForm.city.value;
    document.getElementById('conf_email').innerText = orderForm.email.value;
    document.getElementById('conf_whatsapp').innerText = orderForm.whatsapp.value;
});
// Submit form jika user setuju
document.getElementById('submitOrder').addEventListener('click', function() {
    orderForm.submit();
});
</script>
@endpush
@endsection 