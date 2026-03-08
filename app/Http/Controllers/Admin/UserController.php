<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->get();
        return view('admin.system.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.system.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','string','min:6','confirmed'],
            'role_id' => ['required','exists:roles,id'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
        ]);

        return redirect()->route('admin.system.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.system.users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->role?->name === 'superadmin') {
            $data['role_id'] = $user->role_id;
        }

        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => [
                'required','email','max:255',
                Rule::unique('users','email')->ignore($user->id),
            ],
            'role_id' => ['required','exists:roles,id'],
            'password' => ['nullable','string','min:6','confirmed'],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role_id = $data['role_id'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('admin.system.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.system.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function importForm()
    {
        if (!auth()->user()->hasRole('superadmin')) {
            abort(403);
        }
        return view('admin.system.users.import');
    }

    public function importStore(Request $request)
    {
        if (!auth()->user()->hasRole('superadmin')) {
            abort(403);
        }

        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx,csv,txt|max:4096'
        ]);

        $rows = Excel::toArray(new \stdClass, $request->file('file'));

        if (empty($rows) || empty($rows[0])) {
            return back()->with('error', 'File Excel/CSV kosong atau tidak bisa dibaca.');
        }

        $data = $rows[0];
        $header = array_shift($data);

        if (!$header || count($header) < 4) {
            return back()->with('error', 'Format Excel tidak valid. Minimal 4 kolom: Nama, Email, Password, Role.');
        }

        $roles = Role::all()->pluck('id', 'name')->toArray();
        $inserted = 0;
        $errors = [];

        foreach ($data as $index => $row) {
            $name = trim($row[0] ?? '');
            $email = trim($row[1] ?? '');
            $password = trim($row[2] ?? '');
            $roleName = strtolower(trim($row[3] ?? ''));

            if (!$name || !$email || !$password) continue;

            if (User::where('email', $email)->exists()) {
                $errors[] = "Baris " . ($index + 2) . ": Email $email sudah digunakan.";
                continue;
            }

            $roleId = $roles[$roleName] ?? null;
            if (!$roleId) {
                $errors[] = "Baris " . ($index + 2) . ": Role '$roleName' tidak ditemukan.";
                continue;
            }

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role_id' => $roleId,
            ]);

            $inserted++;
        }

        $msg = "Import berhasil: $inserted user ditambahkan.";
        if (!empty($errors)) {
            $msg .= " Namun ada beberapa error: " . implode(', ', $errors);
            return redirect()->route('admin.system.users.index')->with('warning', $msg);
        }

        return redirect()->route('admin.system.users.index')->with('success', $msg);
    }
}