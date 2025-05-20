<?php

namespace App\Http\Controllers;

use App\Models\prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = prodi::all();

        return view('admin.pages.prodi.prodi', compact('prodi'));
    }

    public function create()
    {
        return view('admin.pages.prodi.prodicreate');
    }

    public function store(request $request)
    {
        $validatedData = $request->validate([
            'namaprodi' => 'required|max:255',
            'kodeprodi' => 'required|max:255|unique:prodis',
            'jenjangstudi' => 'required|max:255'

        ]);

        $tambahdata = prodi::create($validatedData);
        if (!$tambahdata) {
            return redirect('/admin/prodi')->with('Failed', 'Data Gagal Ditambahkan');
        }
        return redirect('/admin/prodi')->with('Success', 'Data Berhasil Ditambahkan');
    }

    public function edit(prodi $prodi)
    {
        $data = prodi::all();
        return view('admin.pages.prodi.prodiedit', ['prodi' => $prodi], ['data' => $data]);
    }

    public function update(Request $request, prodi $prodi)
    {
        $validatedData = $request->validate([
            'namaprodi' => 'required|max:255',
            'kodeprodi' => 'required|max:255|unique:prodis,kodeprodi,' . $prodi->id,
            'jenjangstudi' => 'required|max:255',
        ]);


        $prodi->update($validatedData);
        return redirect('admin/prodi')->with('Success', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $data = prodi::findOrFail($id);
        $data->delete();
        return redirect('admin/prodi')->with('Success', 'Data Berhasil Dihapus');
    }
}
