<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyegelanUgb;
use App\Models\Perizinan;
use App\Models\AccessAuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenyegelanUgbController extends Controller
{
    /**
     * Tampilkan checklist penyegelan untuk perizinan UGB tertentu.
     * GET /admin/penyegelan-ugb/{perizinan_id}
     */
    public function show($perizinanId)
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $perizinan = Perizinan::with('pemohon')->findOrFail($perizinanId);

        if ($perizinan->jenis_layanan !== 'ugb') {
            abort(400, 'Modul penyegelan hanya untuk layanan UGB.');
        }

        if ($perizinan->status !== 'selesai') {
            return redirect()->back()->with('error', 'Penyegelan hanya tersedia untuk UGB yang izinnya sudah diterbitkan.');
        }

        $penyegelan = PenyegelanUgb::where('perizinan_id', $perizinanId)
            ->with('petugas')
            ->latest()
            ->first();

        return view('admin.penyegelan_ugb.checklist', compact('user', 'perizinan', 'penyegelan'));
    }

    /**
     * Simpan / Update progress checklist penyegelan.
     * POST /admin/penyegelan-ugb/{perizinan_id}
     */
    public function store(Request $request, $perizinanId)
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $perizinan = Perizinan::findOrFail($perizinanId);

        if ($perizinan->jenis_layanan !== 'ugb' || $perizinan->status !== 'selesai') {
            abort(400, 'Aksi tidak valid.');
        }

        $validated = $request->validate([
            'tanggal_penyegelan'          => 'nullable|date',
            // Langkah 2: Saksi
            'saksi'                       => 'nullable|array',
            'saksi.*.nama'                => 'nullable|string|max:255',
            'saksi.*.jabatan'             => 'nullable|string|max:255',
            'saksi.*.instansi'            => 'nullable|string|max:255',
            // Langkah 3: Surat tugas
            'nomor_surat_tugas'           => 'nullable|string|max:100',
            'petugas_penyegelan'          => 'nullable|array',
            'petugas_penyegelan.*.nama'   => 'nullable|string|max:255',
            'petugas_penyegelan.*.nip'    => 'nullable|string|max:50',
            'petugas_penyegelan.*.jabatan'=> 'nullable|string|max:255',
            // Langkah 4-8: checklist
            'checklist_data'              => 'nullable|array',
            'foto_segel'                  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'hasil_uji_coba'              => 'nullable|string',
            'daftar_pemenang'             => 'nullable|array',
            'daftar_pemenang.*.nama'      => 'nullable|string|max:255',
            'daftar_pemenang.*.hadiah'    => 'nullable|string|max:255',
            'daftar_pemenang.*.no_undian' => 'nullable|string|max:100',
            'catatan'                     => 'nullable|string|max:2000',
            'status'                      => 'nullable|in:proses,selesai',
        ]);

        // Upload foto segel
        $fotoSegel = null;
        if ($request->hasFile('foto_segel')) {
            $fotoSegel = $request->file('foto_segel')->store('penyegelan_ugb/' . $perizinanId, 'public');
        }

        // Cek apakah sudah ada record
        $penyegelan = PenyegelanUgb::where('perizinan_id', $perizinanId)->first();

        $data = [
            'perizinan_id'      => $perizinanId,
            'petugas_id'        => $user->id,
            'tanggal_penyegelan'=> $validated['tanggal_penyegelan'] ?? null,
            'saksi'             => $validated['saksi'] ?? null,
            'nomor_surat_tugas' => $validated['nomor_surat_tugas'] ?? null,
            'petugas_penyegelan'=> $validated['petugas_penyegelan'] ?? null,
            'checklist_data'    => $validated['checklist_data'] ?? null,
            'hasil_uji_coba'    => $validated['hasil_uji_coba'] ?? null,
            'daftar_pemenang'   => $validated['daftar_pemenang'] ?? null,
            'catatan'           => $validated['catatan'] ?? null,
            'status'            => $validated['status'] ?? 'proses',
        ];

        if ($fotoSegel) {
            $data['foto_segel'] = $fotoSegel;
        }

        if ($penyegelan) {
            // Pertahankan foto segel lama jika tidak upload baru
            if (!$fotoSegel) {
                unset($data['foto_segel']);
            }
            $penyegelan->update($data);
        } else {
            $penyegelan = PenyegelanUgb::create($data);
        }

        // Jika selesai, catat di history perizinan
        if (($validated['status'] ?? 'proses') === 'selesai') {
            $history = $perizinan->history_status ?? [];
            $history[] = [
                'tahap'  => 'Penyegelan UGB',
                'oleh'   => $user->name,
                'role'   => 'Staff Dinas Sosial',
                'status' => 'Penyegelan Selesai',
                'catatan'=> 'Proses penyegelan alat undian UGB telah selesai dilaksanakan.',
                'waktu'  => now()->format('Y-m-d H:i:s'),
            ];
            $perizinan->update(['history_status' => $history]);
        }

        AccessAuditLog::create([
            'admin_id'       => $user->id,
            'target_user_id' => $perizinan->pemohon_id,
            'action'         => 'update_penyegelan_ugb',
            'details'        => "Petugas {$user->name} memperbarui checklist penyegelan UGB untuk perizinan #{$perizinan->id}.",
            'ip_address'     => $request->ip(),
            'user_agent'     => $request->userAgent(),
        ]);

        return redirect()->route('admin.penyegelan_ugb.show', $perizinanId)
            ->with('success', 'Checklist penyegelan berhasil disimpan.');
    }

    /**
     * Daftar semua penyegelan UGB yang aktif.
     * GET /admin/penyegelan-ugb
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        // Ambil semua perizinan UGB yang sudah selesai
        $perizinans = Perizinan::where('jenis_layanan', 'ugb')
            ->where('status', 'selesai')
            ->with(['pemohon', 'penyegelan'])
            ->latest('tanggal_terbit')
            ->get();

        return view('admin.penyegelan_ugb.index', compact('user', 'perizinans'));
    }
}
