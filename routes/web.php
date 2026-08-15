<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PatroliUgbController;
use App\Http\Controllers\PenyegelanUgbController;
use App\Http\Controllers\PemberdayaanSosialController;
use App\Http\Controllers\RehabilitasiSosialController;

// 1. Welcome Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 2. Authentication Pages
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Registrasi Masyarakat (Subproses 1.1)
    Route::get('/register/masyarakat', [AuthController::class, 'showRegisterMasyarakatForm'])->name('register.masyarakat');
    Route::post('/register/masyarakat', [AuthController::class, 'registerMasyarakat']);

    // Registrasi Lembaga / Perusahaan / Instansi (Subproses 1.2)
    Route::get('/register/lembaga', [AuthController::class, 'showRegisterLembagaForm'])->name('register.lembaga');
    Route::post('/register/lembaga', [AuthController::class, 'registerLembaga']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 3. Authenticated Routes (Protected)
Route::middleware('auth')->group(function () {
    // Routes that do NOT require validated account status
    Route::get('/account/pending', [AuthController::class, 'showPendingStatus'])->name('account.pending');
    Route::get('/account/rejected', [AuthController::class, 'showRejectedStatus'])->name('account.rejected');
    Route::post('/account/resubmit', [AuthController::class, 'resubmitRegistration'])->name('account.resubmit');

    // Routes that DO require validated account status
    Route::middleware('account.status')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile Routes (which will submit profile update requests)
        Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

        // Perizinan Routes (Pemohon)
        Route::get('/perizinan', [\App\Http\Controllers\PerizinanController::class, 'index'])->name('perizinan.index');
        Route::get('/perizinan/buat', [\App\Http\Controllers\PerizinanController::class, 'create'])->name('perizinan.create');
        Route::get('/perizinan/sop/ugb', [\App\Http\Controllers\PerizinanController::class, 'sopUgb'])->name('perizinan.sop.ugb');
        Route::get('/perizinan/sop/pub', [\App\Http\Controllers\PerizinanController::class, 'sopPub'])->name('perizinan.sop.pub');
        Route::get('/perizinan/sop/izin-pub', [\App\Http\Controllers\PerizinanController::class, 'sopIzinPub'])->name('perizinan.sop.izin_pub');
        Route::get('/perizinan/sop/pengelolaan-barang', [\App\Http\Controllers\PerizinanController::class, 'sopPengelolaanBarang'])->name('perizinan.sop.pengelolaan_barang');
        Route::get('/perizinan/sop/monitoring', [\App\Http\Controllers\PerizinanController::class, 'sopMonitoring'])->name('perizinan.sop.monitoring');
        Route::get('/perizinan/buat/{jenis}', [\App\Http\Controllers\PerizinanController::class, 'form'])->name('perizinan.form');
        Route::post('/perizinan/buat/{jenis}', [\App\Http\Controllers\PerizinanController::class, 'store'])->name('perizinan.store');
        Route::get('/perizinan/{perizinan}', [\App\Http\Controllers\PerizinanController::class, 'show'])->name('perizinan.show');
        Route::get('/perizinan/{perizinan}/edit', [\App\Http\Controllers\PerizinanController::class, 'edit'])->name('perizinan.edit');
        Route::put('/perizinan/{perizinan}/edit', [\App\Http\Controllers\PerizinanController::class, 'update'])->name('perizinan.update');
        Route::get('/perizinan/{perizinan}/laporan', [\App\Http\Controllers\PerizinanController::class, 'showLaporanForm'])->name('perizinan.laporan.form');
        Route::post('/perizinan/{perizinan}/laporan', [\App\Http\Controllers\PerizinanController::class, 'submitLaporan'])->name('perizinan.laporan.submit');

        // Dokumen Perizinan (upload per jenis dokumen)
        Route::get('/perizinan/{id}/dokumen', [\App\Http\Controllers\PerizinanController::class, 'getDokumenList'])->name('perizinan.dokumen.index');
        Route::post('/perizinan/{id}/dokumen', [\App\Http\Controllers\PerizinanController::class, 'uploadDokumen'])->name('perizinan.dokumen.upload');

        // ==========================================
        // PROSES BISNIS 3: REHABILITASI SOSIAL
        // ==========================================
        Route::prefix('rehabilitasi')->name('rehabilitasi.')->group(function () {
            Route::get('/', [RehabilitasiSosialController::class, 'index'])->name('index');
            Route::get('/monitoring', [RehabilitasiSosialController::class, 'monitoringIndex'])->name('monitoring');
            Route::get('/sop/gizi-anak', [RehabilitasiSosialController::class, 'sopGiziAnak'])->name('sop.gizi_anak');
            
            // Per Kategori Subproses
            Route::get('/kategori/{kategori}', [RehabilitasiSosialController::class, 'subprosesIndex'])->name('subproses.index');
            Route::get('/kategori/{kategori}/buat', [RehabilitasiSosialController::class, 'create'])->name('create');
            Route::post('/kategori/{kategori}/buat', [RehabilitasiSosialController::class, 'store'])->name('store');
            
            // Detail & Actions
            Route::get('/kasus/{id}', [RehabilitasiSosialController::class, 'show'])->name('show');
            Route::post('/kasus/{id}/verifikasi-admin', [RehabilitasiSosialController::class, 'verifikasiAdminStore'])->name('verifikasi_admin');
            Route::post('/kasus/{id}/verifikasi-wilayah', [RehabilitasiSosialController::class, 'verifikasiWilayahStore'])->name('verifikasi_wilayah');
            Route::post('/kasus/{id}/asesmen', [RehabilitasiSosialController::class, 'asesmenStore'])->name('asesmen');
            Route::post('/kasus/{id}/rekomendasi', [RehabilitasiSosialController::class, 'rekomendasiStore'])->name('rekomendasi');
            Route::post('/kasus/{id}/tanggapan-rujukan', [RehabilitasiSosialController::class, 'tanggapanRujukanStore'])->name('tanggapan_rujukan');
            Route::post('/kasus/{id}/tambah-progress', [RehabilitasiSosialController::class, 'tambahProgressStore'])->name('tambah_progress');
            Route::post('/kasus/{id}/selesai', [RehabilitasiSosialController::class, 'selesaiStore'])->name('selesai');
        });

        // ==========================================
        // PROSES BISNIS 2: PEMBERDAYAAN SOSIAL
        // ==========================================
        Route::prefix('pemberdayaan')->name('pemberdayaan.')->group(function () {
            Route::get('/', [PemberdayaanSosialController::class, 'index'])->name('index');

            // 2.1 Pembinaan Kelembagaan Sosial
            Route::get('/kelembagaan', [PemberdayaanSosialController::class, 'kelembagaanIndex'])->name('kelembagaan.index');
            Route::get('/kelembagaan/sop-bk3s', [PemberdayaanSosialController::class, 'kelembagaanSopBk3s'])->name('kelembagaan.sop_bk3s');
            Route::get('/kelembagaan/sop-stp', [PemberdayaanSosialController::class, 'kelembagaanSopStp'])->name('kelembagaan.sop_stp');
            Route::get('/kelembagaan/buat', [PemberdayaanSosialController::class, 'kelembagaanCreate'])->name('kelembagaan.create');
            Route::post('/kelembagaan/buat', [PemberdayaanSosialController::class, 'kelembagaanStore'])->name('kelembagaan.store');
            Route::get('/kelembagaan/{id}', [PemberdayaanSosialController::class, 'kelembagaanShow'])->name('kelembagaan.show');
            Route::post('/kelembagaan/{id}/agenda', [PemberdayaanSosialController::class, 'kelembagaanAgendaStore'])->name('kelembagaan.agenda.store');
            Route::post('/kelembagaan/{id}/hasil', [PemberdayaanSosialController::class, 'kelembagaanHasilStore'])->name('kelembagaan.hasil.store');
            Route::post('/kelembagaan/{id}/arsip', [PemberdayaanSosialController::class, 'kelembagaanArsipStore'])->name('kelembagaan.arsip.store');
            Route::post('/kelembagaan/{id}/approval', [PemberdayaanSosialController::class, 'kelembagaanApprovalStore'])->name('kelembagaan.approval.store');

            // 2.2 Pembinaan Pilar-Pilar Sosial
            Route::get('/pilar', [PemberdayaanSosialController::class, 'pilarIndex'])->name('pilar.index');
            Route::get('/pilar/sop-tksk', [PemberdayaanSosialController::class, 'pilarSopTksk'])->name('pilar.sop_tksk');
            Route::get('/pilar/sop-ipsm', [PemberdayaanSosialController::class, 'pilarSopIpsm'])->name('pilar.sop_ipsm');
            Route::get('/pilar/sop-karang-taruna', [PemberdayaanSosialController::class, 'pilarSopKarangTaruna'])->name('pilar.sop_karang_taruna');
            Route::get('/pilar/buat', [PemberdayaanSosialController::class, 'pilarCreate'])->name('pilar.create');
            Route::post('/pilar/buat', [PemberdayaanSosialController::class, 'pilarStore'])->name('pilar.store');
            Route::get('/pilar/{id}', [PemberdayaanSosialController::class, 'pilarShow'])->name('pilar.show');
            Route::post('/pilar/{id}/bimtek', [PemberdayaanSosialController::class, 'pilarBimtekStore'])->name('pilar.bimtek.store');
            Route::post('/pilar/{id}/evaluasi', [PemberdayaanSosialController::class, 'pilarEvaluasiStore'])->name('pilar.evaluasi.store');
            Route::post('/pilar/{id}/arsip', [PemberdayaanSosialController::class, 'pilarArsipStore'])->name('pilar.arsip.store');
            Route::post('/pilar/{id}/approval', [PemberdayaanSosialController::class, 'pilarApprovalStore'])->name('pilar.approval.store');

            // 2.3 Fasilitasi Komunitas / Kelompok Rentan
            Route::get('/komunitas', [PemberdayaanSosialController::class, 'komunitasIndex'])->name('komunitas.index');
            Route::get('/komunitas/buat', [PemberdayaanSosialController::class, 'komunitasCreate'])->name('komunitas.create');
            Route::post('/komunitas/buat', [PemberdayaanSosialController::class, 'komunitasStore'])->name('komunitas.store');
            Route::get('/komunitas/{id}', [PemberdayaanSosialController::class, 'komunitasShow'])->name('komunitas.show');
            Route::post('/komunitas/{id}/verifikasi-wilayah', [PemberdayaanSosialController::class, 'komunitasVerifikasiWilayah'])->name('komunitas.verifikasi_wilayah');
            Route::post('/komunitas/{id}/fasilitasi', [PemberdayaanSosialController::class, 'komunitasFasilitasiStore'])->name('komunitas.fasilitasi.store');
            Route::post('/komunitas/{id}/arsip', [PemberdayaanSosialController::class, 'komunitasArsipStore'])->name('komunitas.arsip.store');
            Route::post('/komunitas/{id}/approval', [PemberdayaanSosialController::class, 'komunitasApprovalStore'])->name('komunitas.approval.store');

            // 2.4 Kegiatan Kesetiakawanan, Restorasi & Penyuluhan
            Route::get('/kesetiakawanan', [PemberdayaanSosialController::class, 'kesetiakawananIndex'])->name('kesetiakawanan.index');
            Route::get('/kesetiakawanan/buat', [PemberdayaanSosialController::class, 'kesetiakawananCreate'])->name('kesetiakawanan.create');
            Route::post('/kesetiakawanan/buat', [PemberdayaanSosialController::class, 'kesetiakawananStore'])->name('kesetiakawanan.store');
            Route::get('/kesetiakawanan/{id}', [PemberdayaanSosialController::class, 'kesetiakawananShow'])->name('kesetiakawanan.show');
            Route::post('/kesetiakawanan/{id}/daftar', [PemberdayaanSosialController::class, 'kesetiakawananPesertaRegister'])->name('kesetiakawanan.daftar');
            Route::post('/kesetiakawanan/{id}/laporan', [PemberdayaanSosialController::class, 'kesetiakawananLaporanStore'])->name('kesetiakawanan.laporan.store');
            Route::post('/kesetiakawanan/{id}/arsip', [PemberdayaanSosialController::class, 'kesetiakawananArsipStore'])->name('kesetiakawanan.arsip.store');
            Route::post('/kesetiakawanan/{id}/approval', [PemberdayaanSosialController::class, 'kesetiakawananApprovalStore'])->name('kesetiakawanan.approval.store');

            // 2.5 Pengelolaan Kepahlawanan & TMP
            Route::get('/kepahlawanan', [PemberdayaanSosialController::class, 'kepahlawananIndex'])->name('kepahlawanan.index');
            Route::get('/kepahlawanan/sop-perawatan-tmp', [PemberdayaanSosialController::class, 'kepahlawananSopPerawatanTmp'])->name('kepahlawanan.sop_perawatan_tmp');
            Route::get('/kepahlawanan/sop-cpn', [PemberdayaanSosialController::class, 'kepahlawananSopCpn'])->name('kepahlawanan.sop_cpn');
            Route::get('/kepahlawanan/sop-sidang-tp2gd', [PemberdayaanSosialController::class, 'kepahlawananSopSidangTp2gd'])->name('kepahlawanan.sop_sidang_tp2gd');
            Route::get('/kepahlawanan/sop-perintis-kemerdekaan', [PemberdayaanSosialController::class, 'kepahlawananSopPerintisKemerdekaan'])->name('kepahlawanan.sop_perintis_kemerdekaan');
            Route::get('/kepahlawanan/sop-janda-perintis', [PemberdayaanSosialController::class, 'kepahlawananSopJandaPerintis'])->name('kepahlawanan.sop_janda_perintis');
            Route::get('/kepahlawanan/sop-pemutakhiran-pkjpk', [PemberdayaanSosialController::class, 'kepahlawananSopPemutakhiranPkjpk'])->name('kepahlawanan.sop_pemutakhiran_pkjpk');
            Route::get('/kepahlawanan/buat', [PemberdayaanSosialController::class, 'kepahlawananCreate'])->name('kepahlawanan.create');
            Route::post('/kepahlawanan/buat', [PemberdayaanSosialController::class, 'kepahlawananStore'])->name('kepahlawanan.store');
            Route::get('/kepahlawanan/{id}', [PemberdayaanSosialController::class, 'kepahlawananShow'])->name('kepahlawanan.show');
            Route::post('/kepahlawanan/{id}/agenda', [PemberdayaanSosialController::class, 'kepahlawananAgendaStore'])->name('kepahlawanan.agenda.store');
            Route::post('/kepahlawanan/{id}/laporan', [PemberdayaanSosialController::class, 'kepahlawananLaporanStore'])->name('kepahlawanan.laporan.store');
            Route::post('/kepahlawanan/{id}/arsip', [PemberdayaanSosialController::class, 'kepahlawananArsipStore'])->name('kepahlawanan.arsip.store');
            Route::post('/kepahlawanan/{id}/approval', [PemberdayaanSosialController::class, 'kepahlawananApprovalStore'])->name('kepahlawanan.approval.store');

            // 2.6 Monitoring dan Evaluasi (Monev)
            Route::get('/monev', [PemberdayaanSosialController::class, 'monevIndex'])->name('monev.index');
            Route::get('/monev/buat', [PemberdayaanSosialController::class, 'monevCreate'])->name('monev.create');
            Route::post('/monev/buat', [PemberdayaanSosialController::class, 'monevStore'])->name('monev.store');
            Route::get('/monev/{id}', [PemberdayaanSosialController::class, 'monevShow'])->name('monev.show');
            Route::post('/monev/{id}/analisis', [PemberdayaanSosialController::class, 'monevAnalisisStore'])->name('monev.analisis.store');
            Route::post('/monev/{id}/arsip', [PemberdayaanSosialController::class, 'monevArsipStore'])->name('monev.arsip.store');
            Route::post('/monev/{id}/approval', [PemberdayaanSosialController::class, 'monevApprovalStore'])->name('monev.approval.store');
        });
    });

    // 4. User Management & Validation Page (Protected + Staff/Verifikator Role required)
    Route::middleware('staff')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');

        // Integrated Data Validation (Subproses 1.5)
        Route::post('/users/{user}/validate', [UserManagementController::class, 'validateData'])->name('users.validate');

        // Profile Update Requests Management (Subproses 1.3 & 1.4)
        Route::get('/profile-requests', [UserManagementController::class, 'profileRequestsIndex'])->name('profile-requests.index');
        Route::put('/profile-requests/{profileRequest}', [UserManagementController::class, 'handleProfileRequest'])->name('profile-requests.handle');
    });

    // 5. Perizinan Admin/Staff Routes (Protected + Staff Role required)
    Route::middleware('staff')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/perizinan/monitoring', [\App\Http\Controllers\PerizinanController::class, 'monitoring'])->name('perizinan.monitoring');
        Route::post('/perizinan/monitoring/{id}/alert', [\App\Http\Controllers\PerizinanController::class, 'sendExpiryAlert'])->name('perizinan.send_alert');
        Route::post('/perizinan/{perizinan}/proses', [\App\Http\Controllers\PerizinanController::class, 'process'])->name('perizinan.process');
        Route::post('/perizinan/{perizinan}/laporan/proses', [\App\Http\Controllers\PerizinanController::class, 'processLaporan'])->name('perizinan.laporan.process');

        // Berita Acara Pemeriksaan
        Route::get('/perizinan/{id}/berita-acara', [\App\Http\Controllers\PerizinanController::class, 'createBeritaAcara'])->name('perizinan.berita_acara.create');
        Route::post('/perizinan/{id}/berita-acara', [\App\Http\Controllers\PerizinanController::class, 'storeBeritaAcara'])->name('perizinan.berita_acara.store');

        // Review Dokumen oleh Staff
        Route::post('/dokumen/{dokumen}/review', [\App\Http\Controllers\PerizinanController::class, 'reviewDokumen'])->name('dokumen.review');

        // Patroli UGB
        Route::get('/patroli-ugb', [PatroliUgbController::class, 'index'])->name('patroli_ugb.index');
        Route::get('/patroli-ugb/buat', [PatroliUgbController::class, 'create'])->name('patroli_ugb.create');
        Route::post('/patroli-ugb', [PatroliUgbController::class, 'store'])->name('patroli_ugb.store');
        Route::get('/patroli-ugb/{id}/edit', [PatroliUgbController::class, 'edit'])->name('patroli_ugb.edit');
        Route::put('/patroli-ugb/{id}', [PatroliUgbController::class, 'update'])->name('patroli_ugb.update');
        Route::get('/patroli-ugb/{id}', [PatroliUgbController::class, 'show'])->name('patroli_ugb.show');
        Route::get('/patroli-ugb/{id}/surat-tugas', [PatroliUgbController::class, 'suratTugas'])->name('patroli_ugb.surat_tugas');

        // Penyegelan UGB
        Route::get('/penyegelan-ugb', [PenyegelanUgbController::class, 'index'])->name('penyegelan_ugb.index');
        Route::get('/penyegelan-ugb/{perizinan_id}', [PenyegelanUgbController::class, 'show'])->name('penyegelan_ugb.show');
        Route::post('/penyegelan-ugb/{perizinan_id}', [PenyegelanUgbController::class, 'store'])->name('penyegelan_ugb.store');

        // Dedicated Role Dashboards
        Route::get('/sekretariat', [\App\Http\Controllers\PerizinanController::class, 'sekretariatDashboard'])->name('sekretariat');
        Route::get('/verifikator', [\App\Http\Controllers\PerizinanController::class, 'verifikatorDashboard'])->name('verifikator');
        Route::get('/wilayah', [\App\Http\Controllers\PerizinanController::class, 'wilayahDashboard'])->name('wilayah');
        Route::get('/pemberdayaan', [\App\Http\Controllers\PerizinanController::class, 'pemberdayaanDashboard'])->name('pemberdayaan');
        Route::get('/linjamsos', [\App\Http\Controllers\PerizinanController::class, 'linjamsosDashboard'])->name('linjamsos');
        Route::get('/kadinas', [\App\Http\Controllers\PerizinanController::class, 'kadinasDashboard'])->name('kadinas');
    });
});

// 6. Public Verification & Document Print (Guest / Auth)
Route::get('/verifikasi-dokumen/{token}', [\App\Http\Controllers\PerizinanController::class, 'verifyPublic'])->name('perizinan.verify_public');
Route::get('/perizinan/{perizinan}/unduh', [\App\Http\Controllers\PerizinanController::class, 'downloadPdf'])->name('perizinan.download_pdf');

