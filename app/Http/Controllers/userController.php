<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        $user = user::all();

        return view('admin.pages.user.user', compact('user'));
    }

    public function create()
    {
        return view('admin.pages.user.usercreate');
    }

    public function store(request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'role' => 'required|max:255'

        ]);

        $validatedData['password'] = hash::make('12345678');

        $tambahdata = user::create($validatedData);
        if (!$tambahdata) {
            return redirect('/admin/user')->with('Failed', 'Data Gagal Ditambahkan');
        }
        return redirect('/admin/user')->with('Success', 'Data Berhasil Ditambahkan');
    }

    public function edit(user $user)
    {
        $data = user::all();
        return view('admin.pages.user.useredit', ['user' => $user], ['data' => $data]);
    }

    public function update(Request $request, user $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Menjaga email yang sama pada user yang sedang diedit
            'role' => 'required|max:255'
        ]);


        if (empty($validatedData['password'])) {
            $validatedData['password'] = $user->password;
        }
        $validatedData['password'] = hash::make('12345678');

        $user->update($validatedData);
        return redirect('admin/user')->with('Success', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $data = user::findOrFail($id);
        $data->delete();
        return redirect('admin/user')->with('Success', 'Data Berhasil Dihapus');
    }
}
