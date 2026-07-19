<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileUpdateRequest;
use App\Models\DataValidationLog;
use App\Models\AccessAuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
        if ($request->has('role') && in_array($request->role, ['admin', 'sekretariat', 'verifikator', 'dinsos_wilayah', 'bidang_pemberdayaan', 'bidang_linjamsos', 'kadinas', 'user'])) {
            $query->where('role', $request->role);
        }

        // Account type filter (masyarakat / lembaga)
        if ($request->has('account_type') && in_array($request->account_type, ['masyarakat', 'lembaga'])) {
            $query->where('account_type', $request->account_type);
        }

        // Eager load validation logs for detail modal
        $users = $query->with(['validationLogs'])->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Fetch pending profile change requests
        $profileRequests = ProfileUpdateRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch audit logs
        $accessAuditLogs = AccessAuditLog::with(['admin', 'targetUser'])
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        return view('admin.users', compact('users', 'profileRequests', 'accessAuditLogs'));
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
            'role' => ['required', Rule::in(['admin', 'sekretariat', 'verifikator', 'dinsos_wilayah', 'bidang_pemberdayaan', 'bidang_linjamsos', 'kadinas', 'user'])],
        ]);

        $newUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // Log audit
        AccessAuditLog::create([
            'admin_id' => Auth::id(),
            'target_user_id' => $newUser->id,
            'action' => 'user_create',
            'details' => "Membuat user baru: {$newUser->name} ({$newUser->email}) dengan peran {$newUser->role}.",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Handle validation action from detail modal (Akun Aktivasi)
        if ($request->has('validation_action')) {
            $validated = $request->validate([
                'validation_action' => ['required', 'in:validated,rejected'],
                'validation_note'   => ['nullable', 'string', 'max:500'],
            ]);

            $oldStatus = $user->validation_status;

            $user->update([
                'validation_status' => $validated['validation_action'],
                'validation_note'   => $validated['validation_note'] ?? null,
            ]);

            // Log access update audit
            AccessAuditLog::create([
                'admin_id'       => Auth::id(),
                'target_user_id' => $user->id,
                'action'         => 'status_update',
                'details'        => "Mengubah status verifikasi dari '{$oldStatus}' menjadi '{$validated['validation_action']}'. Catatan: " . ($validated['validation_note'] ?? 'Tidak ada catatan.'),
                'ip_address'     => $request->ip(),
                'user_agent'     => $request->userAgent(),
            ]);

            $label = $validated['validation_action'] === 'validated' ? 'disetujui dan diaktifkan' : 'ditolak';
            $name = $user->isLembaga() ? $user->nama_lembaga : $user->name;
            $typeLabel = $user->isLembaga() ? 'lembaga' : 'masyarakat';
            return redirect()->route('admin.users.index')
                ->with('success', "Akun {$typeLabel} '{$name}' berhasil {$label}.");
        }

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'role'     => ['required', Rule::in(['admin', 'sekretariat', 'verifikator', 'dinsos_wilayah', 'bidang_pemberdayaan', 'bidang_linjamsos', 'kadinas', 'user'])],
        ]);

        $oldRole = $user->role;

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

        if ($oldRole !== $validated['role']) {
            // Log role change audit
            AccessAuditLog::create([
                'admin_id'       => Auth::id(),
                'target_user_id' => $user->id,
                'action'         => 'role_update',
                'details'        => "Mengubah peran dari '{$oldRole}' menjadi '{$validated['role']}'.",
                'ip_address'     => $request->ip(),
                'user_agent'     => $request->userAgent(),
            ]);
        }

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

        $name = $user->name;
        $email = $user->email;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Simulate Integrated Data Validation (Subproses 1.5).
     */
    public function validateData(Request $request, User $user)
    {
        $validated = $request->validate([
            'source' => ['required', 'in:Dukcapil,SIKS-NG,AHU,OSS,NPWP'],
        ]);

        $source = $validated['source'];
        $status = 'matched';
        $notes = '';
        $rawResponse = [];

        // Simple mock system for validation responses
        if ($source === 'Dukcapil') {
            if (empty($user->nik) || strlen($user->nik) !== 16 || str_starts_with($user->nik, '99')) {
                $status = 'mismatch';
                $notes = 'NIK tidak ditemukan di database kependudukan nasional (Dukcapil).';
            } else {
                $status = 'matched';
                $notes = 'Data NIK, Nomor KK, dan Nama Lengkap sesuai dengan database Dukcapil.';
                $rawResponse = [
                    'nik' => $user->nik,
                    'no_kk' => $user->no_kk,
                    'nama' => $user->name,
                    'status_aktif' => 'Aktif',
                    'provinsi' => 'Sumatera Utara',
                ];
            }
        } elseif ($source === 'SIKS-NG') {
            if (empty($user->nik) || str_starts_with($user->nik, '99')) {
                $status = 'mismatch';
                $notes = 'NIK tidak terdaftar dalam Data Terpadu Kesejahteraan Sosial (DTKS) SIKS-NG.';
            } else {
                $status = 'matched';
                $notes = 'NIK terdaftar di SIKS-NG sebagai penerima Program PKH & BPNT.';
                $rawResponse = [
                    'nik' => $user->nik,
                    'status_dtks' => 'Terdaftar (Desil 2)',
                    'pkh' => 'Aktif',
                    'bpnt' => 'Aktif',
                ];
            }
        } elseif ($source === 'AHU') {
            if (empty($user->no_akta) || strlen($user->no_akta) < 4) {
                $status = 'mismatch';
                $notes = 'Nomor Akta Pendirian tidak ditemukan di AHU Kemenkumham.';
            } else {
                $status = 'matched';
                $notes = 'Lembaga terdaftar aktif di Direktorat Jenderal Administrasi Hukum Umum (AHU).';
                $rawResponse = [
                    'nama_lembaga' => $user->nama_lembaga,
                    'no_akta' => $user->no_akta,
                    'status' => 'TERDAFTAR',
                    'tanggal_pengesahan' => '2020-04-12',
                ];
            }
        } elseif ($source === 'OSS') {
            if (empty($user->no_akta)) {
                $status = 'mismatch';
                $notes = 'Lembaga belum terdaftar di Sistem Online Single Submission (OSS).';
            } else {
                $status = 'matched';
                $notes = 'NIB aktif dan legalitas usaha/lembaga tervalidasi di OSS.';
                $rawResponse = [
                    'nama_lembaga' => $user->nama_lembaga,
                    'nib' => '1203009384812',
                    'status' => 'AKTIF',
                    'klasifikasi' => 'Mikro/Kecil',
                ];
            }
        } elseif ($source === 'NPWP') {
            if (empty($user->npwp) || strlen($user->npwp) !== 16 || str_starts_with($user->npwp, '99')) {
                $status = 'mismatch';
                $notes = 'NPWP tidak valid atau tidak aktif di DJP Online.';
            } else {
                $status = 'matched';
                $notes = 'NPWP terdaftar aktif dan status wajib pajak berstatus Valid.';
                $rawResponse = [
                    'npwp' => $user->npwp,
                    'nama_wp' => $user->nama_lembaga,
                    'status_wp' => 'VALID',
                ];
            }
        }

        // Save log
        DataValidationLog::create([
            'user_id' => $user->id,
            'source' => $source,
            'status' => $status,
            'checked_by' => Auth::id(),
            'notes' => $notes,
            'raw_response' => $rawResponse,
        ]);

        return redirect()->back()->with('success', "Validasi data via {$source} selesai: " . ucfirst($status) . ". " . $notes);
    }

    /**
     * Handle Profile Request approvals (Subproses 1.3 & 1.4).
     */
    public function handleProfileRequest(Request $request, ProfileUpdateRequest $profileRequest)
    {
        $validated = $request->validate([
            'action' => ['required', 'in:approved,rejected'],
            'rejection_reason' => ['nullable', 'string', 'max:500'],
        ]);

        $user = $profileRequest->user;

        if ($validated['action'] === 'approved') {
            $changes = $profileRequest->requested_changes;
            $changesToLog = [];

            // Begin database transaction
            DB::transaction(function() use ($user, $changes, $profileRequest, &$changesToLog) {
                // Update user details
                $userUpdate = [];
                foreach ($changes as $key => $val) {
                    // If it is dokumen_legalitas, move file from temp folder if needed or just keep it
                    if ($key === 'dokumen_legalitas' && str_contains($val, 'legalitas_temp')) {
                        $newPath = str_replace('legalitas_temp', 'legalitas', $val);
                        // Laravel storage move
                        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($val)) {
                            \Illuminate\Support\Facades\Storage::disk('public')->move($val, $newPath);
                            $val = $newPath;
                        }
                    }

                    $changesToLog[] = [
                        'user_id' => $user->id,
                        'field_changed' => $key,
                        'old_value' => $user->$key,
                        'new_value' => $val,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $userUpdate[$key] = $val;
                }

                $user->update($userUpdate);

                // Save to history changes
                DB::table('profile_changes')->insert($changesToLog);

                // Update request status
                $profileRequest->update([
                    'status' => 'approved',
                ]);
            });

            // Log access control audit
            AccessAuditLog::create([
                'admin_id' => Auth::id(),
                'target_user_id' => $user->id,
                'action' => 'profile_approved',
                'details' => "Menyetujui perubahan profil pengguna. Field yang diperbarui: " . implode(', ', array_keys($changes)),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->back()->with('success', "Permohonan perubahan profil '{$user->name}' disetujui dan diperbarui.");

        } else {
            // Rejected
            $profileRequest->update([
                'status' => 'rejected',
                'rejection_reason' => $validated['rejection_reason'] ?? 'Ditolak oleh admin.',
            ]);

            // Log access control audit
            AccessAuditLog::create([
                'admin_id' => Auth::id(),
                'target_user_id' => $user->id,
                'action' => 'profile_rejected',
                'details' => "Menolak perubahan profil pengguna. Catatan: " . ($validated['rejection_reason'] ?? 'Tanpa alasan.'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->back()->with('success', "Permohonan perubahan profil '{$user->name}' ditolak.");
        }
    }
}
