<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'siswa');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jurusan' => ['required', 'string', 'in:RPL,MPLB'],
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa berhasil ditambahkan.');
    }

    public function edit(User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            abort(404);
        }
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            abort(404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$siswa->id],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$siswa->id],
            'password' => ['nullable', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'jurusan' => ['required', 'string', 'in:RPL,MPLB'],
        ]);

        $siswa->name = $request->name;
        $siswa->username = $request->username;
        $siswa->email = $request->email;
        $siswa->jurusan = $request->jurusan;
        
        // Update password HANYA jika diisi
        if ($request->filled('password')) {
            $siswa->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $siswa->save();

        return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa ' . $siswa->name . ' berhasil diperbarui.');
    }

    public function destroy(User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            abort(404);
        }
        
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa berhasil dihapus.');
    }
}
