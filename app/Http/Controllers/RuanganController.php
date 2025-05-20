<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        // Mengambil semua data ruangan
        $ruangan = Ruangan::all();

        return view('admin.pages.ruangan.ruangan', compact('ruangan'));
    }

    public function create()
    {
        // Menampilkan form tambah data ruangan
        return view('admin.pages.ruangan.ruangancreate');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'kode_ruangan' => 'required|max:255|unique:ruangans',
            'nama_ruangan' => 'required|max:255',
            'gedung' => 'required|max:255',
            'lantai' => 'required|integer',
            'jenis_ruangan' => 'required|max:255',
            'kapasitas' => 'required|integer',
            'keterangan' => 'nullable|max:255',
        ]);

        // Menyimpan data ruangan
        $isSaved = Ruangan::create($validatedData);

        if (!$isSaved) {
            return redirect('/admin/ruangan')->with('Failed', 'Data Gagal Ditambahkan');
        }

        return redirect('/admin/ruangan')->with('Success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Ruangan $ruangan)
    {
        // Menampilkan form edit data ruangan
        return view('admin.pages.ruangan.ruanganedit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'kode_ruangan' => 'required|max:255|unique:ruangans,kode_ruangan,' . $ruangan->id,
            'nama_ruangan' => 'required|max:255',
            'gedung' => 'required|max:255',
            'lantai' => 'required|integer',
            'jenis_ruangan' => 'required|max:255',
            'kapasitas' => 'required|integer',
            'keterangan' => 'nullable|max:255',
        ]);

        // Mengupdate data ruangan
        $ruangan->update($validatedData);

        return redirect('/admin/ruangan')->with('Success', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        // Menghapus data ruangan
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect('/admin/ruangan')->with('Success', 'Data Berhasil Dihapus');
    }
}
