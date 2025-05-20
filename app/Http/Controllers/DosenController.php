<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $data = dosen::all();
        return view('admin.pages.dosen.dosen', ['dosen' => $data]);
    }

    public function create()
    {
        $data = dosen::all();
        $jurusan = Jurusan::all();
        return view('admin.pages.dosen.dosencreate', ['data' => $data, 'jurusans' => $jurusan]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namalengkap' => 'required|max:255',
            'nidn' => 'required|max:255',
            'jeniskelamin' => 'required',
            'nip' => 'required|max:255',
            'email' => 'required|max:255',
            'notelp' => 'required|max:255',
            'jurusan_id' => 'required|max:255'
        ]);
        $tambahdata = dosen::create($validatedData);
        if (!$tambahdata) {
            return redirect('/admin/dosen')->with('Failed', 'Data Gagal Ditambahkan');
        }
        return redirect('/admin/dosen')->with('Success', 'Data Berhasil Ditambahkan');
    }

    public function edit(dosen $dosen)
    {
        $jurusans = jurusan::all();
        return view('admin.pages.dosen.dosenedit', ['dosen' => $dosen], ['jurusans' => $jurusans]);
    }

    public function update(Request $request, dosen $dosen)
    {
        $validatedData = $request->validate([
            'namalengkap' => 'required|max:255',
            'jeniskelamin' => 'required',
            'nidn' => 'required|max:255|unique:dosens,nidn,' . $dosen->id,
            'nip' => 'required|max:255|unique:dosens,nip,' . $dosen->id,
            'email' => 'required|email|max:255|unique:dosens,email,' . $dosen->id,
            'notelp' => 'required|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $dosen->update($validatedData);
        return redirect('admin/dosen')->with('Success', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $data = dosen::findOrFail($id);
        $data->delete();
        return redirect('admin/dosen')->with('Success', 'Data Berhasil Dihapus');
    }
}
