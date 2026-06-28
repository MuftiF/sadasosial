@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header/Greeting -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Dashboard Utama</h1>
            <p class="text-sm text-slate-400 mt-1">Pantau statistik penggalangan dana dan aktivitas relawan di sini.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500 animate-ping"></span>
            <span class="text-xs font-semibold text-emerald-400">Sistem Berjalan Normal</span>
        </div>
    </div>

    <!-- Quick Role Warning / Actions Banner -->
    @if($user->isAdmin())
        <div class="mb-8 p-4 rounded-2xl border border-indigo-500/20 bg-indigo-500/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/20 text-indigo-400 font-extrabold">
                    🔑
                </span>
                <div>
                    <h3 class="text-sm font-bold text-slate-200">Hak Akses Administrator</h3>
                    <p class="text-xs text-slate-400">Anda dapat memantau semua pengguna, mengelola data peran, dan mengedit user.</p>
                </div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-indigo-500 hover:scale-[1.01] transition-all duration-200">
                Kelola Pengguna &rarr;
            </a>
        </div>
    @endif

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Widget 1: Total Donasi -->
        <div class="glass-panel rounded-2xl p-6 glow-emerald">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Dana Terkumpul</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400 text-sm">💰</span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['total_donation'] }}</h2>
            <p class="text-[11px] text-emerald-400 font-semibold mt-2 flex items-center gap-1">
                <span>&uarr; 14.2%</span> <span class="text-slate-500 font-normal">dari bulan lalu</span>
            </p>
        </div>

        <!-- Widget 2: Kampanye Aktif -->
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kampanye Aktif</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400 text-sm">📢</span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['active_campaigns'] }}</h2>
            <p class="text-[11px] text-blue-400 font-semibold mt-2 flex items-center gap-1">
                <span>3 Mendesak</span> <span class="text-slate-500 font-normal">perlu penanganan</span>
            </p>
        </div>

        <!-- Widget 3: Relawan Bergabung -->
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Relawan Terdaftar</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-500/10 text-purple-400 text-sm">👥</span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['volunteers_count'] }}</h2>
            <p class="text-[11px] text-purple-400 font-semibold mt-2 flex items-center gap-1">
                <span>+24 Relawan baru</span> <span class="text-slate-500 font-normal">minggu ini</span>
            </p>
        </div>

        <!-- Widget 4: Peran Anda -->
        <div class="glass-panel rounded-2xl p-6 {{ $user->isAdmin() ? 'glow-indigo border-indigo-500/20' : 'glow-emerald border-emerald-500/20' }}">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Akun &amp; Hak Peran</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-400 text-sm">👤</span>
            </div>
            <h2 class="text-xl font-black text-white truncate">{{ $user->name }}</h2>
            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold mt-2 {{ $user->isAdmin() ? 'bg-indigo-400/10 text-indigo-400 ring-1 ring-inset ring-indigo-400/20' : 'bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20' }}">
                Status: {{ strtoupper($user->role) }}
            </span>
        </div>
    </div>

    <!-- Campaigns Section & Side Details -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Panel: Campaigns -->
        <div class="lg:col-span-8 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-900 pb-3">
                <h3 class="text-lg font-bold text-white">Daftar Kampanye Unggulan</h3>
                <span class="text-xs text-emerald-400 font-semibold cursor-pointer hover:underline">Lihat Semua</span>
            </div>

            <!-- Campaign Cards list -->
            <div class="grid grid-cols-1 gap-6">
                @foreach($recentCampaigns as $campaign)
                    <div class="glass-panel rounded-2xl p-6 hover:border-slate-700 transition duration-200">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-start gap-4 mb-4">
                            <div>
                                <span class="inline-flex items-center rounded-full bg-slate-900 px-2.5 py-0.5 text-[10px] font-bold text-slate-400 ring-1 ring-inset ring-slate-800">
                                    {{ $campaign['category'] }}
                                </span>
                                <h4 class="text-base font-extrabold text-white mt-1.5">{{ $campaign['title'] }}</h4>
                            </div>
                            <div>
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold {{ $campaign['status'] === 'Mendesak' ? 'bg-rose-500/10 text-rose-400 ring-1 ring-rose-500/20' : ($campaign['status'] === 'Selesai' ? 'bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/20' : 'bg-blue-500/10 text-blue-400 ring-1 ring-blue-500/20') }}">
                                    {{ $campaign['status'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Donation Progress bar -->
                        <div class="space-y-2 mt-4">
                            <div class="flex justify-between text-xs font-semibold">
                                <span class="text-slate-400">Terkumpul: <strong class="text-emerald-400">{{ $campaign['collected'] }}</strong></span>
                                <span class="text-slate-400">Target: <strong>{{ $campaign['target'] }}</strong></span>
                            </div>
                            <div class="h-2 w-full rounded-full bg-slate-950 overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full transition-all duration-500" style="width: {{ $campaign['percentage'] }}%"></div>
                            </div>
                            <div class="flex justify-end">
                                <span class="text-[10px] font-bold text-slate-500">{{ $campaign['percentage'] }}% Terpenuhi</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Side Panel: Activity Logs & Info -->
        <div class="lg:col-span-4 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-900 pb-3">
                <h3 class="text-lg font-bold text-white">Log Keamanan</h3>
                <span class="text-xs text-slate-500">Real-time</span>
            </div>

            <div class="glass-panel rounded-2xl p-5 space-y-4">
                <div class="flex gap-3">
                    <span class="text-sm">🔑</span>
                    <div class="text-xs">
                        <p class="font-bold text-slate-200">Login Berhasil</p>
                        <p class="text-slate-400 mt-0.5">Pengguna <strong class="text-slate-300">{{ $user->name }}</strong> masuk sebagai <strong class="text-slate-300">{{ $user->role }}</strong>.</p>
                        <p class="text-[10px] text-slate-500 mt-1">Sesaat yang lalu</p>
                    </div>
                </div>

                <div class="flex gap-3 pt-3 border-t border-slate-900">
                    <span class="text-sm">⚙️</span>
                    <div class="text-xs">
                        <p class="font-bold text-slate-200">Database SQLite Terkoneksi</p>
                        <p class="text-slate-400 mt-0.5">Sistem memuat model data pengguna dan audit log.</p>
                        <p class="text-[10px] text-slate-500 mt-1">5 menit yang lalu</p>
                    </div>
                </div>

                <div class="flex gap-3 pt-3 border-t border-slate-900">
                    <span class="text-sm">🛡️</span>
                    <div class="text-xs">
                        <p class="font-bold text-slate-200">Pemberian Peran Terverifikasi</p>
                        <p class="text-slate-400 mt-0.5">Middleware memverifikasi filter otorisasi peran.</p>
                        <p class="text-[10px] text-slate-500 mt-1">10 menit yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
