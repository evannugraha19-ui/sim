<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->get('role', 'user');
        $users = User::where('role', $role)->latest()->paginate(10);

        return view('admin.user-kelola-admin', compact('users', 'role'));
    }

    public function create(Request $request)
    {
        $role = $request->get('role', 'user');
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

        return redirect()->route('users.index', ['role' => $request->role])
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin.user-tambah-admin', compact('user'));
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

        return redirect()->route('users.index', ['role' => $user->role])
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $role = $user->role;
        $user->delete();

        return redirect()->route('users.index', ['role' => $role])
            ->with('success', 'User berhasil dihapus!');
    }
}
