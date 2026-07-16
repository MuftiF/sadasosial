<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->has('role') && in_array($request->role, ['admin', 'user'])) {
            $query->where('role', $request->role);
        }

        // Account type filter (masyarakat / lembaga)
        if ($request->has('account_type') && in_array($request->account_type, ['masyarakat', 'lembaga'])) {
            $query->where('account_type', $request->account_type);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.users', compact('users'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Handle lembaga validation action from detail modal
        if ($request->has('validation_action')) {
            $validated = $request->validate([
                'validation_action' => ['required', 'in:validated,rejected'],
                'validation_note'   => ['nullable', 'string', 'max:500'],
            ]);

            $user->update([
                'validation_status' => $validated['validation_action'],
                'validation_note'   => $validated['validation_note'] ?? null,
            ]);

            $label = $validated['validation_action'] === 'validated' ? 'disetujui dan diaktifkan' : 'ditolak';
            return redirect()->route('admin.users.index')
                ->with('success', "Akun lembaga '{$user->nama_lembaga}' berhasil {$label}.");
        }

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role'     => ['required', Rule::in(['admin', 'user'])],
        ]);

        $updateData = [
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'role'  => $validated['role'],
        ];

        // Only update password if filled
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // Prevent self role downgrade
        if ($user->id === Auth::id() && $validated['role'] !== 'admin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menurunkan peran administrator Anda sendiri.');
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')
            ->with('success', 'Informasi user berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting self
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
