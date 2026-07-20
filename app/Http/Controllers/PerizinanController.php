<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perizinan;
use App\Models\User;
use App\Models\AccessAuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PerizinanController extends Controller
{
    /**
     * Display the applicant's licensing dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->isStaff()) {
            if ($user->role === 'sekretariat') {
                return redirect()->route('admin.sekretariat');
            } elseif ($user->role === 'verifikator') {
                return redirect()->route('admin.verifikator');
            } elseif ($user->role === 'dinsos_wilayah') {
                return redirect()->route('admin.wilayah');
            } elseif ($user->role === 'bidang_pemberdayaan') {
                return redirect()->route('admin.pemberdayaan');
            } elseif ($user->role === 'bidang_linjamsos') {
                return redirect()->route('admin.linjamsos');
            } elseif ($user->role === 'kadinas') {
                return redirect()->route('admin.kadinas');
            }
            return $this->adminIndex($request);
        }

        $perizinans = $user->perizinans()->latest()->get();

        return view('perizinan.index', compact('user', 'perizinans'));
    }

    /**
     * Choose service type.
     */
    public function create()
    {
        if (Auth::user()->isStaff()) {
            abort(403, 'Petugas tidak diperbolehkan mengajukan permohonan baru.');
        }
        return view('perizinan.create');
    }

    /**
     * Show form for specific service.
     */
    public function form($jenis)
    {
        if (Auth::user()->isStaff()) {
            abort(403, 'Petugas tidak diperbolehkan mengajukan permohonan baru.');
        }
        if (!in_array($jenis, ['ugb', 'pub', 'lks', 'adopsi'])) {
            return redirect()->route('perizinan.create')->with('error', 'Jenis layanan tidak valid.');
        }

        return view('perizinan.form', compact('jenis'));
    }

    /**
     * Store new application (as draft or submitted).
     */
    public function store(Request $request, $jenis)
    {
        if (Auth::user()->isStaff()) {
            abort(403, 'Petugas tidak diperbolehkan mengajukan permohonan baru.');
        }
        if (!in_array($jenis, ['ugb', 'pub', 'lks', 'adopsi'])) {
            return redirect()->route('perizinan.create')->with('error', 'Jenis layanan tidak valid.');
        }

        // Base Validation Rules
        $rules = [
            'action' => 'required|in:draft,submit',
        ];

        // Specific form validations based on service type
        if ($jenis === 'ugb') {
            $rules += [
                'nama_penyelenggara' => 'required|string|max:255',
                'nama_undian' => 'required|string|max:255',
                'total_hadiah' => 'required|numeric|min:0',
                'waktu_pelaksanaan' => 'required|string|max:255',
                'deskripsi_kegiatan' => 'required|string',
                'dokumen_proposal' => 'required|file|mimes:pdf,docx,jpg,png|max:5120',
                'dokumen_hadiah' => 'required|file|mimes:pdf,docx,jpg,png|max:5120',
            ];
        } elseif ($jenis === 'pub') {
            $rules += [
                'nama_penyelenggara' => 'required|string|max:255',
                'tujuan_pengumpulan' => 'required|string|max:255',
                'metode_pengumpulan' => 'required|string|max:255',
                'target_dana' => 'required|numeric|min:0',
                'wilayah_pengumpulan' => 'required|string|max:255',
                'waktu_pelaksanaan' => 'required|string|max:255',
                'dokumen_proposal' => 'required|file|mimes:pdf,docx,jpg,png|max:5120',
                'dokumen_rekening' => 'required|file|mimes:pdf,jpg,png|max:5120',
            ];
        } elseif ($jenis === 'lks') {
            $rules += [
                'nama_lks' => 'required|string|max:255',
                'jenis_pelayanan' => 'required|string|max:255',
                'alamat_lks' => 'required|string',
                'nama_pimpinan' => 'required|string|max:255',
                'jumlah_binaan' => 'required|integer|min:0',
                'dokumen_akta' => 'required|file|mimes:pdf|max:5120',
                'dokumen_domisili' => 'required|file|mimes:pdf,jpg,png|max:5120',
            ];
        } elseif ($jenis === 'adopsi') {
            $rules += [
                'nama_ayah' => 'required|string|max:255',
                'nik_ayah' => 'required|string|size:16',
                'nama_ibu' => 'required|string|max:255',
                'nik_ibu' => 'required|string|size:16',
                'alamat_cota' => 'required|string',
                'lama_menikah' => 'required|string|max:100',
                'penghasilan' => 'required|numeric|min:0',
                'nama_anak' => 'required|string|max:255',
                'alasan_adopsi' => 'required|string',
                'dokumen_nikah' => 'required|file|mimes:pdf,jpg,png|max:5120',
                'dokumen_sehat' => 'required|file|mimes:pdf|max:5120',
            ];
        }

        $validated = $request->validate($rules);

        // Process file uploads & build data_tambahan json
        $dataTambahan = [];
        $mainDocPath = null;

        foreach ($request->all() as $key => $value) {
            if ($key !== '_token' && $key !== 'action' && !$request->hasFile($key)) {
                $dataTambahan[$key] = $value;
            }
        }

        // Upload files
        $fileFields = [];
        if ($jenis === 'ugb') { $fileFields = ['dokumen_proposal', 'dokumen_hadiah']; }
        elseif ($jenis === 'pub') { $fileFields = ['dokumen_proposal', 'dokumen_rekening']; }
        elseif ($jenis === 'lks') { $fileFields = ['dokumen_akta', 'dokumen_domisili']; }
        elseif ($jenis === 'adopsi') { $fileFields = ['dokumen_nikah', 'dokumen_sehat']; }

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('dokumen_perizinan', 'public');
                $dataTambahan[$field] = $path;
                if (!$mainDocPath) {
                    $mainDocPath = $path; // Use the first uploaded document as the main file path
                }
            }
        }

        // Determine Status & Verification Stage
        $isSubmit = $request->action === 'submit';
        $status = $isSubmit ? 'diperiksa' : 'draft';
        $tahap = $isSubmit ? 'sekretariat' : 'draft';

        // Initialize history status
        $history = [
            [
                'tahap' => 'Pengajuan',
                'oleh' => Auth::user()->name,
                'role' => 'Pemohon',
                'status' => $status,
                'catatan' => $isSubmit ? 'Permohonan diajukan untuk diperiksa oleh Sekretariat.' : 'Draft berhasil disimpan.',
                'waktu' => now()->format('Y-m-d H:i:s'),
            ]
        ];

        // Set dynamic konfirmasi_wilayah flag (some applications might trigger this depending on requirements)
        $konfirmasiWilayah = $request->has('konfirmasi_wilayah') || in_array($jenis, ['lks', 'adopsi']);

        $perizinan = Perizinan::create([
            'pemohon_id' => Auth::id(),
            'jenis_layanan' => $jenis,
            'status' => $status,
            'tahap_verifikasi' => $tahap,
            'perlu_perbaikan' => false,
            'data_tambahan' => $dataTambahan,
            'history_status' => $history,
            'konfirmasi_wilayah' => $konfirmasiWilayah,
            'dokumen' => $mainDocPath,
        ]);

        $label = $isSubmit ? 'berhasil diajukan ke dinas sosial' : 'berhasil disimpan sebagai draft';
        return redirect()->route('perizinan.index')->with('success', "Permohonan " . strtoupper($jenis) . " {$label}.");
    }

    /**
     * Show single application details and timeline tracking.
     */
    public function show($id)
    {
        $perizinan = Perizinan::with('pemohon')->findOrFail($id);
        $user = Auth::user();

        // Ensure user can only view their own applications unless they are staff
        if (!$user->isStaff() && $perizinan->pemohon_id !== $user->id) {
            abort(403, 'Akses tidak sah.');
        }

        // Render appropriate details
        $jenisLabels = [
            'ugb' => 'Undian Gratis Berhadiah (UGB)',
            'pub' => 'Pengumpulan Uang atau Barang (PUB)',
            'lks' => 'Tanda Daftar & Izin Operasional LKS',
            'adopsi' => 'Rekomendasi Pengangkatan / Adopsi Anak',
        ];

        return view('perizinan.show', compact('perizinan', 'user', 'jenisLabels'));
    }

    /**
     * Show edit form for document repairs.
     */
    public function edit($id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $user = Auth::user();

        // Ensure applicant owns this and it is marked for correction / is draft
        if ($perizinan->pemohon_id !== $user->id) {
            abort(403, 'Akses tidak sah.');
        }

        if (!$perizinan->perlu_perbaikan && $perizinan->status !== 'draft') {
            return redirect()->route('perizinan.show', $perizinan->id)->with('error', 'Permohonan tidak dalam status perbaikan.');
        }

        $jenis = $perizinan->jenis_layanan;

        return view('perizinan.edit', compact('perizinan', 'jenis'));
    }

    /**
     * Update application data (resubmission after repair).
     */
    public function update(Request $request, $id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $user = Auth::user();

        if ($perizinan->pemohon_id !== $user->id) {
            abort(403, 'Akses tidak sah.');
        }

        $jenis = $perizinan->jenis_layanan;

        // Validation based on service type
        $rules = [
            'action' => 'required|in:draft,submit',
        ];

        if ($jenis === 'ugb') {
            $rules += [
                'nama_penyelenggara' => 'required|string|max:255',
                'nama_undian' => 'required|string|max:255',
                'total_hadiah' => 'required|numeric|min:0',
                'waktu_pelaksanaan' => 'required|string|max:255',
                'deskripsi_kegiatan' => 'required|string',
                'dokumen_proposal' => 'nullable|file|mimes:pdf,docx,jpg,png|max:5120',
                'dokumen_hadiah' => 'nullable|file|mimes:pdf,docx,jpg,png|max:5120',
            ];
        } elseif ($jenis === 'pub') {
            $rules += [
                'nama_penyelenggara' => 'required|string|max:255',
                'tujuan_pengumpulan' => 'required|string|max:255',
                'metode_pengumpulan' => 'required|string|max:255',
                'target_dana' => 'required|numeric|min:0',
                'wilayah_pengumpulan' => 'required|string|max:255',
                'waktu_pelaksanaan' => 'required|string|max:255',
                'dokumen_proposal' => 'nullable|file|mimes:pdf,docx,jpg,png|max:5120',
                'dokumen_rekening' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            ];
        } elseif ($jenis === 'lks') {
            $rules += [
                'nama_lks' => 'required|string|max:255',
                'jenis_pelayanan' => 'required|string|max:255',
                'alamat_lks' => 'required|string',
                'nama_pimpinan' => 'required|string|max:255',
                'jumlah_binaan' => 'required|integer|min:0',
                'dokumen_akta' => 'nullable|file|mimes:pdf|max:5120',
                'dokumen_domisili' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            ];
        } elseif ($jenis === 'adopsi') {
            $rules += [
                'nama_ayah' => 'required|string|max:255',
                'nik_ayah' => 'required|string|size:16',
                'nama_ibu' => 'required|string|max:255',
                'nik_ibu' => 'required|string|size:16',
                'alamat_cota' => 'required|string',
                'lama_menikah' => 'required|string|max:100',
                'penghasilan' => 'required|numeric|min:0',
                'nama_anak' => 'required|string|max:255',
                'alasan_adopsi' => 'required|string',
                'dokumen_nikah' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
                'dokumen_sehat' => 'nullable|file|mimes:pdf|max:5120',
            ];
        }

        $validated = $request->validate($rules);

        $dataTambahan = $perizinan->data_tambahan ?? [];

        // Update fields
        foreach ($request->all() as $key => $value) {
            if ($key !== '_token' && $key !== '_method' && $key !== 'action' && !$request->hasFile($key)) {
                $dataTambahan[$key] = $value;
            }
        }

        // Update files
        $fileFields = [];
        if ($jenis === 'ugb') { $fileFields = ['dokumen_proposal', 'dokumen_hadiah']; }
        elseif ($jenis === 'pub') { $fileFields = ['dokumen_proposal', 'dokumen_rekening']; }
        elseif ($jenis === 'lks') { $fileFields = ['dokumen_akta', 'dokumen_domisili']; }
        elseif ($jenis === 'adopsi') { $fileFields = ['dokumen_nikah', 'dokumen_sehat']; }

        $mainDocPath = $perizinan->dokumen;
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if (isset($dataTambahan[$field])) {
                    Storage::disk('public')->delete($dataTambahan[$field]);
                }
                $path = $request->file($field)->store('dokumen_perizinan', 'public');
                $dataTambahan[$field] = $path;
                $mainDocPath = $path;
            }
        }

        $isSubmit = $request->action === 'submit';
        $status = $isSubmit ? 'diperiksa' : 'draft';

        // When resubmitting, we return the verification stage to the Sekretariat/first review stage
        $tahap = $isSubmit ? 'sekretariat' : 'draft';

        $history = $perizinan->history_status ?? [];
        $history[] = [
            'tahap' => 'Perbaikan & Resubmit',
            'oleh' => $user->name,
            'role' => 'Pemohon',
            'status' => $status,
            'catatan' => $isSubmit ? 'Memperbaiki dokumen dan mengajukan ulang permohonan.' : 'Draft perbaikan disimpan.',
            'waktu' => now()->format('Y-m-d H:i:s'),
        ];

        $perizinan->update([
            'status' => $status,
            'tahap_verifikasi' => $tahap,
            'perlu_perbaikan' => false,
            'catatan_perbaikan' => null,
            'data_tambahan' => $dataTambahan,
            'history_status' => $history,
            'dokumen' => $mainDocPath,
        ]);

        $label = $isSubmit ? 'diajukan ulang untuk verifikasi' : 'draft perbaikan disimpan';
        return redirect()->route('perizinan.show', $perizinan->id)->with('success', "Permohonan berhasil diperbarui dan {$label}.");
    }

    /**
     * Officer review page - displays queues.
     */
    public function adminIndex(Request $request)
    {
        $user = Auth::user();

        // Restrict to staff
        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        // Determine which queue belongs to which role
        $query = Perizinan::query();

        // Admin sees all, but specific staff see specific stages:
        // - sekretariat: tahap_verifikasi = 'sekretariat'
        // - verifikator: tahap_verifikasi = 'verifikator'
        // - dinsos_wilayah: tahap_verifikasi = 'dinsos_wilayah'
        // - bidang_pemberdayaan: tahap_verifikasi = 'bidang_teknis' (only ugb, pub, lks)
        // - bidang_linjamsos: tahap_verifikasi = 'bidang_teknis' (only adopsi)
        // - kadinas: tahap_verifikasi = 'kepala_dinas'

        if ($user->isSekretariat()) {
            $query->where('tahap_verifikasi', 'sekretariat')->where('status', 'diperiksa');
        } elseif ($user->isVerifikator()) {
            $query->where('tahap_verifikasi', 'verifikator')->where('status', 'diperiksa');
        } elseif ($user->isDinsosWilayah()) {
            $query->where('tahap_verifikasi', 'dinsos_wilayah')->where('status', 'diperiksa');
        } elseif ($user->isBidangPemberdayaan()) {
            $query->where('tahap_verifikasi', 'bidang_teknis')->whereIn('jenis_layanan', ['ugb', 'pub', 'lks'])->where('status', 'diperiksa');
        } elseif ($user->isBidangLinjamsos()) {
            $query->where('tahap_verifikasi', 'bidang_teknis')->where('jenis_layanan', 'adopsi')->where('status', 'diperiksa');
        } elseif ($user->isKadinas()) {
            $query->where('tahap_verifikasi', 'kepala_dinas')->where('status', 'diperiksa');
        }

        $queues = $query->with('pemohon')->latest()->get();

        // Fetch reports queue for Bidang Pemberdayaan or Admin
        $reportQueues = [];
        if ($user->isBidangPemberdayaan() || $user->isAdmin()) {
            $reportQueues = Perizinan::where('jenis_layanan', 'ugb')
                ->where('laporan_status', 'diperiksa')
                ->with('pemohon')
                ->latest()
                ->get();
        }

        // Also fetch all other logs for administrative display
        $allApplications = [];
        if ($user->isAdmin()) {
            $allApplications = Perizinan::with('pemohon')->latest()->get();
        }

        return view('perizinan.admin_index', compact('user', 'queues', 'reportQueues', 'allApplications'));
    }

    /**
     * Process checking action by officers.
     */
    public function process(Request $request, $id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $user = Auth::user();

        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        $validated = $request->validate([
            'action' => 'required|in:approve,reject,perbaikan',
            'catatan' => 'required|string|max:1000',
            'nomor_surat_rekomendasi' => 'nullable|string|max:100', // only for bidang/kadinas
        ]);

        $action = $validated['action'];
        $catatan = $validated['catatan'];
        $tahapSekarang = $perizinan->tahap_verifikasi;

        $nextTahap = $tahapSekarang;
        $status = $perizinan->status;
        $perluPerbaikan = false;
        $catatanPerbaikan = null;

        $historyLog = [
            'tahap' => 'Verifikasi',
            'oleh' => $user->name,
            'role' => $this->getRoleLabel($user->role),
            'waktu' => now()->format('Y-m-d H:i:s'),
        ];

        if ($action === 'perbaikan') {
            $perluPerbaikan = true;
            $catatanPerbaikan = $catatan;
            $status = 'diperiksa'; // stays in process, but flagged for repair
            $nextTahap = $tahapSekarang; // stays in the same review stage until fixed

            $historyLog['status'] = 'Perlu Perbaikan';
            $historyLog['catatan'] = 'Dikembalikan untuk diperbaiki. Catatan: ' . $catatan;

        } elseif ($action === 'reject') {
            $status = 'ditolak';
            $nextTahap = 'ditolak';

            $historyLog['status'] = 'Ditolak';
            $historyLog['catatan'] = 'Permohonan ditolak secara permanen. Catatan: ' . $catatan;

        } elseif ($action === 'approve') {
            // Advancing workflow stages
            if ($tahapSekarang === 'sekretariat') {
                $nextTahap = 'verifikator';
                $historyLog['status'] = 'Lengkap';
                $historyLog['catatan'] = 'Pemeriksaan kelengkapan awal disetujui. Diteruskan ke Verifikator Administrasi. Catatan: ' . $catatan;

            } elseif ($tahapSekarang === 'verifikator') {
                // If it needs wilayah check, go to dinsos_wilayah, else go to bidang_teknis
                if ($perizinan->konfirmasi_wilayah) {
                    $nextTahap = 'dinsos_wilayah';
                    $historyLog['catatan'] = 'Administrasi valid. Diteruskan ke Dinsos Kabupaten/Kota untuk konfirmasi lapangan. Catatan: ' . $catatan;
                } else {
                    $nextTahap = 'bidang_teknis';
                    $historyLog['catatan'] = 'Administrasi valid. Diteruskan ke Bidang Teknis untuk telaah substansi. Catatan: ' . $catatan;
                }
                $historyLog['status'] = 'Valid';

            } elseif ($tahapSekarang === 'dinsos_wilayah') {
                $nextTahap = 'bidang_teknis';
                $historyLog['status'] = 'Layak';
                $historyLog['catatan'] = 'Hasil survei lokasi/kegiatan dinyatakan LAYAK. Diteruskan ke Bidang Teknis. Catatan: ' . $catatan;

            } elseif ($tahapSekarang === 'bidang_teknis') {
                $nextTahap = 'kepala_dinas';
                $historyLog['status'] = 'Rekomendasi Disusun';
                $historyLog['catatan'] = 'Substansi ditelaah dan draft rekomendasi disusun. Menunggu tanda tangan Kepala Dinas. Nomor Draft: ' . ($request->nomor_surat_rekomendasi ?? '-') . '. Catatan: ' . $catatan;
                
                // Save draft recommendation number to json
                $dataTambahan = $perizinan->data_tambahan;
                $dataTambahan['draft_nomor_rekomendasi'] = $request->nomor_surat_rekomendasi;
                $dataTambahan['draft_catatan_bidang'] = $catatan;
                $perizinan->data_tambahan = $dataTambahan;

            } elseif ($tahapSekarang === 'kepala_dinas') {
                $status = 'selesai';
                $nextTahap = 'selesai';
                $historyLog['status'] = 'Disetujui';
                $historyLog['catatan'] = 'Persetujuan akhir disahkan oleh Kepala Dinas. Dokumen perizinan diterbitkan secara resmi. Catatan: ' . $catatan;

                // Generate license fields
                $noUrut = Perizinan::where('status', 'selesai')->count() + 1;
                $suffix = match($perizinan->jenis_layanan) {
                    'ugb' => 'UGB',
                    'pub' => 'PUB',
                    'lks' => 'LKS',
                    'adopsi' => 'ADOPSI',
                };
                $tahun = date('Y');
                $nomorIzin = sprintf("503/%s/%d/%04d", $suffix, $tahun, $noUrut);

                $perizinan->nomor_izin = $nomorIzin;
                $perizinan->tanggal_terbit = now();
                
                // Expiration dates
                if ($perizinan->jenis_layanan === 'ugb') {
                    $perizinan->tanggal_kadaluarsa = now()->addMonths(3);
                } elseif ($perizinan->jenis_layanan === 'pub') {
                    $perizinan->tanggal_kadaluarsa = now()->addMonths(6);
                } elseif ($perizinan->jenis_layanan === 'lks') {
                    $perizinan->tanggal_kadaluarsa = now()->addYears(3);
                } elseif ($perizinan->jenis_layanan === 'adopsi') {
                    $perizinan->tanggal_kadaluarsa = now()->addYears(100); // adopsi is permanent
                }

                $perizinan->qr_code_token = Str::random(32);
            }
        }

        // Add history log
        $history = $perizinan->history_status ?? [];
        $history[] = $historyLog;

        // Save any directly-assigned properties first (e.g. nomor_izin, tanggal_terbit, data_tambahan)
        $perizinan->save();

        $perizinan->update([
            'status' => $status,
            'tahap_verifikasi' => $nextTahap,
            'perlu_perbaikan' => $perluPerbaikan,
            'catatan_perbaikan' => $catatanPerbaikan,
            'history_status' => $history,
        ]);

        // Audit Log
        AccessAuditLog::create([
            'admin_id' => $user->id,
            'target_user_id' => $perizinan->pemohon_id,
            'action' => 'review_perizinan',
            'details' => "Petugas {$user->name} memproses perizinan ID #{$perizinan->id} (Tipe: {$perizinan->jenis_layanan}, Tahap: {$tahapSekarang}) dengan tindakan " . strtoupper($action) . ".",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $successMsg = "Berhasil memproses permohonan. ";
        if ($action === 'approve') {
            $successMsg .= ($nextTahap === 'selesai') ? "Dokumen perizinan telah diterbitkan." : "Diteruskan ke tahap " . strtoupper($nextTahap);
        } elseif ($action === 'perbaikan') {
            $successMsg .= "Dikembalikan ke pemohon untuk perbaikan.";
        } else {
            $successMsg .= "Permohonan ditolak.";
        }

        return redirect()->route('perizinan.index')->with('success', $successMsg);
    }

    /**
     * Expiry Monitoring & Report Dashboard.
     */
    public function monitoring(Request $request)
    {
        $user = Auth::user();

        if (!$user->isStaff()) {
            abort(403, 'Akses tidak sah.');
        }

        // Get licenses that are approved/finished
        $query = Perizinan::where('status', 'selesai')->with('pemohon');

        // Filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_izin', 'like', "%{$search}%")
                  ->orWhereHas('pemohon', function($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('nama_lembaga', 'like', "%{$search}%");
                  });
            });
        }

        $allLicenses = $query->orderBy('tanggal_terbit', 'desc')->get();

        // Distribute to active, about to expire (within 30 days), and expired lists
        $active = [];
        $expiring = [];
        $expired = [];

        foreach ($allLicenses as $lic) {
            $daysLeft = now()->diffInDays($lic->tanggal_kadaluarsa, false);

            if ($daysLeft < 0) {
                $expired[] = [
                    'license' => $lic,
                    'days_left' => $daysLeft,
                ];
            } elseif ($daysLeft <= 30) {
                $expiring[] = [
                    'license' => $lic,
                    'days_left' => $daysLeft,
                ];
            } else {
                $active[] = [
                    'license' => $lic,
                    'days_left' => $daysLeft,
                ];
            }
        }

        // Statistics
        $stats = [
            'total_active' => count($active) + count($expiring),
            'total_expiring' => count($expiring),
            'total_expired' => count($expired),
            'all_count' => count($allLicenses),
        ];

        // Audit Trail Logs of Perizinan Reviews
        $auditLogs = AccessAuditLog::where('action', 'review_perizinan')
            ->with(['admin', 'targetUser'])
            ->orderBy('created_at', 'desc')
            ->take(30)
            ->get();

        return view('perizinan.monitoring', compact('active', 'expiring', 'expired', 'stats', 'auditLogs'));
    }

    /**
     * Simulate sending expiration alert notification.
     */
    public function sendExpiryAlert(Request $request, $id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $user = Auth::user();

        if (!$user->isStaff()) {
            abort(403);
        }

        // Simulate sending email/notification
        // Log the action in Audit Logs
        AccessAuditLog::create([
            'admin_id' => $user->id,
            'target_user_id' => $perizinan->pemohon_id,
            'action' => 'expiry_alert_sent',
            'details' => "Mengirim pengingat masa berlaku untuk izin #{$perizinan->nomor_izin} kepada pemohon {$perizinan->pemohon->name}.",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', "Notifikasi pengingat masa berlaku berhasil dikirim ke " . $perizinan->pemohon->name);
    }

    /**
     * Public verification page (no auth).
     */
    public function verifyPublic($token)
    {
        $perizinan = Perizinan::where('qr_code_token', $token)->with('pemohon')->first();

        $jenisLabels = [
            'ugb' => 'Undian Gratis Berhadiah (UGB)',
            'pub' => 'Pengumpulan Uang atau Barang (PUB)',
            'lks' => 'Tanda Daftar & Izin Operasional LKS',
            'adopsi' => 'Rekomendasi Pengangkatan / Adopsi Anak',
        ];

        return view('perizinan.verify', compact('perizinan', 'jenisLabels', 'token'));
    }

    /**
     * Display printable/downloadable official recommendation letter.
     */
    public function downloadPdf($id)
    {
        $perizinan = Perizinan::with('pemohon')->findOrFail($id);
        $user = Auth::user();

        // Public QR checks point to a public page. This page lets the applicant print their document.
        if (!$user && !$perizinan->qr_code_token) {
            abort(403);
        }

        if ($user && !$user->isStaff() && $perizinan->pemohon_id !== $user->id) {
            abort(403);
        }

        $jenisLabels = [
            'ugb' => 'Undian Gratis Berhadiah (UGB)',
            'pub' => 'Pengumpulan Uang atau Barang (PUB)',
            'lks' => 'Tanda Daftar & Izin Operasional LKS',
            'adopsi' => 'Rekomendasi Pengangkatan / Adopsi Anak',
        ];

        return view('perizinan.cetak', compact('perizinan', 'jenisLabels'));
    }

    /**
     * Show interactive UGB SOP guide.
     */
    public function sopUgb()
    {
        return view('perizinan.sop_ugb');
    }

    /**
     * Show form for submitting UGB execution report.
     */
    public function showLaporanForm($id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $user = Auth::user();

        if ($perizinan->pemohon_id !== $user->id) {
            abort(403, 'Akses tidak sah.');
        }

        if ($perizinan->status !== 'selesai' || $perizinan->jenis_layanan !== 'ugb') {
            abort(400, 'Layanan pelaporan hanya tersedia untuk UGB yang telah terbit izin.');
        }

        if ($perizinan->laporan_status === 'disetujui') {
            return redirect()->route('perizinan.show', $perizinan->id)->with('error', 'Laporan sudah disetujui dan tidak dapat diubah.');
        }

        if ($perizinan->laporan_status === 'diperiksa') {
            return redirect()->route('perizinan.show', $perizinan->id)->with('error', 'Laporan sedang ditinjau oleh petugas. Harap tunggu hasil keputusan.');
        }

        $laporanData = $perizinan->laporan_data ?? [];

        return view('perizinan.laporan_form', compact('perizinan', 'laporanData'));
    }

    /**
     * Submit UGB execution report.
     */
    public function submitLaporan(Request $request, $id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $user = Auth::user();

        if ($perizinan->pemohon_id !== $user->id) {
            abort(403, 'Akses tidak sah.');
        }

        if ($perizinan->status !== 'selesai' || $perizinan->jenis_layanan !== 'ugb') {
            abort(400, 'Aksi tidak valid.');
        }

        if ($perizinan->laporan_status === 'disetujui') {
            return redirect()->route('perizinan.show', $perizinan->id)->with('error', 'Laporan sudah disetujui dan tidak dapat diubah.');
        }

        if ($perizinan->laporan_status === 'diperiksa') {
            return redirect()->route('perizinan.show', $perizinan->id)->with('error', 'Laporan sedang dalam proses peninjauan. Tunggu keputusan petugas.');
        }

        $request->validate([
            'dokumen_laporan' => 'required_without:existing_dokumen_laporan|file|mimes:pdf,docx|max:5120',
            'daftar_pemenang' => 'required_without:existing_daftar_pemenang|file|mimes:pdf,xlsx,xls|max:5120',
            'dokumentasi_kegiatan' => 'required_without:existing_dokumentasi_kegiatan|file|mimes:pdf,jpg,jpeg,png,zip|max:5120',
            'catatan_pelaksanaan' => 'required|string',
        ]);

        $laporanData = $perizinan->laporan_data ?? [];
        $laporanData['catatan_pelaksanaan'] = $request->catatan_pelaksanaan;

        if ($request->hasFile('dokumen_laporan')) {
            if (isset($laporanData['dokumen_laporan'])) {
                Storage::disk('public')->delete($laporanData['dokumen_laporan']);
            }
            $laporanData['dokumen_laporan'] = $request->file('dokumen_laporan')->store('laporan_ugb', 'public');
        }
        if ($request->hasFile('daftar_pemenang')) {
            if (isset($laporanData['daftar_pemenang'])) {
                Storage::disk('public')->delete($laporanData['daftar_pemenang']);
            }
            $laporanData['daftar_pemenang'] = $request->file('daftar_pemenang')->store('laporan_ugb', 'public');
        }
        if ($request->hasFile('dokumentasi_kegiatan')) {
            if (isset($laporanData['dokumentasi_kegiatan'])) {
                Storage::disk('public')->delete($laporanData['dokumentasi_kegiatan']);
            }
            $laporanData['dokumentasi_kegiatan'] = $request->file('dokumentasi_kegiatan')->store('laporan_ugb', 'public');
        }

        $history = $perizinan->history_status ?? [];
        $history[] = [
            'tahap' => 'Pengajuan Laporan',
            'oleh' => $user->name,
            'role' => 'Pemohon',
            'status' => 'diperiksa',
            'catatan' => 'Laporan pelaksanaan UGB berhasil dikirim untuk ditinjau.',
            'waktu' => now()->format('Y-m-d H:i:s'),
        ];

        $perizinan->update([
            'laporan_status' => 'diperiksa',
            'laporan_submitted_at' => now(),
            'laporan_data' => $laporanData,
            'laporan_catatan' => null,
            'history_status' => $history,
        ]);

        return redirect()->route('perizinan.show', $perizinan->id)->with('success', 'Laporan UGB berhasil dikirim.');
    }

    /**
     * Process UGB execution report by officer.
     */
    public function processLaporan(Request $request, $id)
    {
        $perizinan = Perizinan::findOrFail($id);
        $user = Auth::user();

        if (!$user->isStaff() || (!$user->isBidangPemberdayaan() && !$user->isAdmin())) {
            abort(403, 'Akses tidak sah.');
        }

        if ($perizinan->jenis_layanan !== 'ugb' || $perizinan->laporan_status !== 'diperiksa') {
            abort(400, 'Status laporan tidak valid untuk diproses.');
        }

        $validated = $request->validate([
            'action' => 'required|in:approve,perbaikan',
            'catatan' => 'required|string|max:1000',
        ]);

        $action = $validated['action'];
        $catatan = $validated['catatan'];

        $historyLog = [
            'tahap' => 'Verifikasi Laporan UGB',
            'oleh' => $user->name,
            'role' => $this->getRoleLabel($user->role),
            'waktu' => now()->format('Y-m-d H:i:s'),
        ];

        if ($action === 'perbaikan') {
            $laporanStatus = 'perlu_perbaikan';
            $historyLog['status'] = 'Perlu Perbaikan';
            $historyLog['catatan'] = 'Laporan UGB dikembalikan untuk diperbaiki. Catatan: ' . $catatan;
        } else {
            $laporanStatus = 'disetujui';
            $historyLog['status'] = 'Disetujui';
            $historyLog['catatan'] = 'Laporan UGB dinyatakan lengkap dan disetujui. Catatan: ' . $catatan;
        }

        $history = $perizinan->history_status ?? [];
        $history[] = $historyLog;

        $perizinan->update([
            'laporan_status' => $laporanStatus,
            'laporan_catatan' => $catatan,
            'history_status' => $history,
        ]);

        AccessAuditLog::create([
            'admin_id' => $user->id,
            'target_user_id' => $perizinan->pemohon_id,
            'action' => 'review_laporan_ugb',
            'details' => "Petugas {$user->name} memproses Laporan UGB ID #{$perizinan->id} dengan keputusan " . strtoupper($action) . ".",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $msg = $action === 'approve' ? 'Laporan UGB berhasil disetujui.' : 'Laporan UGB dikembalikan untuk perbaikan.';
        return redirect()->route('perizinan.show', $perizinan->id)->with('success', $msg);
    }

    /**
     * Dedicated dashboard for Sekretariat.
     */
    public function sekretariatDashboard()
    {
        $user = Auth::user();
        if ($user->role !== 'sekretariat' && !$user->isAdmin()) {
            abort(403, 'Akses tidak sah untuk peran Anda.');
        }
        $queues = Perizinan::where('tahap_verifikasi', 'sekretariat')->where('status', 'diperiksa')->with('pemohon')->latest()->get();
        return view('admin.sekretariat', compact('user', 'queues'));
    }

    /**
     * Dedicated dashboard for Verifikator.
     */
    public function verifikatorDashboard()
    {
        $user = Auth::user();
        if ($user->role !== 'verifikator' && !$user->isAdmin()) {
            abort(403, 'Akses tidak sah untuk peran Anda.');
        }
        $queues = Perizinan::where('tahap_verifikasi', 'verifikator')->where('status', 'diperiksa')->with('pemohon')->latest()->get();
        return view('admin.verifikator', compact('user', 'queues'));
    }

    /**
     * Dedicated dashboard for Dinsos Wilayah.
     */
    public function wilayahDashboard()
    {
        $user = Auth::user();
        if ($user->role !== 'dinsos_wilayah' && !$user->isAdmin()) {
            abort(403, 'Akses tidak sah untuk peran Anda.');
        }
        $queues = Perizinan::where('tahap_verifikasi', 'dinsos_wilayah')->where('status', 'diperiksa')->with('pemohon')->latest()->get();
        return view('admin.wilayah', compact('user', 'queues'));
    }

    /**
     * Dedicated dashboard for Bidang Pemberdayaan.
     */
    public function pemberdayaanDashboard()
    {
        $user = Auth::user();
        if ($user->role !== 'bidang_pemberdayaan' && !$user->isAdmin()) {
            abort(403, 'Akses tidak sah untuk peran Anda.');
        }
        $queues = Perizinan::where('tahap_verifikasi', 'bidang_teknis')->whereIn('jenis_layanan', ['ugb', 'pub', 'lks'])->where('status', 'diperiksa')->with('pemohon')->latest()->get();
        $reportQueues = Perizinan::where('jenis_layanan', 'ugb')->where('laporan_status', 'diperiksa')->with('pemohon')->latest()->get();
        return view('admin.pemberdayaan', compact('user', 'queues', 'reportQueues'));
    }

    /**
     * Dedicated dashboard for Bidang Linjamsos.
     */
    public function linjamsosDashboard()
    {
        $user = Auth::user();
        if ($user->role !== 'bidang_linjamsos' && !$user->isAdmin()) {
            abort(403, 'Akses tidak sah untuk peran Anda.');
        }
        $queues = Perizinan::where('tahap_verifikasi', 'bidang_teknis')->where('jenis_layanan', 'adopsi')->where('status', 'diperiksa')->with('pemohon')->latest()->get();
        return view('admin.linjamsos', compact('user', 'queues'));
    }

    /**
     * Dedicated dashboard for Kepala Dinas.
     */
    public function kadinasDashboard()
    {
        $user = Auth::user();
        if ($user->role !== 'kadinas' && !$user->isAdmin()) {
            abort(403, 'Akses tidak sah untuk peran Anda.');
        }
        $queues = Perizinan::where('tahap_verifikasi', 'kepala_dinas')->where('status', 'diperiksa')->with('pemohon')->latest()->get();
        return view('admin.kadinas', compact('user', 'queues'));
    }

    /**
     * Get label for user roles.
     */
    private function getRoleLabel($role)
    {
        return match($role) {
            'admin' => 'Admin (Super)',
            'sekretariat' => 'Sekretariat / Operator',
            'verifikator' => 'Verifikator Administrasi',
            'dinsos_wilayah' => 'Dinsos Kab/Kota',
            'bidang_pemberdayaan' => 'Bidang Pemberdayaan Sosial',
            'bidang_linjamsos' => 'Bidang Linjamsos',
            'kadinas' => 'Kepala Dinas',
            default => 'Petugas',
        };
    }
}
