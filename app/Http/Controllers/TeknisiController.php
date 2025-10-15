<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeknisiController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->get('role', 'teknisi');
        $users = User::where('role', $role)->latest()->paginate(10);
// dd($users);
        return view('admin.user-kelola-admin', compact('users', 'role'));
    }

    public function create(Request $request)
    {
        $role = $request->get('role', 'teknisi');
        return view('admin.user-tambah-admin', compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'departemen' => 'required|string|max:255',
            'password'   => 'required|string|min:6',
            'role'       => 'required|string',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'departemen' => $request->departemen,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
        ]);

        return redirect()->route('teknisi.index', ['role' => $request->role])
                         ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $teknisi)
    {
        return view('admin.user-tambah-admin', compact('teknisi'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'departemen' => 'required|string|max:255',
            'password'   => 'nullable|string|min:6',
        ]);

        $user->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'departemen' => $request->departemen,
            'password'   => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('teknisi.index', ['role' => $user->role])
                         ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $teknisi)
    {
        $role = $teknisi->role;
        $teknisi->delete();

        return redirect()->route('teknisi.index', ['role' => $role])
                         ->with('success', 'User berhasil dihapus!');
    }
}
