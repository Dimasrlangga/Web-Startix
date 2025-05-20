@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Tambah Admin</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="identity_type" class="form-label">Jenis Identitas</label>
                            <select class="form-select" id="identity_type" name="identity_type" required>
                                <option value="">Pilih Jenis Identitas</option>
                                <option value="KTP">KTP</option>
                                <option value="SIM">SIM</option>
                                <option value="Paspor">Paspor</option>
                                <option value="Kartu Pelajar">Kartu Pelajar</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="identity_file" class="form-label">Upload Foto Identitas</label>
                            <input type="file" class="form-control" id="identity_file" name="identity_file" accept="image/*,application/pdf" required>
                        </div>
                        <div class="mb-3">
                            <label for="rfid" class="form-label">ID RFID</label>
                            <input type="text" class="form-control" id="rfid" name="rfid" value="{{ old('rfid') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 