<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Perizinan;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->isStaff()) {
            if ($user->role === 'sekretariat') {
                $queueCount = Perizinan::where('tahap_verifikasi', 'sekretariat')->where('status', 'diperiksa')->count();
                $processedCount = Perizinan::whereNotIn('tahap_verifikasi', ['sekretariat'])->count();
                $stats = [
                    'total_permohonan' => $queueCount,
                    'draft' => 0,
                    'diperiksa' => $queueCount,
                    'disetujui' => $processedCount,
                    'ditolak' => 0,
                    'selesai' => 0,
                    'role_label' => 'Menunggu Pemeriksaan Sekretariat',
                ];
            } elseif ($user->role === 'verifikator') {
                $queueCount = Perizinan::where('tahap_verifikasi', 'verifikator')->where('status', 'diperiksa')->count();
                $processedCount = Perizinan::whereNotIn('tahap_verifikasi', ['sekretariat', 'verifikator'])->count();
                $stats = [
                    'total_permohonan' => $queueCount,
                    'draft' => 0,
                    'diperiksa' => $queueCount,
                    'disetujui' => $processedCount,
                    'ditolak' => 0,
                    'selesai' => 0,
                    'role_label' => 'Menunggu Verifikasi Administrasi',
                ];
            } elseif ($user->role === 'dinsos_wilayah') {
                $queueCount = Perizinan::where('tahap_verifikasi', 'dinsos_wilayah')->where('status', 'diperiksa')->count();
                $processedCount = Perizinan::whereNotIn('tahap_verifikasi', ['sekretariat', 'verifikator', 'dinsos_wilayah'])->count();
                $stats = [
                    'total_permohonan' => $queueCount,
                    'draft' => 0,
                    'diperiksa' => $queueCount,
                    'disetujui' => $processedCount,
                    'ditolak' => 0,
                    'selesai' => 0,
                    'role_label' => 'Menunggu Konfirmasi Wilayah',
                ];
            } elseif ($user->role === 'bidang_pemberdayaan') {
                $queueCount = Perizinan::where('tahap_verifikasi', 'bidang_teknis')->whereIn('jenis_layanan', ['ugb', 'pub', 'lks'])->where('status', 'diperiksa')->count();
                $reportQueueCount = Perizinan::where('jenis_layanan', 'ugb')->where('laporan_status', 'diperiksa')->count();
                $totalActive = $queueCount + $reportQueueCount;
                $processedCount = Perizinan::where('tahap_verifikasi', 'kepala_dinas')->whereIn('jenis_layanan', ['ugb', 'pub', 'lks'])->count();
                $stats = [
                    'total_permohonan' => $totalActive,
                    'draft' => $reportQueueCount,
                    'diperiksa' => $queueCount,
                    'disetujui' => $processedCount,
                    'ditolak' => Perizinan::where('status', 'ditolak')->whereIn('jenis_layanan', ['ugb', 'pub', 'lks'])->count(),
                    'selesai' => 0,
                    'role_label' => 'Antrean Bidang Pemberdayaan',
                ];
            } elseif ($user->role === 'bidang_linjamsos') {
                $queueCount = Perizinan::where('tahap_verifikasi', 'bidang_teknis')->where('jenis_layanan', 'adopsi')->where('status', 'diperiksa')->count();
                $processedCount = Perizinan::where('tahap_verifikasi', 'kepala_dinas')->where('jenis_layanan', 'adopsi')->count();
                $stats = [
                    'total_permohonan' => $queueCount,
                    'draft' => 0,
                    'diperiksa' => $queueCount,
                    'disetujui' => $processedCount,
                    'ditolak' => Perizinan::where('status', 'ditolak')->where('jenis_layanan', 'adopsi')->count(),
                    'selesai' => 0,
                    'role_label' => 'Menunggu Telaah Bidang Linjamsos',
                ];
            } elseif ($user->role === 'kadinas') {
                $queueCount = Perizinan::where('tahap_verifikasi', 'kepala_dinas')->where('status', 'diperiksa')->count();
                $processedCount = Perizinan::where('status', 'selesai')->count();
                $stats = [
                    'total_permohonan' => $queueCount,
                    'draft' => 0,
                    'diperiksa' => $queueCount,
                    'disetujui' => $processedCount,
                    'ditolak' => Perizinan::where('status', 'ditolak')->count(),
                    'selesai' => 0,
                    'role_label' => 'Menunggu TTE Kepala Dinas',
                ];
            } else { // admin
                $queueCount = Perizinan::where('status', 'diperiksa')->count();
                $stats = [
                    'total_permohonan' => $queueCount,
                    'draft' => Perizinan::where('status', 'draft')->count(),
                    'diperiksa' => $queueCount,
                    'disetujui' => Perizinan::whereIn('status', ['disetujui', 'selesai'])->count(),
                    'ditolak' => Perizinan::where('status', 'ditolak')->count(),
                    'selesai' => 0,
                    'role_label' => 'Total Antrean Aktif Sistem',
                ];
            }

            $recentPermohonan = [];
            $rejectedPermohonan = collect();

        } else {
            $perizinans = $user->perizinans();
            $stats = [
                'total_permohonan' => $perizinans->count(),
                'draft' => $user->perizinans()->where('status', 'draft')->count(),
                'diperiksa' => $user->perizinans()->where('status', 'diperiksa')->count(),
                'disetujui' => $user->perizinans()->where('status', 'disetujui')->count(),
                'ditolak' => $user->perizinans()->where('status', 'ditolak')->count(),
                'selesai' => $user->perizinans()->where('status', 'selesai')->count(),
                'role_label' => 'Semua layanan',
            ];
            $recentPermohonan = $user->perizinans()->latest()->take(3)->get();
            // Fetch all rejected applications for notification banners
            $rejectedPermohonan = $user->perizinans()->where('status', 'ditolak')->latest()->get();
        }

        return view('dashboard', compact('user', 'stats', 'recentPermohonan', 'rejectedPermohonan'));
    }
}
