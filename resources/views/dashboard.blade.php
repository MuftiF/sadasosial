@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header/Greeting -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Dashboard Utama</h1>
            <p class="text-sm text-slate-400 mt-1">Pantau status permohonan perizinan dan profil Anda di sini.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2 text-xs font-bold text-slate-200 ring-1 ring-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                Edit Profil
            </a>
            <a href="/perizinan" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2 text-xs font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-90 hover:scale-[1.02] transition-all duration-200">
                + Ajukan Permohonan Baru
            </a>
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
        <!-- Widget 1: Total Permohonan -->
        <div class="glass-panel rounded-2xl p-6 glow-emerald">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Permohonan</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400 text-sm">📄</span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['total_permohonan'] }}</h2>
            <p class="text-[11px] text-emerald-400 font-semibold mt-2 flex items-center gap-1">
                <span>Semua layanan</span>
            </p>
        </div>

        <!-- Widget 2: Draft & Diperiksa -->
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Sedang Diproses</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400 text-sm">⏳</span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['diperiksa'] }}</h2>
            <p class="text-[11px] text-blue-400 font-semibold mt-2 flex items-center gap-1">
                <span>{{ $stats['draft'] }} Draft</span> <span class="text-slate-500 font-normal">belum diajukan</span>
            </p>
        </div>

        <!-- Widget 3: Disetujui / Selesai -->
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Disetujui & Selesai</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-500/10 text-purple-400 text-sm">✅</span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['disetujui'] + $stats['selesai'] }}</h2>
            <p class="text-[11px] text-purple-400 font-semibold mt-2 flex items-center gap-1">
                <span>{{ $stats['disetujui'] }} Disetujui</span>
            </p>
        </div>

        <!-- Widget 4: Ditolak -->
        <div class="glass-panel rounded-2xl p-6 glow-rose border-rose-500/20">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Ditolak</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-500/10 text-rose-400 text-sm">❌</span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['ditolak'] }}</h2>
            <p class="text-[11px] text-rose-400 font-semibold mt-2 flex items-center gap-1">
                <span>Perlu perbaikan</span>
            </p>
        </div>
    </div>

    <!-- Campaigns Section & Side Details -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Panel: Permohonan -->
        <div class="lg:col-span-8 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-900 pb-3">
                <h3 class="text-lg font-bold text-white">Permohonan Terbaru</h3>
                <a href="/perizinan" class="text-xs text-emerald-400 font-semibold hover:underline">Lihat Semua</a>
            </div>

            <!-- Permohonan Cards list -->
            <div class="grid grid-cols-1 gap-6">
                @forelse($recentPermohonan as $permohonan)
                    <div class="glass-panel rounded-2xl p-6 hover:border-slate-700 transition duration-200">
                        <div class="flex flex-col sm:flex-row justify-between sm:items-start gap-4 mb-4">
                            <div>
                                <span class="inline-flex items-center rounded-full bg-slate-900 px-2.5 py-0.5 text-[10px] font-bold text-slate-400 ring-1 ring-inset ring-slate-800">
                                    {{ $permohonan->created_at->format('d M Y') }}
                                </span>
                                <h4 class="text-base font-extrabold text-white mt-1.5">{{ $permohonan->jenis_layanan }}</h4>
                            </div>
                            <div>
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold {{ $permohonan->status === 'ditolak' ? 'bg-rose-500/10 text-rose-400 ring-1 ring-rose-500/20' : (in_array($permohonan->status, ['disetujui', 'selesai']) ? 'bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/20' : 'bg-blue-500/10 text-blue-400 ring-1 ring-blue-500/20') }}">
                                    {{ strtoupper($permohonan->status) }}
                                </span>
                            </div>
                        </div>

                        @if($permohonan->catatan)
                            <div class="mt-4 p-3 rounded-xl bg-slate-900 border border-slate-800">
                                <p class="text-xs text-slate-400"><strong class="text-slate-300">Catatan:</strong> {{ $permohonan->catatan }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="glass-panel rounded-2xl p-10 text-center">
                        <p class="text-sm text-slate-400">Belum ada permohonan yang diajukan.</p>
                        <a href="/perizinan" class="inline-block mt-4 text-xs font-bold text-emerald-400 hover:underline">Ajukan Permohonan Sekarang</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Side Panel: Profil Singkat -->
        <div class="lg:col-span-4 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-900 pb-3">
                <h3 class="text-lg font-bold text-white">Profil Anda</h3>
            </div>

            <div class="glass-panel rounded-2xl p-5 space-y-4">
                <div class="flex items-center gap-4 border-b border-slate-900 pb-4">
                    <div class="h-12 w-12 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xl uppercase ring-1 ring-emerald-500/30">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-200">{{ $user->name }}</h4>
                        <p class="text-[10px] text-slate-500 uppercase">{{ $user->role }} - {{ $user->account_type }}</p>
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <div>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wide">Email</p>
                        <p class="text-xs font-medium text-slate-300">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wide">Kontak</p>
                        <p class="text-xs font-medium text-slate-300">{{ $user->kontak ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wide">Alamat</p>
                        <p class="text-xs font-medium text-slate-300 leading-relaxed">{{ $user->alamat ?? '-' }}</p>
                    </div>
                </div>

                <div class="pt-4 mt-2 border-t border-slate-900">
                    <a href="{{ route('profile.edit') }}" class="block w-full text-center rounded-xl bg-slate-900 px-4 py-2 text-xs font-bold text-slate-300 ring-1 ring-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                        Perbarui Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
