@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header/Greeting -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Dashboard Utama</h1>
            <p class="text-sm text-slate-400 mt-1">Pantau status permohonan perizinan Anda di sini.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2 text-xs font-bold text-slate-200 ring-1 ring-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                Edit Profil
            </a>
            @if(!$user->isStaff())
                <a href="/perizinan" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2 text-xs font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-90 hover:scale-[1.02] transition-all duration-200">
                    + Ajukan Permohonan Baru
                </a>
            @endif
        </div>
    </div>

    <!-- Quick Role Warning / Actions Banner -->
    @if($user->isAdmin())
        <div class="mb-8 p-4 rounded-2xl border border-indigo-500/20 bg-indigo-500/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/20 text-indigo-400 font-extrabold">
                    <x-heroicon-o-key class="w-5 h-5 inline-block mr-1" />
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

    {{-- Notifikasi Penolakan untuk User --}}
    @if(!$user->isStaff() && isset($rejectedPermohonan) && $rejectedPermohonan->count() > 0)
        <div class="mb-8 space-y-3" id="rejection-notifications">
            @foreach($rejectedPermohonan as $rejected)
                <div class="flex items-start gap-4 p-4 rounded-2xl border border-rose-500/30 bg-rose-500/5 animate-pulse-once">
                    <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-rose-500/15 text-rose-400 text-base">🚫</span>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-bold text-rose-400">Permohonan Ditolak</h3>
                        <p class="text-xs text-slate-400 mt-0.5">
                            Permohonan <strong class="text-slate-200">
                                @if($rejected->jenis_layanan === 'ugb') UGB @elseif($rejected->jenis_layanan === 'pub') PUB @elseif($rejected->jenis_layanan === 'lks') LKS @else Adopsi Anak @endif
                            </strong> (ID #{{ $rejected->id }}) Anda telah ditolak oleh petugas. Silakan lihat detail untuk informasi lebih lanjut.
                        </p>
                    </div>
                    <a href="{{ route('perizinan.show', $rejected->id) }}" class="flex-shrink-0 inline-flex items-center justify-center rounded-xl bg-rose-600 px-4 py-2 text-xs font-bold text-white hover:bg-rose-500 transition">
                        Lihat Detail
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Widget 1: Total Permohonan / Antrean Aktif -->
        <div class="glass-panel rounded-2xl p-6 glow-emerald">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                    {{ $user->isStaff() ? 'Antrean Tugas Aktif' : 'Total Permohonan' }}
                </span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400 text-sm"><x-heroicon-o-document-text class="w-4 h-4 inline-block mr-1" /></span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['total_permohonan'] }}</h2>
            <p class="text-[11px] text-emerald-400 font-semibold mt-2 flex items-center gap-1">
                <span>{{ $stats['role_label'] }}</span>
            </p>
        </div>

        <!-- Widget 2: Belum Diulas / Sedang Diproses -->
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                    {{ $user->isStaff() ? 'Belum Diulas' : 'Sedang Diproses' }}
                </span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400 text-sm"><x-heroicon-o-clock class="w-5 h-5 inline-block mr-1" /></span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['diperiksa'] }}</h2>
            <p class="text-[11px] text-blue-400 font-semibold mt-2 flex items-center gap-1">
                @if($user->isStaff())
                    <span>Menunggu verifikasi Anda</span>
                @else
                    <span>{{ $stats['draft'] }} Draft</span> <span class="text-slate-500 font-normal">belum diajukan</span>
                @endif
            </p>
        </div>

        <!-- Widget 3: Disetujui / Diteruskan -->
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                    {{ $user->isStaff() ? 'Telah Diteruskan/Selesai' : 'Disetujui & Selesai' }}
                </span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-500/10 text-purple-400 text-sm"><x-heroicon-o-check-circle class="w-5 h-5 inline-block mr-1" /></span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['disetujui'] + $stats['selesai'] }}</h2>
            <p class="text-[11px] text-purple-400 font-semibold mt-2 flex items-center gap-1">
                @if($user->isStaff())
                    <span>Telah diproses/diteruskan</span>
                @else
                    <span>{{ $stats['disetujui'] }} Disetujui</span>
                @endif
            </p>
        </div>

        <!-- Widget 4: Ditolak / Kasus Ditolak -->
        @if(!$user->isStaff())
        <a href="/perizinan" class="block glass-panel rounded-2xl p-6 glow-rose border-rose-500/20 hover:border-rose-500/40 transition duration-200 group">
        @else
        <div class="glass-panel rounded-2xl p-6 glow-rose border-rose-500/20">
        @endif
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                    {{ $user->isStaff() ? 'Kasus Ditolak/Kembali' : 'Ditolak' }}
                </span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-500/10 text-rose-400 text-sm"><x-heroicon-o-x-circle class="w-4 h-4 inline-block mr-1" /></span>
            </div>
            <h2 class="text-2xl font-black text-white">{{ $stats['ditolak'] }}</h2>
            <p class="text-[11px] text-rose-400 font-semibold mt-2 flex items-center gap-1">
                @if($user->isStaff())
                    <span>Ditolak atau perlu perbaikan</span>
                @else
                    <span>Permohonan ditolak</span>
                @endif
            </p>
        @if(!$user->isStaff())
        </a>
        @else
        </div>
        @endif
    </div>

    <!-- Permohonan Section -->
    <div class="space-y-6">
        @if($user->isStaff())
            <div class="flex items-center justify-between border-b border-slate-900 pb-3">
                <h3 class="text-lg font-bold text-white">Antrean Tugas Anda</h3>
            </div>

            <div class="glass-panel rounded-2xl p-8 text-center">
                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-600 text-xl mx-auto mb-4 font-bold"><x-heroicon-o-key class="w-5 h-5 inline-block mr-1" /></span>
                <h4 class="text-base font-extrabold text-slate-200 mb-2">Buka Antrean Tugas Anda</h4>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">
                    Anda masuk sebagai petugas dengan peran <strong>{{ strtoupper($user->role) }}</strong>. Buka halaman antrean verifikasi untuk memproses seluruh pengajuan yang menunggu keputusan Anda.
                </p>
                @php
                    $dashboardRoute = 'admin.sekretariat';
                    if ($user->role === 'verifikator') { $dashboardRoute = 'admin.verifikator'; }
                    elseif ($user->role === 'dinsos_wilayah') { $dashboardRoute = 'admin.wilayah'; }
                    elseif ($user->role === 'bidang_pemberdayaan') { $dashboardRoute = 'admin.pemberdayaan'; }
                    elseif ($user->role === 'bidang_linjamsos') { $dashboardRoute = 'admin.linjamsos'; }
                    elseif ($user->role === 'kadinas') { $dashboardRoute = 'admin.kadinas'; }
                @endphp
                <a href="{{ route($dashboardRoute) }}" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 text-xs font-bold text-white shadow-md hover:bg-emerald-500 transition duration-200">
                    Buka Antrean Tugas &rarr;
                </a>
            </div>
        @else
            <div class="flex items-center justify-between border-b border-slate-900 pb-3">
                <h3 class="text-lg font-bold text-white">Permohonan Terbaru</h3>
                <a href="/perizinan" class="text-xs text-emerald-400 font-semibold hover:underline">Lihat Semua</a>
            </div>

            <!-- Permohonan Cards list - clickable -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @forelse($recentPermohonan as $permohonan)
                    <a href="{{ route('perizinan.show', $permohonan->id) }}" class="block glass-panel rounded-2xl p-6 hover:border-slate-600 hover:scale-[1.01] transition-all duration-200 cursor-pointer group">
                        <div class="flex flex-col gap-3">
                            <div class="flex items-start justify-between gap-2">
                                <span class="inline-flex items-center rounded-full bg-slate-900 px-2.5 py-0.5 text-[10px] font-bold text-slate-400 ring-1 ring-inset ring-slate-800">
                                    {{ $permohonan->created_at->format('d M Y') }}
                                </span>
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold {{ $permohonan->status === 'ditolak' ? 'bg-rose-500/10 text-rose-400 ring-1 ring-rose-500/20' : ($permohonan->status === 'diperiksa' ? 'bg-blue-500/10 text-blue-400 ring-1 ring-blue-500/20' : ($permohonan->status === 'draft' ? 'bg-slate-500/10 text-slate-400 ring-1 ring-slate-500/20' : 'bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/20')) }}">
                                    {{ strtoupper($permohonan->status) }}
                                </span>
                            </div>
                            <div>
                                <h4 class="text-sm font-extrabold text-white group-hover:text-emerald-400 transition-colors">
                                    @if($permohonan->jenis_layanan === 'ugb') Undian Gratis Berhadiah (UGB)
                                    @elseif($permohonan->jenis_layanan === 'pub') Pengumpulan Uang/Barang (PUB)
                                    @elseif($permohonan->jenis_layanan === 'lks') Izin Operasional LKS
                                    @elseif($permohonan->jenis_layanan === 'adopsi') Rekomendasi Adopsi Anak
                                    @else {{ strtoupper($permohonan->jenis_layanan) }}
                                    @endif
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">ID: #{{ $permohonan->id }}</p>
                            </div>
                            @if($permohonan->status === 'ditolak')
                                <div class="p-2.5 rounded-xl bg-rose-500/5 border border-rose-500/20">
                                    <p class="text-[11px] text-rose-400 font-semibold"><x-heroicon-o-exclamation-triangle class="w-5 h-5 inline-block mr-1" /> Permohonan Anda ditolak. Klik untuk melihat detail.</p>
                                </div>
                            @endif
                            <div class="flex items-center gap-1 text-[11px] text-slate-500 group-hover:text-emerald-400 transition-colors mt-1">
                                <span>Lihat Detail</span>
                                <span>&rarr;</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 glass-panel rounded-2xl p-10 text-center">
                        <p class="text-sm text-slate-400">Belum ada permohonan yang diajukan.</p>
                        <a href="/perizinan" class="inline-block mt-4 text-xs font-bold text-emerald-400 hover:underline">Ajukan Permohonan Sekarang</a>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
</div>
@endsection
