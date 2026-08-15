@extends('layouts.app')

@section('title', 'Pemberdayaan Sosial - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!-- Header Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-700 p-8 sm:p-10 shadow-xl mb-10 text-white">
        <div class="relative z-10 max-w-3xl">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-wider backdrop-blur-md mb-3 text-emerald-100">
                Bidang Pemberdayaan Sosial
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Proses Bisnis 2: Pemberdayaan Sosial</h1>
            <p class="mt-3 text-base sm:text-lg text-emerald-50 leading-relaxed">
                Layanan terpadu pembinaan kelembagaan, penguatan pilar-pilar sosial, fasilitasi kelompok rentan, kegiatan kesetiakawanan, pengelolaan kepahlawanan/TMP, serta monitoring & evaluasi terintegrasi.
            </p>
        </div>
        <!-- Decorative SVG background pattern -->
        <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
            <svg width="400" height="400" fill="currentColor" viewBox="0 0 100 100">
                <path d="M50 0 L100 50 L50 100 L0 50 Z"/>
            </svg>
        </div>
    </div>

    <!-- 6 Sub-processes Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- 2.1 Pembinaan Kelembagaan Sosial -->
        <div class="glass-panel rounded-2xl p-6 flex flex-col justify-between hover:shadow-lg transition duration-200 border border-slate-200">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xl">
                        2.1
                    </div>
                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                        {{ $stats['kelembagaan'] }} Data
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Pembinaan Kelembagaan & Orsos</h3>
                <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                    Pengajuan data LKS/Orsos, penyusunan agenda pembinaan, pelaksanaan, pencatatan hasil, dan pengesahan tindak lanjut.
                </p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('pemberdayaan.kelembagaan.create') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                    + Ajukan Pembinaan
                </a>
                <a href="{{ route('pemberdayaan.kelembagaan.index') }}" class="inline-flex items-center text-xs font-bold text-emerald-600 hover:text-emerald-800">
                    Lihat Daftar &rarr;
                </a>
            </div>
        </div>

        <!-- 2.2 Pembinaan Pilar-Pilar Sosial -->
        <div class="glass-panel rounded-2xl p-6 flex flex-col justify-between hover:shadow-lg transition duration-200 border border-slate-200">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-xl">
                        2.2
                    </div>
                    <span class="inline-flex items-center rounded-full bg-teal-50 px-2.5 py-1 text-xs font-semibold text-teal-700">
                        {{ $stats['pilar'] }} Data
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Pembinaan Pilar-Pilar Sosial</h3>
                <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                    Penguatan kapasitas PSM, TKSK, Karang Taruna, dan Relawan Sosial melalui Bimbingan Teknis dan evaluasi berkala.
                </p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('pemberdayaan.pilar.create') }}" class="text-xs font-semibold text-teal-600 hover:text-teal-700">
                    + Ajukan Usulan Pilar
                </a>
                <a href="{{ route('pemberdayaan.pilar.index') }}" class="inline-flex items-center text-xs font-bold text-teal-600 hover:text-teal-800">
                    Lihat Daftar &rarr;
                </a>
            </div>
        </div>

        <!-- 2.3 Fasilitasi Komunitas / Kelompok Rentan -->
        <div class="glass-panel rounded-2xl p-6 flex flex-col justify-between hover:shadow-lg transition duration-200 border border-slate-200">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center font-bold text-xl">
                        2.3
                    </div>
                    <span class="inline-flex items-center rounded-full bg-cyan-50 px-2.5 py-1 text-xs font-semibold text-cyan-700">
                        {{ $stats['komunitas'] }} Data
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Fasilitasi Kelompok Rentan</h3>
                <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                    Pendampingan dan fasilitasi pemberdayaan komunitas rentan bekerja sama dengan Dinas Sosial Kab/Kota.
                </p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('pemberdayaan.komunitas.create') }}" class="text-xs font-semibold text-cyan-600 hover:text-cyan-700">
                    + Usulan Fasilitasi
                </a>
                <a href="{{ route('pemberdayaan.komunitas.index') }}" class="inline-flex items-center text-xs font-bold text-cyan-600 hover:text-cyan-800">
                    Lihat Daftar &rarr;
                </a>
            </div>
        </div>

        <!-- 2.4 Kegiatan Kesetiakawanan & Penyuluhan -->
        <div class="glass-panel rounded-2xl p-6 flex flex-col justify-between hover:shadow-lg transition duration-200 border border-slate-200">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xl">
                        2.4
                    </div>
                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700">
                        {{ $stats['kesetiakawanan'] }} Kegiatan
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Kesetiakawanan & Penyuluhan</h3>
                <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                    Pengelolaan agenda Kesetiakawanan Sosial, Restorasi Sosial, dan kegiatan Penyuluhan Sosial kepada masyarakat.
                </p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                @if(Auth::user()->isStaff())
                    <a href="{{ route('pemberdayaan.kesetiakawanan.create') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">
                        + Buat Rencana Kegiatan
                    </a>
                @else
                    <span class="text-xs text-slate-400">Pendaftaran Peserta</span>
                @endif
                <a href="{{ route('pemberdayaan.kesetiakawanan.index') }}" class="inline-flex items-center text-xs font-bold text-indigo-600 hover:text-indigo-800">
                    Agenda Kegiatan &rarr;
                </a>
            </div>
        </div>

        <!-- 2.5 Pengelolaan Kepahlawanan & TMP -->
        <div class="glass-panel rounded-2xl p-6 flex flex-col justify-between hover:shadow-lg transition duration-200 border border-slate-200">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-xl">
                        2.5
                    </div>
                    <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                        {{ $stats['kepahlawanan'] }} Agenda
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Kepahlawanan & TMP</h3>
                <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                    Agenda nilai kepahlawanan, peringatan hari pahlawan, usulan pahlawan, serta pemeliharaan Taman Makam Pahlawan.
                </p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('pemberdayaan.kepahlawanan.create') }}" class="text-xs font-semibold text-amber-600 hover:text-amber-700">
                    + Ajukan Usulan
                </a>
                <a href="{{ route('pemberdayaan.kepahlawanan.index') }}" class="inline-flex items-center text-xs font-bold text-amber-600 hover:text-amber-800">
                    Lihat Daftar &rarr;
                </a>
            </div>
        </div>

        <!-- 2.6 Monitoring dan Evaluasi (Monev) -->
        <div class="glass-panel rounded-2xl p-6 flex flex-col justify-between hover:shadow-lg transition duration-200 border border-slate-200">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="h-12 w-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-xl">
                        2.6
                    </div>
                    <span class="inline-flex items-center rounded-full bg-purple-50 px-2.5 py-1 text-xs font-semibold text-purple-700">
                        {{ $stats['monev'] }} Laporan
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Monitoring & Evaluasi (Monev)</h3>
                <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                    Pengolahan data capaian, pencatatan kendala, dan rekomendasi perbaikan seluruh program pemberdayaan sosial.
                </p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                @if(Auth::user()->isStaff())
                    <a href="{{ route('pemberdayaan.monev.create') }}" class="text-xs font-semibold text-purple-600 hover:text-purple-700">
                        + Buat Laporan Monev
                    </a>
                @else
                    <span class="text-xs text-slate-400">Ringkasan Statistik</span>
                @endif
                <a href="{{ route('pemberdayaan.monev.index') }}" class="inline-flex items-center text-xs font-bold text-purple-600 hover:text-purple-800">
                    Monev Analytics &rarr;
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
