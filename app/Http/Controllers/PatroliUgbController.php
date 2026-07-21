<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatroliUgb;
use App\Models\AccessAuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PatroliUgbController extends Controller
{
    /**
     * Daftar rencana & laporan patroli UGB.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $query = PatroliUgb::with('petugas')->latest();

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $patrolis = $query->paginate(15);

        $stats = [
            'rencana'     => PatroliUgb::where('status', 'rencana')->count(),
            'pelaksanaan' => PatroliUgb::where('status', 'pelaksanaan')->count(),
            'selesai'     => PatroliUgb::where('status', 'selesai')->count(),
        ];

        return view('admin.patroli_ugb.index', compact('user', 'patrolis', 'stats'));
    }

    /**
     * Form buat rencana patroli baru.
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $jenisOptions = PatroliUgb::jenisOptions();

        return view('admin.patroli_ugb.form', compact('user', 'jenisOptions'));
    }

    /**
     * Simpan rencana patroli baru.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $validated = $request->validate([
            'tanggal_rencana'           => 'required|date',
            'lokasi'                    => 'required|string|max:500',
            'pembagian_tugas'           => 'nullable|array',
            'pembagian_tugas.*.nama'    => 'required_with:pembagian_tugas|string|max:255',
            'pembagian_tugas.*.jabatan' => 'nullable|string|max:255',
            'pembagian_tugas.*.tugas'   => 'nullable|string|max:500',
            // Temuan pelanggaran (opsional saat rencana)
            'nama_penyelenggara_temuan' => 'nullable|string|max:500',
            'jenis_pelanggaran'         => 'nullable|string|max:100',
            'tanggal_temuan'            => 'nullable|date',
            'bukti_foto_temuan'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_foto_temuan')) {
            $buktiPath = $request->file('bukti_foto_temuan')->store('patroli_ugb/temuan', 'public');
        }

        $patroli = PatroliUgb::create([
            'petugas_id'                => $user->id,
            'tanggal_rencana'           => $validated['tanggal_rencana'],
            'lokasi'                    => $validated['lokasi'],
            'pembagian_tugas'           => $validated['pembagian_tugas'] ?? null,
            'nama_penyelenggara_temuan' => $validated['nama_penyelenggara_temuan'] ?? null,
            'jenis_pelanggaran'         => $validated['jenis_pelanggaran'] ?? null,
            'tanggal_temuan'            => $validated['tanggal_temuan'] ?? null,
            'bukti_foto_temuan'         => $buktiPath,
            'status'                    => 'rencana',
        ]);

        AccessAuditLog::create([
            'admin_id'       => $user->id,
            'target_user_id' => $user->id,
            'action'         => 'buat_rencana_patroli',
            'details'        => "Petugas {$user->name} membuat rencana Patroli UGB #{$patroli->id} di {$patroli->lokasi} pada {$patroli->tanggal_rencana->format('d/m/Y')}.",
            'ip_address'     => $request->ip(),
            'user_agent'     => $request->userAgent(),
        ]);

        return redirect()->route('admin.patroli_ugb.index')
            ->with('success', 'Rencana patroli berhasil dibuat.');
    }

    /**
     * Form update status patroli ke pelaksanaan atau selesai.
     */
    public function edit($id)
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $patroli = PatroliUgb::with('petugas')->findOrFail($id);
        $jenisOptions = PatroliUgb::jenisOptions();

        return view('admin.patroli_ugb.form', compact('user', 'patroli', 'jenisOptions'));
    }

    /**
     * Update patroli (pelaksanaan / laporan).
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $patroli = PatroliUgb::findOrFail($id);

        $validated = $request->validate([
            'fase'                  => 'required|in:pelaksanaan,selesai',
            // Pelaksanaan
            'tanggal_pelaksanaan'   => 'nullable|date',
            'checklist_kondisi'     => 'nullable|array',
            'catatan_pembinaan'     => 'nullable|string',
            'foto_dokumentasi.*'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            // Laporan
            'ringkasan_temuan'      => 'nullable|string',
            'tindakan_diambil'      => 'nullable|string',
            'rekomendasi'           => 'nullable|string',
        ]);

        $updateData = [
            'status' => $validated['fase'],
        ];

        if ($validated['fase'] === 'pelaksanaan') {
            $updateData['tanggal_pelaksanaan'] = $validated['tanggal_pelaksanaan'] ?? null;
            $updateData['checklist_kondisi']   = $validated['checklist_kondisi'] ?? null;
            $updateData['catatan_pembinaan']   = $validated['catatan_pembinaan'] ?? null;

            // Upload foto dokumentasi
            $fotos = $patroli->foto_dokumentasi ?? [];
            if ($request->hasFile('foto_dokumentasi')) {
                foreach ($request->file('foto_dokumentasi') as $foto) {
                    $fotos[] = $foto->store('patroli_ugb/dokumentasi', 'public');
                }
            }
            $updateData['foto_dokumentasi'] = $fotos;
        }

        if ($validated['fase'] === 'selesai') {
            $updateData['ringkasan_temuan'] = $validated['ringkasan_temuan'] ?? null;
            $updateData['tindakan_diambil'] = $validated['tindakan_diambil'] ?? null;
            $updateData['rekomendasi']      = $validated['rekomendasi'] ?? null;
        }

        $patroli->update($updateData);

        return redirect()->route('admin.patroli_ugb.index')
            ->with('success', 'Patroli UGB berhasil diperbarui ke status ' . strtoupper($validated['fase']) . '.');
    }

    /**
     * Detail / laporan patroli.
     */
    public function show($id)
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $patroli = PatroliUgb::with('petugas')->findOrFail($id);

        return view('admin.patroli_ugb.laporan', compact('user', 'patroli'));
    }

    /**
     * Generate Surat Tugas (printable view).
     */
    public function suratTugas($id)
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $patroli = PatroliUgb::with('petugas')->findOrFail($id);

        return view('admin.patroli_ugb.surat_tugas', compact('patroli', 'user'));
    }
}
