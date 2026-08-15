<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PembinaanKelembagaan;
use App\Models\PembinaanPilar;
use App\Models\FasilitasiKomunitas;
use App\Models\KegiatanKesetiakawanan;
use App\Models\KegiatanPeserta;
use App\Models\PengelolaanKepahlawanan;
use App\Models\MonevPemberdayaan;

class PemberdayaanSosialController extends Controller
{
    /**
     * Portal Utama Pemberdayaan Sosial
     */
    public function index()
    {
        $user = Auth::user();

        // Count data per subproses for dashboard widget
        $stats = [
            'kelembagaan' => PembinaanKelembagaan::count(),
            'pilar' => PembinaanPilar::count(),
            'komunitas' => FasilitasiKomunitas::count(),
            'kesetiakawanan' => KegiatanKesetiakawanan::count(),
            'kepahlawanan' => PengelolaanKepahlawanan::count(),
            'monev' => MonevPemberdayaan::count(),
        ];

        return view('pemberdayaan.index', compact('stats'));
    }

    // ==========================================
    // 2.1 PEMBINAAN KELEMBAGAAN SOSIAL
    // ==========================================

    public function kelembagaanIndex()
    {
        $user = Auth::user();

        if ($user->isStaff()) {
            $data = PembinaanKelembagaan::with('user')->latest()->paginate(10);
        } else {
            $data = PembinaanKelembagaan::where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('pemberdayaan.kelembagaan.index', compact('data'));
    }

    public function kelembagaanSopBk3s()
    {
        return view('pemberdayaan.kelembagaan.sop_bk3s');
    }

    public function kelembagaanSopStp()
    {
        return view('pemberdayaan.kelembagaan.sop_stp');
    }

    public function kelembagaanCreate()
    {
        return view('pemberdayaan.kelembagaan.create');
    }

    public function kelembagaanStore(Request $request)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'jenis_lembaga' => 'required|string|max:255',
            'nomor_registrasi' => 'nullable|string|max:255',
            'kab_kota' => 'required|string|max:255',
            'alamat_lembaga' => 'required|string',
            'usulan_pembinaan' => 'nullable|string',
            'dokumen_permohonan' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:5120',
        ]);

        if ($request->hasFile('dokumen_permohonan')) {
            $path = $request->file('dokumen_permohonan')->store('pembinaan_kelembagaan', 'public');
            $validated['dokumen_permohonan'] = $path;
        }

        $validated['user_id'] = Auth::id();
        $validated['status_workflow'] = 'diajukan';

        PembinaanKelembagaan::create($validated);

        return redirect()->route('pemberdayaan.kelembagaan.index')
            ->with('success', 'Pengajuan Pembinaan Kelembagaan berhasil dikirim.');
    }

    public function kelembagaanShow($id)
    {
        $item = PembinaanKelembagaan::with('user')->findOrFail($id);
        return view('pemberdayaan.kelembagaan.show', compact('item'));
    }

    public function kelembagaanAgendaStore(Request $request, $id)
    {
        $item = PembinaanKelembagaan::findOrFail($id);

        $validated = $request->validate([
            'tanggal_pembinaan' => 'required|date',
            'materi' => 'required|string',
            'tim_pelaksana' => 'required|string',
        ]);

        $item->update([
            'tanggal_pembinaan' => $validated['tanggal_pembinaan'],
            'agenda_pembinaan' => [
                'materi' => $validated['materi'],
                'tim_pelaksana' => $validated['tim_pelaksana'],
                'disusun_pada' => now()->toDateTimeString(),
            ],
            'status_workflow' => 'rencana_pembinaan',
        ]);

        return redirect()->back()->with('success', 'Agenda pembinaan berhasil disusun.');
    }

    public function kelembagaanHasilStore(Request $request, $id)
    {
        $item = PembinaanKelembagaan::findOrFail($id);

        $validated = $request->validate([
            'hasil_pembinaan' => 'required|string',
            'catatan_evaluasi' => 'required|string',
            'perlu_tindak_lanjut' => 'required|boolean',
        ]);

        $nextStatus = $validated['perlu_tindak_lanjut'] ? 'dilaksanakan' : 'diarsipkan_sekretariat';

        $item->update([
            'hasil_pembinaan' => $validated['hasil_pembinaan'],
            'catatan_evaluasi' => $validated['catatan_evaluasi'],
            'perlu_tindak_lanjut' => $validated['perlu_tindak_lanjut'],
            'status_workflow' => $nextStatus,
        ]);

        return redirect()->back()->with('success', 'Hasil pembinaan berhasil dicatat.');
    }

    public function kelembagaanArsipStore(Request $request, $id)
    {
        $item = PembinaanKelembagaan::findOrFail($id);

        $item->update([
            'status_workflow' => 'diarsipkan_sekretariat',
        ]);

        return redirect()->back()->with('success', 'Dokumen kegiatan berhasil diarsipkan Sekretariat.');
    }

    public function kelembagaanApprovalStore(Request $request, $id)
    {
        $item = PembinaanKelembagaan::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:disetujui_kadinas,ditolak',
            'catatan_revisi' => 'nullable|string',
        ]);

        $item->update([
            'status_workflow' => $validated['status'],
            'catatan_revisi' => $validated['catatan_revisi'],
        ]);

        return redirect()->back()->with('success', 'Persetujuan Kepala Dinas berhasil diperbarui.');
    }

    // ==========================================
    // 2.2 PEMBINAAN PILAR-PILAR SOSIAL
    // ==========================================

    public function pilarIndex()
    {
        $user = Auth::user();

        if ($user->isStaff()) {
            $data = PembinaanPilar::with('user')->latest()->paginate(10);
        } else {
            $data = PembinaanPilar::where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('pemberdayaan.pilar.index', compact('data'));
    }

    public function pilarSopTksk()
    {
        return view('pemberdayaan.pilar.sop_tksk');
    }

    public function pilarSopIpsm()
    {
        return view('pemberdayaan.pilar.sop_ipsm');
    }

    public function pilarSopKarangTaruna()
    {
        return view('pemberdayaan.pilar.sop_karang_taruna');
    }

    public function pilarCreate()
    {
        return view('pemberdayaan.pilar.create');
    }

    public function pilarStore(Request $request)
    {
        $validated = $request->validate([
            'kategori_pilar' => 'required|string|in:psm,tksk,karang_taruna,relawan_sosial,lainnya',
            'nama_pilar' => 'required|string|max:255',
            'kab_kota' => 'required|string|max:255',
            'usulan_pembinaan' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status_workflow'] = 'diajukan';

        PembinaanPilar::create($validated);

        return redirect()->route('pemberdayaan.pilar.index')
            ->with('success', 'Pengajuan Pembinaan Pilar Sosial berhasil dikirim.');
    }

    public function pilarShow($id)
    {
        $item = PembinaanPilar::with('user')->findOrFail($id);
        return view('pemberdayaan.pilar.show', compact('item'));
    }

    public function pilarBimtekStore(Request $request, $id)
    {
        $item = PembinaanPilar::findOrFail($id);

        $validated = $request->validate([
            'judul_bimtek' => 'required|string',
            'modul' => 'required|string',
            'narasumber' => 'required|string',
            'tanggal_bimtek' => 'required|date',
        ]);

        $item->update([
            'tanggal_bimtek' => $validated['tanggal_bimtek'],
            'program_bimtek' => [
                'judul' => $validated['judul_bimtek'],
                'modul' => $validated['modul'],
                'narasumber' => $validated['narasumber'],
            ],
            'status_workflow' => 'bimtek_dilaksanakan',
        ]);

        return redirect()->back()->with('success', 'Program Bimtek / Penguatan Kapasitas telah dikonfigurasi.');
    }

    public function pilarEvaluasiStore(Request $request, $id)
    {
        $item = PembinaanPilar::findOrFail($id);

        $validated = $request->validate([
            'evaluasi_skor' => 'required|integer|min:0|max:100',
            'catatan_evaluasi' => 'required|string',
            'perlu_pembinaan_lanjutan' => 'required|boolean',
        ]);

        $item->update([
            'evaluasi_skor' => $validated['evaluasi_skor'],
            'catatan_evaluasi' => $validated['catatan_evaluasi'],
            'perlu_pembinaan_lanjutan' => $validated['perlu_pembinaan_lanjutan'],
            'status_workflow' => 'dievaluasi',
        ]);

        return redirect()->back()->with('success', 'Evaluasi hasil pembinaan pilar sosial berhasil dicatat.');
    }

    public function pilarArsipStore(Request $request, $id)
    {
        $item = PembinaanPilar::findOrFail($id);
        $item->update(['status_workflow' => 'diarsipkan_sekretariat']);

        return redirect()->back()->with('success', 'Dokumentasi & laporan berhasil diarsipkan Sekretariat.');
    }

    public function pilarApprovalStore(Request $request, $id)
    {
        $item = PembinaanPilar::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:disahkan_kadinas,ditolak',
            'catatan_revisi' => 'nullable|string',
        ]);

        $item->update([
            'status_workflow' => $validated['status'],
            'catatan_revisi' => $validated['catatan_revisi'],
        ]);

        return redirect()->back()->with('success', 'Pengesahan hasil pembinaan oleh Kepala Dinas berhasil diperbarui.');
    }

    // ==========================================
    // 2.3 FASILITASI KOMUNITAS RENTAN
    // ==========================================

    public function komunitasIndex()
    {
        $user = Auth::user();

        if ($user->isStaff()) {
            $data = FasilitasiKomunitas::with('user')->latest()->paginate(10);
        } else {
            $data = FasilitasiKomunitas::where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('pemberdayaan.komunitas.index', compact('data'));
    }

    public function komunitasCreate()
    {
        return view('pemberdayaan.komunitas.create');
    }

    public function komunitasStore(Request $request)
    {
        $validated = $request->validate([
            'nama_komunitas' => 'required|string|max:255',
            'jenis_kelompok' => 'required|string|max:255',
            'kab_kota' => 'required|string|max:255',
            'alamat' => 'required|string',
            'usulan_kebutuhan' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status_workflow'] = 'diajukan';

        FasilitasiKomunitas::create($validated);

        return redirect()->route('pemberdayaan.komunitas.index')
            ->with('success', 'Usulan Fasilitasi Kelompok Rentan berhasil dikirim.');
    }

    public function komunitasShow($id)
    {
        $item = FasilitasiKomunitas::with('user')->findOrFail($id);
        return view('pemberdayaan.komunitas.show', compact('item'));
    }

    public function komunitasVerifikasiWilayah(Request $request, $id)
    {
        $item = FasilitasiKomunitas::findOrFail($id);

        $validated = $request->validate([
            'status_verifikasi_dinsos' => 'required|in:diverifikasi,ditolak',
            'catatan_verifikasi_dinsos' => 'nullable|string',
        ]);

        $nextStatus = ($validated['status_verifikasi_dinsos'] === 'diverifikasi') ? 'diverifikasi_wilayah' : 'ditolak';

        $item->update([
            'status_verifikasi_dinsos' => $validated['status_verifikasi_dinsos'],
            'catatan_verifikasi_dinsos' => $validated['catatan_verifikasi_dinsos'],
            'status_workflow' => $nextStatus,
        ]);

        return redirect()->back()->with('success', 'Verifikasi Dinsos Kab/Kota berhasil dicatat.');
    }

    public function komunitasFasilitasiStore(Request $request, $id)
    {
        $item = FasilitasiKomunitas::findOrFail($id);

        $validated = $request->validate([
            'rencana_fasilitasi' => 'required|string',
            'hasil_monitoring' => 'required|string',
            'is_efektif' => 'required|boolean',
        ]);

        $item->update([
            'rencana_fasilitasi' => $validated['rencana_fasilitasi'],
            'hasil_monitoring' => $validated['hasil_monitoring'],
            'is_efektif' => $validated['is_efektif'],
            'status_workflow' => 'monitoring',
        ]);

        return redirect()->back()->with('success', 'Rencana fasilitasi & monitoring berhasil disimpan.');
    }

    public function komunitasArsipStore(Request $request, $id)
    {
        $item = FasilitasiKomunitas::findOrFail($id);
        $item->update(['status_workflow' => 'diarsipkan_sekretariat']);

        return redirect()->back()->with('success', 'Laporan fasilitasi diarsipkan Sekretariat.');
    }

    public function komunitasApprovalStore(Request $request, $id)
    {
        $item = FasilitasiKomunitas::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:disetujui_keberlanjutan,ditolak',
            'catatan_revisi' => 'nullable|string',
        ]);

        $item->update([
            'status_workflow' => $validated['status'],
            'catatan_revisi' => $validated['catatan_revisi'],
        ]);

        return redirect()->back()->with('success', 'Persetujuan keberlanjutan program oleh Kepala Dinas disimpan.');
    }

    // ==========================================
    // 2.4 KEGIATAN KESETIAKAWANAN & PENYULUHAN
    // ==========================================

    public function kesetiakawananIndex()
    {
        $data = KegiatanKesetiakawanan::withCount('pesertas')->latest()->paginate(10);
        return view('pemberdayaan.kesetiakawanan.index', compact('data'));
    }

    public function kesetiakawananCreate()
    {
        return view('pemberdayaan.kesetiakawanan.create');
    }

    public function kesetiakawananStore(Request $request)
    {
        $validated = $request->validate([
            'jenis_kegiatan' => 'required|string|in:kesetiakawanan_sosial,restorasi_sosial,penyuluhan_sosial',
            'judul_kegiatan' => 'required|string|max:255',
            'tema' => 'nullable|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kab_kota' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'target_peserta' => 'required|integer|min:1',
            'narasumber' => 'nullable|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status_workflow'] = 'rencana';

        KegiatanKesetiakawanan::create($validated);

        return redirect()->route('pemberdayaan.kesetiakawanan.index')
            ->with('success', 'Rencana Kegiatan Kesetiakawanan / Penyuluhan berhasil dibuat.');
    }

    public function kesetiakawananShow($id)
    {
        $item = KegiatanKesetiakawanan::with('pesertas.user')->findOrFail($id);
        return view('pemberdayaan.kesetiakawanan.show', compact('item'));
    }

    public function kesetiakawananPesertaRegister(Request $request, $id)
    {
        $kegiatan = KegiatanKesetiakawanan::findOrFail($id);

        $validated = $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'instansi_unsur' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
        ]);

        KegiatanPeserta::create([
            'kegiatan_id' => $kegiatan->id,
            'user_id' => Auth::check() ? Auth::id() : null,
            'nama_peserta' => $validated['nama_peserta'],
            'instansi_unsur' => $validated['instansi_unsur'],
            'kontak' => $validated['kontak'],
            'status_kehadiran' => 'terdaftar',
        ]);

        return redirect()->back()->with('success', 'Pendaftaran peserta berhasil dikonfirmasi.');
    }

    public function kesetiakawananLaporanStore(Request $request, $id)
    {
        $item = KegiatanKesetiakawanan::findOrFail($id);

        $validated = $request->validate([
            'laporan_kegiatan' => 'required|string',
            'foto_dokumentasi' => 'nullable|file|mimes:jpg,png,jpeg|max:5120',
        ]);

        $photos = $item->foto_dokumentasi ?? [];
        if ($request->hasFile('foto_dokumentasi')) {
            $path = $request->file('foto_dokumentasi')->store('kegiatan_kesetiakawanan', 'public');
            $photos[] = $path;
        }

        $item->update([
            'laporan_kegiatan' => $validated['laporan_kegiatan'],
            'foto_dokumentasi' => $photos,
            'status_workflow' => 'laporan_disusun',
        ]);

        return redirect()->back()->with('success', 'Laporan & foto dokumentasi kegiatan berhasil disimpan.');
    }

    public function kesetiakawananArsipStore(Request $request, $id)
    {
        $item = KegiatanKesetiakawanan::findOrFail($id);
        $item->update(['status_workflow' => 'diarsipkan_sekretariat']);

        return redirect()->back()->with('success', 'Laporan kegiatan diarsipkan Sekretariat.');
    }

    public function kesetiakawananApprovalStore(Request $request, $id)
    {
        $item = KegiatanKesetiakawanan::findOrFail($id);

        $item->update(['status_workflow' => 'disahkan_kadinas']);

        return redirect()->back()->with('success', 'Laporan kegiatan resmi disahkan oleh Kepala Dinas.');
    }

    // ==========================================
    // 2.5 PENGELOLAAN KEPAHLAWANAN DAN TMP
    // ==========================================

    public function kepahlawananIndex()
    {
        $user = Auth::user();

        if ($user->isStaff()) {
            $data = PengelolaanKepahlawanan::with('user')->latest()->paginate(10);
        } else {
            $data = PengelolaanKepahlawanan::where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('pemberdayaan.kepahlawanan.index', compact('data'));
    }

    public function kepahlawananSopPerawatanTmp()
    {
        return view('pemberdayaan.kepahlawanan.sop_perawatan_tmp');
    }

    public function kepahlawananSopCpn()
    {
        return view('pemberdayaan.kepahlawanan.sop_cpn');
    }

    public function kepahlawananSopSidangTp2gd()
    {
        return view('pemberdayaan.kepahlawanan.sop_sidang_tp2gd');
    }

    public function kepahlawananSopPerintisKemerdekaan()
    {
        return view('pemberdayaan.kepahlawanan.sop_perintis_kemerdekaan');
    }

    public function kepahlawananSopJandaPerintis()
    {
        return view('pemberdayaan.kepahlawanan.sop_janda_perintis');
    }

    public function kepahlawananSopPemutakhiranPkjpk()
    {
        return view('pemberdayaan.kepahlawanan.sop_pemutakhiran_pkjpk');
    }

    public function kepahlawananCreate()
    {
        return view('pemberdayaan.kepahlawanan.create');
    }

    public function kepahlawananStore(Request $request)
    {
        $validated = $request->validate([
            'jenis_agenda' => 'required|string|in:pemeliharaan_tmp,hari_pahlawan,usulan_gelar,ziarah_wisata',
            'nama_tmp_atau_pahlawan' => 'required|string|max:255',
            'lokasi_tmp' => 'nullable|string|max:255',
            'kab_kota' => 'required|string|max:255',
            'usulan_kegiatan' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status_workflow'] = 'diajukan';

        PengelolaanKepahlawanan::create($validated);

        return redirect()->route('pemberdayaan.kepahlawanan.index')
            ->with('success', 'Usulan kegiatan kepahlawanan / TMP berhasil dikirim.');
    }

    public function kepahlawananShow($id)
    {
        $item = PengelolaanKepahlawanan::with('user')->findOrFail($id);
        return view('pemberdayaan.kepahlawanan.show', compact('item'));
    }

    public function kepahlawananAgendaStore(Request $request, $id)
    {
        $item = PengelolaanKepahlawanan::findOrFail($id);

        $validated = $request->validate([
            'agenda_ditentukan' => 'required|string',
            'tanggal_pelaksanaan' => 'required|date',
        ]);

        $item->update([
            'agenda_ditentukan' => $validated['agenda_ditentukan'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'status_workflow' => 'agenda_disusun',
        ]);

        return redirect()->back()->with('success', 'Agenda kegiatan kepahlawanan/TMP disusun.');
    }

    public function kepahlawananLaporanStore(Request $request, $id)
    {
        $item = PengelolaanKepahlawanan::findOrFail($id);

        $validated = $request->validate([
            'laporan_hasil' => 'required|string',
            'foto_dokumentasi' => 'nullable|file|mimes:jpg,png,jpeg|max:5120',
        ]);

        $photos = $item->foto_dokumentasi ?? [];
        if ($request->hasFile('foto_dokumentasi')) {
            $path = $request->file('foto_dokumentasi')->store('kepahlawanan', 'public');
            $photos[] = $path;
        }

        $item->update([
            'laporan_hasil' => $validated['laporan_hasil'],
            'foto_dokumentasi' => $photos,
            'status_workflow' => 'laporan_disusun',
        ]);

        return redirect()->back()->with('success', 'Dokumentasi & Laporan kegiatan kepahlawanan disimpan.');
    }

    public function kepahlawananArsipStore(Request $request, $id)
    {
        $item = PengelolaanKepahlawanan::findOrFail($id);
        $item->update(['status_workflow' => 'diarsipkan_sekretariat']);

        return redirect()->back()->with('success', 'Laporan kepahlawanan diarsipkan Sekretariat.');
    }

    public function kepahlawananApprovalStore(Request $request, $id)
    {
        $item = PengelolaanKepahlawanan::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:disahkan_kadinas,ditolak',
            'catatan_revisi' => 'nullable|string',
        ]);

        $item->update([
            'status_workflow' => $validated['status'],
            'catatan_revisi' => $validated['catatan_revisi'],
        ]);

        return redirect()->back()->with('success', 'Pengesahan laporan kepahlawanan/TMP oleh Kepala Dinas disimpan.');
    }

    // ==========================================
    // 2.6 MONITORING DAN EVALUASI (MONEV)
    // ==========================================

    public function monevIndex()
    {
        $data = MonevPemberdayaan::with('user')->latest()->paginate(10);
        
        // Summary stats for analytics
        $summary = [
            'total_lks' => PembinaanKelembagaan::count(),
            'total_pilar' => PembinaanPilar::count(),
            'total_komunitas' => FasilitasiKomunitas::count(),
            'total_kegiatan' => KegiatanKesetiakawanan::count(),
            'total_tmp' => PengelolaanKepahlawanan::count(),
        ];

        return view('pemberdayaan.monev.index', compact('data', 'summary'));
    }

    public function monevCreate()
    {
        // Auto pre-fill current numbers
        $autoStats = [
            'lks' => PembinaanKelembagaan::count(),
            'pilar' => PembinaanPilar::count(),
            'komunitas' => FasilitasiKomunitas::count(),
            'kegiatan' => KegiatanKesetiakawanan::count(),
            'tmp' => PengelolaanKepahlawanan::count(),
        ];

        return view('pemberdayaan.monev.create', compact('autoStats'));
    }

    public function monevStore(Request $request)
    {
        $validated = $request->validate([
            'periode_evaluasi' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2020|max:2099',
            'kab_kota' => 'required|string|max:255',
            'total_lks_dibina' => 'required|integer|min:0',
            'total_pilar_dibina' => 'required|integer|min:0',
            'total_komunitas_difasilitasi' => 'required|integer|min:0',
            'total_kegiatan_kesetiakawanan' => 'required|integer|min:0',
            'total_tmp_dikelola' => 'required|integer|min:0',
            'capaian_program' => 'required|string',
            'kendala_program' => 'required|string',
            'rekomendasi_perbaikan' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status_workflow'] = 'draft';

        MonevPemberdayaan::create($validated);

        return redirect()->route('pemberdayaan.monev.index')
            ->with('success', 'Laporan Monitoring & Evaluasi berhasil disimpan.');
    }

    public function monevShow($id)
    {
        $item = MonevPemberdayaan::with('user')->findOrFail($id);
        return view('pemberdayaan.monev.show', compact('item'));
    }

    public function monevAnalisisStore(Request $request, $id)
    {
        $item = MonevPemberdayaan::findOrFail($id);

        $validated = $request->validate([
            'capaian_program' => 'required|string',
            'kendala_program' => 'required|string',
            'rekomendasi_perbaikan' => 'required|string',
        ]);

        $item->update([
            'capaian_program' => $validated['capaian_program'],
            'kendala_program' => $validated['kendala_program'],
            'rekomendasi_perbaikan' => $validated['rekomendasi_perbaikan'],
            'status_workflow' => 'laporan_disusun',
        ]);

        return redirect()->back()->with('success', 'Analisis capaian & rekomendasi Monev diperbarui.');
    }

    public function monevArsipStore(Request $request, $id)
    {
        $item = MonevPemberdayaan::findOrFail($id);
        $item->update(['status_workflow' => 'diarsipkan_sekretariat']);

        return redirect()->back()->with('success', 'Laporan Monev diarsipkan Sekretariat.');
    }

    public function monevApprovalStore(Request $request, $id)
    {
        $item = MonevPemberdayaan::findOrFail($id);
        $item->update(['status_workflow' => 'disahkan_kadinas']);

        return redirect()->back()->with('success', 'Hasil Monev disahkan oleh Kepala Dinas.');
    }
}
