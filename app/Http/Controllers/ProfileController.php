<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        $pendingRequest = ProfileUpdateRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();
            
        return view('profile.edit', compact('user', 'pendingRequest'));
    }

    /**
     * Submit a profile update request.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Check if there is already a pending request
        $existingRequest = ProfileUpdateRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Anda masih memiliki permohonan perubahan profil yang sedang ditinjau.');
        }

        $changes = [];

        if ($user->isLembaga()) {
            $validated = $request->validate([
                'name'              => ['required', 'string', 'max:255'],
                'nama_lembaga'      => ['required', 'string', 'max:255'],
                'jenis_lembaga'     => ['required', 'in:perusahaan,lks,instansi_pemerintah,organisasi_sosial'],
                'no_akta'           => ['required', 'string', 'max:100'],
                'npwp'              => ['required', 'digits:16'],
                'alamat_lembaga'    => ['required', 'string'],
                'dokumen_legalitas' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'kontak'            => ['nullable', 'string', 'max:20'],
                'alamat'            => ['nullable', 'string'],
            ], [
                'name.required'           => 'Nama penanggung jawab wajib diisi.',
                'nama_lembaga.required'   => 'Nama lembaga wajib diisi.',
                'jenis_lembaga.required'  => 'Jenis lembaga wajib dipilih.',
                'no_akta.required'        => 'Nomor akta pendirian wajib diisi.',
                'npwp.required'           => 'NPWP wajib diisi.',
                'npwp.digits'             => 'NPWP harus terdiri dari 16 digit angka.',
                'alamat_lembaga.required' => 'Alamat lembaga wajib diisi.',
                'dokumen_legalitas.mimes' => 'Dokumen harus berformat PDF, JPG, atau PNG.',
                'dokumen_legalitas.max'   => 'Ukuran dokumen maksimal 5MB.',
            ]);

            // Compare fields
            $fields = ['name', 'nama_lembaga', 'jenis_lembaga', 'no_akta', 'npwp', 'alamat_lembaga', 'kontak', 'alamat'];
            foreach ($fields as $field) {
                if ($user->$field != $validated[$field]) {
                    $changes[$field] = $validated[$field];
                }
            }

            // Handle file upload
            if ($request->hasFile('dokumen_legalitas')) {
                $path = $request->file('dokumen_legalitas')->store('legalitas_temp', 'public');
                $changes['dokumen_legalitas'] = $path;
            }

        } else {
            $validated = $request->validate([
                'name'   => ['required', 'string', 'max:255'],
                'kontak' => ['required', 'string', 'max:20'],
                'alamat' => ['required', 'string'],
            ], [
                'name.required'   => 'Nama lengkap wajib diisi.',
                'kontak.required' => 'Nomor kontak wajib diisi.',
                'alamat.required' => 'Alamat wajib diisi.',
            ]);

            // Compare fields
            $fields = ['name', 'kontak', 'alamat'];
            foreach ($fields as $field) {
                if ($user->$field != $validated[$field]) {
                    $changes[$field] = $validated[$field];
                }
            }
        }

        if (empty($changes)) {
            return redirect()->back()->with('success', 'Tidak ada perubahan data yang diajukan.');
        }

        // Create a profile update request
        ProfileUpdateRequest::create([
            'user_id'           => $user->id,
            'requested_changes' => $changes,
            'status'            => 'pending',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Permohonan perubahan profil berhasil diajukan dan sedang menunggu persetujuan admin.');
    }
}
