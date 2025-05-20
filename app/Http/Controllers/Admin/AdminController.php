<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->orderBy('created_at', 'desc')->get();
        return view('admin.pages.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.pages.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'identity_type' => 'required',
            'identity_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'rfid' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $identityFilePath = $request->file('identity_file')->store('identity_files', 'public');
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'identity_type' => $request->identity_type,
            'identity_file' => $identityFilePath,
            'rfid' => $request->rfid,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return view('admin.pages.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$admin->id,
            'identity_type' => 'required',
            'identity_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'rfid' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->identity_type = $request->identity_type;
        $admin->rfid = $request->rfid;
        if ($request->hasFile('identity_file')) {
            $admin->identity_file = $request->file('identity_file')->store('identity_files', 'public');
        }
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil diupdate!');
    }

    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil dihapus!');
    }
} 