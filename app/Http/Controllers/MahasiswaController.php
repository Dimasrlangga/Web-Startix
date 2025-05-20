<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();
        return view('admin.pages.mahasiswa.mahasiswa', ['mahasiswa' => $data]);
    }

    public function create()
    {
        $prodi = Prodi::all();
        $jurusan = Jurusan::all();

        return view('admin.pages.mahasiswa.mahasiswacreate', [
            'prodis' => $prodi,
            'jurusans' => $jurusan,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namalengkap' => 'required|max:255',
            'nim' => 'required|unique:mahasiswas,nim|max:255',
            'jeniskelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'email' => 'required|email|unique:mahasiswas,email|max:255',
            'notelp' => 'required|max:255',
            'prodi_id' => 'required|exists:prodis,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'tgl_hari' => 'required|integer|min:1|max:31',
            'tgl_bulan' => 'required|integer|min:1|max:12',
            'tgl_tahun' => 'required|integer|min:1900|max:' . now()->year,
        ]);

        // Buat tanggal lahir dari input
        $tanggalLahir = Carbon::createFromDate(
            $request->tgl_tahun,
            $request->tgl_bulan,
            $request->tgl_hari
        );

        $validatedData['tgl'] = $tanggalLahir->format('Y-m-d');

        try {
            Mahasiswa::create($validatedData);
            return redirect('/admin/mahasiswa')->with('Success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect('/admin/mahasiswa')->with('Failed', 'Data Gagal Ditambahkan: ' . $e->getMessage());
        }
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $prodis = Prodi::all();
        $jurusans = Jurusan::all();

        // Pisahkan tanggal lahir menjadi hari, bulan, tahun
        $tanggalLahir = Carbon::parse($mahasiswa->tgl);
        return view('admin.pages.mahasiswa.mahasiswaedit', [
            'mahasiswa' => $mahasiswa,
            'prodis' => $prodis,
            'jurusans' => $jurusans,
            'tgl_hari' => $tanggalLahir->day,
            'tgl_bulan' => $tanggalLahir->month,
            'tgl_tahun' => $tanggalLahir->year,
        ]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
{
    // Validasi data yang diterima
    $validatedData = $request->validate([
        'namalengkap' => 'required|max:255',
        'jeniskelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
        'nim' => 'required|max:255|unique:mahasiswas,nim,' . $mahasiswa->id,
        'email' => 'required|email|max:255|unique:mahasiswas,email,' . $mahasiswa->id,
        'notelp' => 'required|max:255',
        'prodi_id' => 'required|exists:prodis,id',
        'jurusan_id' => 'required|exists:jurusans,id',
        'tanggal' => 'required|integer|min:1|max:31',
        'bulan' => 'required|integer|min:1|max:12',
        'tahun' => 'required|integer|min:1900|max:' . now()->year,
    ]);

    // Update tanggal lahir
    $tanggalLahir = Carbon::createFromDate(
        $request->tahun,
        $request->bulan,
        $request->tanggal
    );

    $validatedData['tgl'] = $tanggalLahir->format('Y-m-d');

    // Update data mahasiswa
    try {
        $mahasiswa->update($validatedData);
        return redirect('admin/mahasiswa')->with('Success', 'Data Berhasil Diupdate');
    } catch (\Exception $e) {
        return redirect('admin/mahasiswa')->with('Failed', 'Data Gagal Diupdate: ' . $e->getMessage());
    }
}


    public function destroy($id)
    {
        $data = Mahasiswa::findOrFail($id);
        try {
            // Hapus gambar jika ada
            if ($data->image && Storage::exists($data->image)) {
                Storage::delete($data->image);
            }
            $data->delete();
            return redirect('admin/mahasiswa')->with('Success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect('admin/mahasiswa')->with('Failed', 'Data Gagal Dihapus: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.pages.mahasiswa.mahasiswadetail', compact('mahasiswa'));
    }
}
