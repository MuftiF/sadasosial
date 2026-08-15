<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RehabilitasiSosial;
use App\Models\User;

class RehabilitasiSosialController extends Controller
{
    /**
     * Portal Utama Rehabilitasi Sosial
     */
    public function index()
    {
        $user = Auth::user();

        // Statistik Kasus
        $stats = [
            'total' => $user->isStaff() ? RehabilitasiSosial::count() : RehabilitasiSosial::where('user_id', $user->id)->count(),
            'anak' => $this->countKategori('anak'),
            'lansia' => $this->countKategori('lansia'),
            'disabilitas' => $this->countKategori('disabilitas'),
            'tuna_sosial' => $this->countKategori('tuna_sosial'),
            'kekerasan' => $this->countKategori('kekerasan'),
            'napza' => $this->countKategori('napza'),
            'rujukan_aktif' => RehabilitasiSosial::where('perlu_rujukan', true)
                ->whereIn('status_workflow', ['dirujuk', 'diterima_mitra'])
                ->count(),
        ];

        // Kasus Terbaru
        $recentCases = $user->isStaff()
            ? RehabilitasiSosial::with('user')->latest()->take(5)->get()
            : RehabilitasiSosial::where('user_id', $user->id)->latest()->take(5)->get();

        return view('rehabilitasi.index', compact('stats', 'recentCases'));
    }

    /**
     * Daftar Kasus per Kategori
     */
    public function subprosesIndex($kategori)
    {
        $user = Auth::user();

        $query = RehabilitasiSosial::where('kategori', $kategori)->with('user');

        if (!$user->isStaff()) {
            $query->where('user_id', $user->id);
        }

        $data = $query->latest()->paginate(15);

        return view('rehabilitasi.list', compact('data', 'kategori'));
    }

    /**
     * Form Pengajuan Baru
     */
    public function create($kategori)
    {
        return view('rehabilitasi.create', compact('kategori'));
    }

    /**
     * Simpan Pengajuan Baru
     */
    public function store(Request $request, $kategori)
    {
        $validated = $request->validate([
            'nama_klien' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'kab_kota' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi_kasus' => 'required|string',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:5120',
        ]);

        if ($request->hasFile('dokumen_pendukung')) {
            $path = $request->file('dokumen_pendukung')->store('rehabilitasi_dokumen', 'public');
            $validated['dokumen_pendukung'] = $path;
        }

        $validated['user_id'] = Auth::id();
        $validated['kategori'] = $kategori;
        $validated['status_workflow'] = 'diajukan';

        RehabilitasiSosial::create($validated);

        return redirect()->route('rehabilitasi.subproses.index', $kategori)
            ->with('success', 'Pendaftaran kasus rehabilitasi sosial berhasil disimpan.');
    }

    /**
     * Detail Kasus & Form Workflow
     */
    public function show($id)
    {
        $item = RehabilitasiSosial::with('user')->findOrFail($id);
        return view('rehabilitasi.show', compact('item'));
    }

