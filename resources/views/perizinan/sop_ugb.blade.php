@extends('layouts.app')

@section('title', 'SOP Pelaksanaan & Pengawasan UGB')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <a href="{{ route('perizinan.create') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-3">
                &larr; Kembali ke Pilihan Layanan
            </a>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Penyelenggaraan UGB</h1>
            <p class="text-sm text-slate-500 mt-1">Panduan alur resmi pelaksanaan undian gratis berhadiah dan patroli pengawasan dinas sosial.</p>
        </div>
        
        <!-- Tab Selectors -->
        <div class="flex p-1 bg-slate-200/80 rounded-2xl border border-slate-300/40">
            <button onclick="switchTab('pelaksanaan')" id="tab-pelaksanaan" 
                class="px-5 py-2 text-xs font-bold rounded-xl transition duration-200 shadow-sm bg-white text-slate-900">
                <x-heroicon-o-inbox-stack class="w-5 h-5 inline-block mr-1" /> SOP Pelaksanaan Pengundian
            </button>
            <button onclick="switchTab('pengawasan')" id="tab-pengawasan" 
                class="px-5 py-2 text-xs font-bold rounded-xl transition duration-200 text-slate-500 hover:text-slate-900">
                <x-heroicon-o-magnifying-glass class="w-5 h-5 inline-block mr-1" /> SOP Patroli Pengawasan
            </button>
        </div>
    </div>

    <!-- TAB 1: SOP Pelaksanaan Pengundian -->
    <div id="content-pelaksanaan" class="space-y-8">
        <!-- Summary Alert -->
        <div class="p-5 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-start gap-4">
            <span class="text-2xl">💡</span>
            <div>
                <h3 class="text-sm font-bold text-emerald-850">SOP Pelaksanaan Pengundian UGB</h3>
                <p class="text-xs text-emerald-700 mt-1 leading-relaxed">
                    Alur ini mengatur tata cara penyelenggaraan undian dari tahap pemenuhan perizinan, koordinasi dengan notaris/saksi/polisi, pengecekan kelaikan alat pengundian, penyegelan resmi, hingga pengumuman pemenang.
                </p>
            </div>
        </div>

        <!-- Interactive Flow Steps -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Timeline Left -->
            <div class="lg:col-span-8 space-y-6">
                <div class="relative pl-8 border-l-2 border-dashed border-slate-300 space-y-8">
                    
                    <!-- Step 1 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            1
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Menyelesaikan Kelengkapan Izin UGB</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-emerald-100 text-emerald-800 rounded-full">Penyelenggara Undian</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Penyelenggara menyelesaikan administrasi permohonan hingga terbit izin promosi resmi dan Surat Keputusan (SK) dari Menteri Sosial RI.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Izin Promosi & SK Mensos</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">60 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-emerald-600 font-bold">Pelaksanaan Resmi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            2
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Koordinasi Dengan Pihak Terkait & Para Saksi</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-emerald-100 text-emerald-800 rounded-full">Penyelenggara Undian</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Mengirimkan surat undangan resmi koordinasi pelaksanaan penarikan undian kepada para saksi resmi dari Dinas Sosial, Notaris, Kepolisian, dan pejabat wilayah setempat.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Dokumen Undangan Saksi</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">120 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-slate-700 font-semibold">Disposisi Pimpinan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            3
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Menunjuk Petugas Penyegelan, Saksi, & Pengawasan</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-purple-100 text-purple-800 rounded-full">Kabid Pemberdayaan Sosial</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Kepala Bidang memproses disposisi koordinasi dan menerbitkan draft konsep surat tugas untuk menunjuk petugas dari Dinsos sebagai saksi/pengawas.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Lembar Disposisi</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">15 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-slate-700 font-semibold">Konsep Surat Tugas</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            4
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Menyetujui & Menandatangani Surat Tugas Saksi</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-purple-100 text-purple-800 rounded-full">Kabid Pemberdayaan Sosial</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Kepala Bidang memeriksa dan menandatangani surat tugas pengawasan undian secara sah.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Konsep Surat Tugas</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">15 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-emerald-600 font-bold">Surat Tugas Resmi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            5
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm border-l-4 border-amber-500">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <div class="flex items-center gap-1.5">
                                    <h3 class="text-sm font-bold text-slate-900">Mengecek Alat & Sarana Prasarana Undian</h3>
                                    <span class="text-xs text-amber-600 font-bold"><x-heroicon-o-exclamation-triangle class="w-5 h-5 inline-block mr-1" /> Titik Keputusan</span>
                                </div>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-blue-100 text-blue-800 rounded-full">Petugas Saksi & Pengawas</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Petugas bersama para saksi melakukan pemeriksaan fisik kelaikan alat undian (seperti roda undian, laptop pengundian, kotak undian) di lokasi kegiatan.</p>
                            
                            <!-- Decision simulation box -->
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 mb-4 text-[11px] space-y-2">
                                <p class="font-bold text-slate-700">Pemeriksaan Kelayakan:</p>
                                <div class="flex gap-4">
                                    <div class="flex items-start gap-1">
                                        <span class="text-red-500 font-bold">✖ Tidak Layak:</span>
                                        <span class="text-slate-600">Alur diarahkan ke perbaikan alat (Langkah 7).</span>
                                    </div>
                                    <div class="flex items-start gap-1">
                                        <span class="text-emerald-600 font-bold">✔ Layak:</span>
                                        <span class="text-slate-600">Lanjut ke uji coba sistem (Langkah 6).</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Alat & Sarana Undian</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">15 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-slate-700 font-semibold">Alat Layak Digunakan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            6
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm border-l-4 border-amber-500">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <div class="flex items-center gap-1.5">
                                    <h3 class="text-sm font-bold text-slate-900">Melakukan Uji Coba Alat Pengundian</h3>
                                    <span class="text-xs text-amber-600 font-bold"><x-heroicon-o-exclamation-triangle class="w-5 h-5 inline-block mr-1" /> Titik Keputusan</span>
                                </div>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-blue-100 text-blue-800 rounded-full">Petugas Saksi & Pengawas</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Melakukan simulasi penarikan undian dihadapan para saksi untuk menjamin transparansi dan mendeteksi kesalahan teknis perangkat/sistem.</p>
                            
                            <!-- Decision simulation box -->
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 mb-4 text-[11px] space-y-2">
                                <p class="font-bold text-slate-700">Hasil Uji Coba:</p>
                                <div class="flex gap-4">
                                    <div class="flex items-start gap-1">
                                        <span class="text-red-500 font-bold">✖ Ada Masalah:</span>
                                        <span class="text-slate-600">Alur diarahkan ke perbaikan alat (Langkah 7).</span>
                                    </div>
                                    <div class="flex items-start gap-1">
                                        <span class="text-emerald-600 font-bold">✔ Sukses & Adil:</span>
                                        <span class="text-slate-600">Lanjut ke proses penyegelan (Langkah 8).</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Alat & Sarana Undian</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">15 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-slate-700 font-semibold">Alat Lulus Uji Coba</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 7 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            7
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm border-l-4 border-rose-500">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Memperbaiki Kekurangan Alat (Jika Terjadi Temuan)</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-emerald-100 text-emerald-800 rounded-full">Penyelenggara Undian</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Jika alat dinyatakan tidak layak atau uji coba gagal, Penyelenggara wajib memperbaiki kekurangan teknis saat itu juga, lalu diperiksa ulang oleh petugas.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Alat / Sarana Undian</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">120 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-emerald-600 font-bold">Koreksi & Loop Balik</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 8 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            8
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Melakukan Penyegelan Alat Undian</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-blue-100 text-blue-800 rounded-full">Petugas Saksi & Pengawas</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Menyegel alat undian dengan menempelkan Stiker Segel resmi untuk menjamin alat tidak dimanipulasi sebelum acara penarikan undian resmi dimulai.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Stiker Segel & Alat Undian</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">15 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-emerald-600 font-bold">Alat Disegel</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 9 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            9
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Membacakan Tata Tertib Pelaksanaan Undian</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-blue-100 text-blue-800 rounded-full">Petugas Saksi & Pengawas</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Sebelum segel dibuka di depan publik, petugas saksi membacakan dokumen tata tertib pelaksanaan undian sesuai peraturan perundang-undangan.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Naskah Tata Tertib</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">15 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-slate-700 font-semibold">Legalitas Tata Tertib</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 10 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            10
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm border-l-4 border-emerald-500">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Pelepasan Segel & Penarikan Pemenang</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-emerald-100 text-emerald-800 rounded-full">Penyelenggara & Saksi</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Petugas membuka stiker segel, lalu Penyelenggara memulai penarikan undian untuk mendapatkan daftar pemenang sah disaksikan notaris dan polisi.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Alat Undian & Saksi Lengkap</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">120 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-emerald-600 font-bold">Daftar Pemenang Undian</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Informational Sidebar Right -->
            <div class="lg:col-span-4 space-y-6">
                <div class="glass-panel rounded-3xl p-6">
                    <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-200 pb-3 mb-4"><x-heroicon-o-key class="w-5 h-5 inline-block mr-1" /> Ringkasan Mutu Baku</h3>
                    <div class="space-y-4 text-xs">
                        <div class="flex justify-between items-center border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Total Waktu Prosedur</span>
                            <span class="font-bold text-slate-800">410 Menit (~6.8 Jam)</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Jumlah Aktor Terlibat</span>
                            <span class="font-bold text-slate-800">3 Pihak + Saksi Hukum</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500">Output Utama Pelaksanaan</span>
                            <span class="font-bold text-emerald-600">Daftar Pemenang Undian</span>
                        </div>
                    </div>
                </div>

                <div class="glass-panel rounded-3xl p-6 bg-slate-50 border-slate-200">
                    <h3 class="font-extrabold text-slate-900 text-sm mb-2">📌 Catatan Penting Saksi</h3>
                    <p class="text-[11px] text-slate-500 leading-relaxed">
                        Sesuai peraturan Kemensos RI, penarikan undian gratis berhadiah (UGB) dianggap <strong>TIDAK SAH</strong> jika tidak disaksikan minimal oleh:
                    </p>
                    <ul class="text-[11px] text-slate-600 space-y-1.5 mt-3">
                        <li class="flex items-center gap-1.5">⚖️ Notaris Terunjuk</li>
                        <li class="flex items-center gap-1.5">👮 Pihak Kepolisian RI</li>
                        <li class="flex items-center gap-1.5">🏢 Petugas Dinas Sosial (Provinsi/Wilayah)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: SOP Patroli Pengawasan -->
    <div id="content-pengawasan" class="space-y-8 hidden">
        <!-- Summary Alert -->
        <div class="p-5 rounded-2xl bg-indigo-50 border border-indigo-200 flex items-start gap-4">
            <span class="text-2xl">💡</span>
            <div>
                <h3 class="text-sm font-bold text-indigo-850">SOP Patroli &amp; Pengawasan UGB</h3>
                <p class="text-xs text-indigo-700 mt-1 leading-relaxed">
                    Alur ini mengatur langkah penertiban, patroli lapangan, hingga pembinaan atas pelanggaran reklame/iklan UGB tidak berizin atau keterlambatan penyerahan laporan pelaksanaan oleh penyelenggara undian.
                </p>
            </div>
        </div>

        <!-- Interactive Flow Steps -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Timeline Left -->
            <div class="lg:col-span-8 space-y-6">
                <div class="relative pl-8 border-l-2 border-dashed border-indigo-300 space-y-8">
                    
                    <!-- Step 1 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            1
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Temuan Pelanggaran / Keterlambatan Laporan</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-blue-100 text-blue-800 rounded-full">Ketua Tim Pelaksana / PPNS</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Petugas menemukan iklan/promosi undian berhadiah tidak berizin di lapangan atau mendeteksi daftar penyelenggara yang terlambat menyerahkan laporan pelaksanaan melebihi batas waktu.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Foto Iklan / Daftar Terlambat</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">60 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-slate-700 font-semibold">Bahan Laporan Pimpinan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            2
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Membuat Rencana Patroli & Pembagian Tugas</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-blue-100 text-blue-800 rounded-full">Ketua Tim Pelaksana / PPNS</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Menyusun jadwal, peta sasaran lokasi patroli penertiban, serta menyusun draft konsep surat tugas untuk tim pengawas.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Dokumen Perencanaan</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">60 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-slate-700 font-semibold">Konsep Surat Tugas</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            3
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Menyetujui & Menerbitkan Surat Tugas Patroli</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-purple-100 text-purple-800 rounded-full">Kabid Pemberdayaan Sosial</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Kepala Bidang menandatangani Surat Tugas sebagai izin resmi operasional patroli pengawasan.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Surat Tugas</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">15 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-emerald-600 font-bold">Izin Bertugas (Surat Tugas)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            4
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Berkoordinasi Dengan Pihak Wilayah Terkait</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-blue-100 text-blue-800 rounded-full">Pekerja Sosial Ahli Muda</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Menghubungi Dinsos Kabupaten/Kota setempat dan Penyelenggara undian yang bersangkutan untuk penertiban di lokasi promosi.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Surat Tugas & HP</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">60 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-slate-700 font-semibold">Bahan Koordinasi Wilayah</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            5
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm border-l-4 border-amber-500">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Melaksanakan Patroli Lapangan &amp; Pembinaan</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-blue-100 text-blue-800 rounded-full">Pekerja Sosial &amp; PPNS</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Tim turun ke lapangan melakukan inspeksi iklan, mengisi instrumen patroli, serta melakukan tindakan pembinaan kepada Penyelenggara undian yang kedapatan tidak tertib.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Instrumen Patroli &amp; Kamera</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">120 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-emerald-600 font-bold">Instrumen Patroli Terisi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="relative group transition-all duration-200 hover:-translate-y-0.5">
                        <div class="absolute -left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white font-extrabold text-xs border-4 border-slate-100 ring-2 ring-slate-900/10">
                            6
                        </div>
                        <div class="glass-panel rounded-2xl p-6 shadow-sm border-l-4 border-emerald-500">
                            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                <h3 class="text-sm font-bold text-slate-900">Memperbaiki Kekurangan &amp; Melaporkan Kegiatan</h3>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold bg-emerald-100 text-emerald-800 rounded-full">Penyelenggara Undian</span>
                            </div>
                            <p class="text-xs text-slate-505 leading-relaxed mb-4">Penyelenggara memperbaiki seluruh temuan pelanggaran iklan atau laporan yang terlambat, lalu menyerahkan laporan resmi kegiatan ke Dinsos Provinsi dan Kementerian Sosial.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-slate-100 pt-3 text-[11px]">
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Persyaratan</span>
                                    <span class="text-slate-700 font-medium">Berkas Dokumen Laporan</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Waktu</span>
                                    <span class="text-slate-700 font-medium">60 Menit</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 font-bold block uppercase text-[9px]">Output</span>
                                    <span class="text-emerald-600 font-bold">Laporan Disampaikan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Informational Sidebar Right -->
            <div class="lg:col-span-4 space-y-6">
                <div class="glass-panel rounded-3xl p-6">
                    <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-200 pb-3 mb-4"><x-heroicon-o-key class="w-5 h-5 inline-block mr-1" /> Ringkasan Patroli</h3>
                    <div class="space-y-4 text-xs">
                        <div class="flex justify-between items-center border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Total Waktu Prosedur</span>
                            <span class="font-bold text-slate-800">380 Menit (~6.3 Jam)</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-slate-100 pb-2">
                            <span class="text-slate-500">Jumlah Aktor Terlibat</span>
                            <span class="font-bold text-slate-800">3 Peran Dinas + Pemohon</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500">Output Utama Pelaporan</span>
                            <span class="font-bold text-emerald-600">Laporan Diterima Dinsos &amp; Kemensos</span>
                        </div>
                    </div>
                </div>

                <div class="glass-panel rounded-3xl p-6 bg-slate-50 border-slate-200">
                    <h3 class="font-extrabold text-slate-900 text-sm mb-2">📢 Konsekuensi Hukum</h3>
                    <p class="text-[11px] text-slate-500 leading-relaxed">
                        Penyelenggara yang menyelenggarakan undian gratis berhadiah (UGB) tanpa izin resmi atau terlambat memberikan laporan pelaksanaan dapat dikenakan sanksi berupa:
                    </p>
                    <ul class="text-[11px] text-slate-600 space-y-1.5 mt-3">
                        <li class="flex items-center gap-1.5">🛑 Pembekuan izin promosi</li>
                        <li class="flex items-center gap-1.5"><x-heroicon-o-exclamation-triangle class="w-5 h-5 inline-block mr-1" /> Teguran tertulis &amp; denda administratif</li>
                        <li class="flex items-center gap-1.5">🚫 Blacklist pendaftaran UGB selanjutnya</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tab) {
        const tabPelaksanaan = document.getElementById('tab-pelaksanaan');
        const tabPengawasan = document.getElementById('tab-pengawasan');
        const contentPelaksanaan = document.getElementById('content-pelaksanaan');
        const contentPengawasan = document.getElementById('content-pengawasan');

        if (tab === 'pelaksanaan') {
            tabPelaksanaan.className = 'px-5 py-2 text-xs font-bold rounded-xl transition duration-200 shadow-sm bg-white text-slate-900';
            tabPengawasan.className = 'px-5 py-2 text-xs font-bold rounded-xl transition duration-200 text-slate-500 hover:text-slate-900';
            contentPelaksanaan.classList.remove('hidden');
            contentPengawasan.classList.add('hidden');
        } else {
            tabPengawasan.className = 'px-5 py-2 text-xs font-bold rounded-xl transition duration-200 shadow-sm bg-white text-slate-900';
            tabPelaksanaan.className = 'px-5 py-2 text-xs font-bold rounded-xl transition duration-200 text-slate-500 hover:text-slate-900';
            contentPengawasan.classList.remove('hidden');
            contentPelaksanaan.classList.add('hidden');
        }
    }
</script>
@endsection
