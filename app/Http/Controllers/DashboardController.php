<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        $perizinans = $user->perizinans();

        $stats = [
            'total_permohonan' => $perizinans->count(),
            'draft' => $user->perizinans()->where('status', 'draft')->count(),
            'diperiksa' => $user->perizinans()->where('status', 'diperiksa')->count(),
            'disetujui' => $user->perizinans()->where('status', 'disetujui')->count(),
            'ditolak' => $user->perizinans()->where('status', 'ditolak')->count(),
            'selesai' => $user->perizinans()->where('status', 'selesai')->count(),
        ];

        $recentPermohonan = $user->perizinans()->latest()->take(3)->get();

        return view('dashboard', compact('user', 'stats', 'recentPermohonan'));
    }
}