    /**
     * Action: Verifikasi Administrasi (Verifikator / Admin)
     */
    public function verifikasiAdminStore(Request $request, $id)
    {
        $item = RehabilitasiSosial::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:setuju,perlu_perbaikan',
            'catatan' => 'required|string',
        ]);

        $statusWorkflow = $validated['status'] === 'setuju' ? 'verifikasi_awal' : 'diajukan';

        $item->update([
            'verifikasi_admin' => [
                'status' => $validated['status'],
                'catatan' => $validated['catatan'],
                'tanggal' => now()->toDateTimeString(),
                'verifikator' => Auth::user()->name,
            ],
            'status_workflow' => $statusWorkflow,
            'catatan_revisi' => $validated['status'] === 'perlu_perbaikan' ? $validated['catatan'] : null,
        ]);

        return redirect()->back()->with('success', 'Verifikasi administrasi berhasil dicatat.');
    }

    /**
     * Action: Verifikasi Kondisi Sosial Wilayah (Dinsos Kab/Kota / Wilayah)
     */
    public function verifikasiWilayahStore(Request $request, $id)
    {
        $item = RehabilitasiSosial::findOrFail($id);

        $validated = $request->validate([
            'catatan' => 'required|string',
        ]);

        $item->update([
            'kondisi_sosial' => [
                'catatan' => $validated['catatan'],
                'tanggal' => now()->toDateTimeString(),
                'petugas' => Auth::user()->name,
            ],
            'status_workflow' => 'proses_asesmen',
        ]);

        return redirect()->back()->with('success', 'Hasil verifikasi kondisi sosial wilayah berhasil dicatat.');
    }

    /**
     * Action: Asesmen Kebutuhan (Analis Rehab / Admin)
     */
    public function asesmenStore(Request $request, $id)
    {
        $item = RehabilitasiSosial::findOrFail($id);

        $validated = $request->validate([
            'analisis' => 'required|string',
            'alat_bantu' => 'nullable|string',
        ]);

        $item->update([
            'asesmen_kebutuhan' => [
                'analisis' => $validated['analisis'],
                'alat_bantu' => $validated['alat_bantu'] ?? '-',
                'tanggal' => now()->toDateTimeString(),
                'analis' => Auth::user()->name,
            ],
            'status_workflow' => 'proses_rekomendasi',
        ]);

        return redirect()->back()->with('success', 'Asesmen kebutuhan klien berhasil disimpan.');
    }

    /**
     * Action: Rekomendasi Layanan / Rujukan (Kasi Rehab / Admin)
     */
    public function rekomendasiStore(Request $request, $id)
    {
        $item = RehabilitasiSosial::findOrFail($id);

        $validated = $request->validate([
            'rekomendasi' => 'required|string',
            'perlu_rujukan' => 'required|boolean',
            'nama_uptd_lembaga' => 'required_if:perlu_rujukan,1|nullable|string',
        ]);

        $isRujukan = $validated['perlu_rujukan'];
        $statusWorkflow = $isRujukan ? 'dirujuk' : 'selesai_non_rujukan';

        $item->update([
            'rekomendasi_layanan' => [
                'rekomendasi' => $validated['rekomendasi'],
                'perlu_rujukan' => $isRujukan,
                'nama_uptd_lembaga' => $validated['nama_uptd_lembaga'] ?? '-',
                'tanggal' => now()->toDateTimeString(),
                'kasi' => Auth::user()->name,
            ],
            'perlu_rujukan' => $isRujukan,
            'nama_uptd_lembaga' => $isRujukan ? $validated['nama_uptd_lembaga'] : null,
            'status_penerimaan_uptd' => $isRujukan ? 'pending' : 'diterima',
            'status_workflow' => $statusWorkflow,
        ]);

        return redirect()->back()->with('success', 'Rekomendasi layanan berhasil disusun.');
    }

    /**
     * Action: Tanggapan Rujukan (UPTD / Lembaga Mitra / Admin)
     */
    public function tanggapanRujukanStore(Request $request, $id)
    {
        $item = RehabilitasiSosial::findOrFail($id);

        $validated = $request->validate([
            'status_penerimaan_uptd' => 'required|in:diterima,ditolak',
            'catatan_uptd' => 'required|string',
            'alternatif_layanan' => 'required_if:status_penerimaan_uptd,ditolak|nullable|string',
        ]);

        $isAccepted = $validated['status_penerimaan_uptd'] === 'diterima';
        $statusWorkflow = $isAccepted ? 'diterima_mitra' : 'ditolak_mitra';

        $item->update([
            'status_penerimaan_uptd' => $validated['status_penerimaan_uptd'],
            'catatan_uptd' => $validated['catatan_uptd'],
            'alternatif_layanan' => $validated['alternatif_layanan'] ?? null,
            'status_workflow' => $statusWorkflow,
        ]);

        return redirect()->back()->with('success', 'Tanggapan rujukan UPTD/Lembaga Mitra berhasil disimpan.');
    }

    /**
     * Action: Tambah Progres Layanan Rujukan (UPTD / Lembaga Mitra / Admin) - PB 3.7
     */
    public function tambahProgressStore(Request $request, $id)
    {
        $item = RehabilitasiSosial::findOrFail($id);

        $validated = $request->validate([
            'log' => 'required|string',
        ]);

        $currentProgress = $item->progress_layanan ?? [];
        $currentProgress[] = [
            'tanggal' => now()->toDateTimeString(),
            'log' => $validated['log'],
            'petugas' => Auth::user()->name,
        ];

        $item->update([
            'progress_layanan' => $currentProgress,
        ]);

        return redirect()->back()->with('success', 'Catatan perkembangan layanan rujukan berhasil ditambahkan.');
    }

    /**
     * Action: Evaluasi Akhir & Selesai (Kabid Rehab / Admin)
     */
    public function selesaiStore(Request $request, $id)
    {
        $item = RehabilitasiSosial::findOrFail($id);

        $item->update([
            'status_workflow' => 'selesai',
        ]);

        return redirect()->back()->with('success', 'Kasus rehabilitasi sosial secara resmi dinyatakan Selesai.');
    }

    /**
     * PB 3.7 Dashboard Monitoring Rujukan Rehabilitasi
     */
    public function monitoringIndex()
    {
        $rujukans = RehabilitasiSosial::where('perlu_rujukan', true)
            ->with('user')
            ->latest()
            ->paginate(15);

        // Stats khusus monitoring rujukan
        $stats = [
            'total_rujukan' => RehabilitasiSosial::where('perlu_rujukan', true)->count(),
            'pending' => RehabilitasiSosial::where('perlu_rujukan', true)->where('status_penerimaan_uptd', 'pending')->count(),
            'diterima' => RehabilitasiSosial::where('perlu_rujukan', true)->where('status_penerimaan_uptd', 'diterima')->count(),
            'ditolak' => RehabilitasiSosial::where('perlu_rujukan', true)->where('status_penerimaan_uptd', 'ditolak')->count(),
        ];

        return view('rehabilitasi.monitoring', compact('rujukans', 'stats'));
    }

    /**
     * SOP Bantuan Sosial Penambahan Gizi Anak Panti Swasta (PB 3.1)
     */
    public function sopGiziAnak()
    {
        return view('rehabilitasi.sop_gizi_anak');
    }

    /**
     * Helper to count category based on role
     */
    private function countKategori($kategori)
    {
        $user = Auth::user();
        if ($user->isStaff()) {
            return RehabilitasiSosial::where('kategori', $kategori)->count();
        }
        return RehabilitasiSosial::where('kategori', $kategori)->where('user_id', $user->id)->count();
    }
}
