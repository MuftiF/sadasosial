<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManagementController;

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
        Route::get('/perizinan/buat/{jenis}', [\App\Http\Controllers\PerizinanController::class, 'form'])->name('perizinan.form');
        Route::post('/perizinan/buat/{jenis}', [\App\Http\Controllers\PerizinanController::class, 'store'])->name('perizinan.store');
        Route::get('/perizinan/{perizinan}', [\App\Http\Controllers\PerizinanController::class, 'show'])->name('perizinan.show');
        Route::get('/perizinan/{perizinan}/edit', [\App\Http\Controllers\PerizinanController::class, 'edit'])->name('perizinan.edit');
        Route::put('/perizinan/{perizinan}/edit', [\App\Http\Controllers\PerizinanController::class, 'update'])->name('perizinan.update');
        Route::get('/perizinan/{perizinan}/laporan', [\App\Http\Controllers\PerizinanController::class, 'showLaporanForm'])->name('perizinan.laporan.form');
        Route::post('/perizinan/{perizinan}/laporan', [\App\Http\Controllers\PerizinanController::class, 'submitLaporan'])->name('perizinan.laporan.submit');
    });

    // 4. User Management Page (Protected + Admin Role required)
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
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

