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
        
        // Mock data tailored for the "Sada Sosial" theme
        $stats = [
            'total_donation' => 'Rp 148.500.000',
            'active_campaigns' => 12,
            'volunteers_count' => 340,
            'personal_contribution' => 'Rp 1.250.000',
        ];

        $recentCampaigns = [
            [
                'title' => 'Bantu Korban Banjir Wilayah Utara',
                'category' => 'Bencana Alam',
                'target' => 'Rp 50.000.000',
                'collected' => 'Rp 42.150.000',
                'percentage' => 84,
                'status' => 'Mendesak',
            ],
            [
                'title' => 'Beasiswa Pendidikan Anak Pesisir',
                'category' => 'Pendidikan',
                'target' => 'Rp 30.000.000',
                'collected' => 'Rp 18.000.000',
                'percentage' => 60,
                'status' => 'Aktif',
            ],
            [
                'title' => 'Pangan Sehat Untuk Lansia Dhuafa',
                'category' => 'Sosial',
                'target' => 'Rp 15.000.000',
                'collected' => 'Rp 15.200.000',
                'percentage' => 100,
                'status' => 'Selesai',
            ],
        ];

        return view('dashboard', compact('user', 'stats', 'recentCampaigns'));
    }
}
