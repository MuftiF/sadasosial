@extends('layouts.app')

@section('title', 'SOP Penyaluran Bantuan Alat Bantu Penyandang Disabilitas')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('rehabilitasi.subproses.index', 'disabilitas') }}" class="text-xs font-bold text-indigo-600 hover:underline flex items-center gap-1.5 mb-3">
            &larr; Kembali ke Layanan Disabilitas
        </a>
        <span class="inline-flex items-center rounded-md bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-800 ring-1 ring-inset ring-indigo-600/20 mb-2">
            SOP Resmi Subproses 3.3 - Bidang Rehabilitasi Sosial
        </span>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">SOP PENYALURAN BANTUAN ALAT BANTU PENYANDANG DISABILITAS (KAB/KOTA SE-SUMATERA UTARA)</h1>
        <p class="text-sm text-slate-500 mt-2">Standar Operasional Prosedur pendataan, verifikasi permohonan, peninjauan lapangan, pengadaan e-Katalog, penerbitan SK Gubernur, penyaluran alat bantu disabilitas, hingga pelaporan pertanggungjawaban &amp; pengarsipan (Total SLA: 20 Hari Kerja).</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Total Tahapan Alur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">9 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-indigo-600 mt-1 block">5 Aktor Utama</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Total Mutu Baku (SLA)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">20 Hari Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Jenis Alat Bantu</span>
            <span class="text-2xl font-black text-purple-600 mt-1 block">7 Varian Alat</span>
        </div>
    </div>

    <!-- Section: Jenis Alat Bantu Disabilitas -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-600 text-white text-sm">♿</span>
            Jenis Bantuan Alat Bantu Disabilitas yang Diberikan
        </h2>
        <p class="text-xs text-slate-500 mb-6">Bantuan alat bantu disabilitas disalurkan sesuai hasil peninjauan lapangan dan rekomendasi asesmen kebutuhan spesifik penerima manfaat.</p>
        
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3">
            <div class="bg-indigo-50/70 border border-indigo-200/60 p-3.5 rounded-2xl text-center hover:shadow-sm transition">
                <span class="text-2xl block mb-1">🦽</span>
                <span class="text-xs font-bold text-indigo-950 block">Kursi Roda</span>
                <span class="text-[10px] text-indigo-700">Mobilitas Fisik</span>
            </div>
            <div class="bg-indigo-50/70 border border-indigo-200/60 p-3.5 rounded-2xl text-center hover:shadow-sm transition">
                <span class="text-2xl block mb-1">🦻</span>
                <span class="text-xs font-bold text-indigo-950 block">Hearing Aid</span>
                <span class="text-[10px] text-indigo-700">Alat Bantu Dengar</span>
            </div>
            <div class="bg-indigo-50/70 border border-indigo-200/60 p-3.5 rounded-2xl text-center hover:shadow-sm transition">
                <span class="text-2xl block mb-1">🦯</span>
                <span class="text-xs font-bold text-indigo-950 block">Tongkat Kaki 3</span>
                <span class="text-[10px] text-indigo-700">Penopang Berdiri</span>
            </div>
            <div class="bg-indigo-50/70 border border-indigo-200/60 p-3.5 rounded-2xl text-center hover:shadow-sm transition">
                <span class="text-2xl block mb-1">🦯</span>
                <span class="text-xs font-bold text-indigo-950 block">Tongkat Kaki 4</span>
                <span class="text-[10px] text-indigo-700">Keseimbangan Ekstra</span>
            </div>
            <div class="bg-indigo-50/70 border border-indigo-200/60 p-3.5 rounded-2xl text-center hover:shadow-sm transition">
                <span class="text-2xl block mb-1">⌨️</span>
                <span class="text-xs font-bold text-indigo-950 block">Brailler</span>
                <span class="text-[10px] text-indigo-700">Mesin Ketik Braille</span>
            </div>
            <div class="bg-indigo-50/70 border border-indigo-200/60 p-3.5 rounded-2xl text-center hover:shadow-sm transition">
                <span class="text-2xl block mb-1">🚶</span>
                <span class="text-xs font-bold text-indigo-950 block">Walker</span>
                <span class="text-[10px] text-indigo-700">Alat Bantu Jalan</span>
            </div>
            <div class="bg-indigo-50/70 border border-indigo-200/60 p-3.5 rounded-2xl text-center hover:shadow-sm transition">
                <span class="text-2xl block mb-1">🩼</span>
                <span class="text-xs font-bold text-indigo-950 block">Tongkat Siku</span>
                <span class="text-[10px] text-indigo-700">Penopang Lengan</span>
            </div>
        </div>
    </div>

    <!-- Section 1: Visual Timeline (9 Steps Flowchart & Pelaksana Details) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-600 text-white text-sm">📊</span>
            Visual Diagram Alur &amp; Hubungan Pelaksana (9 Langkah Kerja)
        </h2>

        <div class="relative border-l-2 border-indigo-200 ml-4 sm:ml-6 space-y-8 pl-6 sm:pl-8 py-2">
            <!-- Step 1 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-xs ring-4 ring-white">
                    1
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-indigo-800 bg-indigo-100 px-3 py-1 rounded-md border border-indigo-200">
                            👤 Pelaksana: Staff Dinas Sosial
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 3 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Melaksanakan pendataan dan entry data penyandang disabilitas</h3>
                    <p class="text-xs text-slate-600 mt-1">Staff Dinas Sosial mengumpulkan, memeriksa, dan melakukan entry data awal penyandang disabilitas se-Kabupaten/Kota ke dalam sistem pendataan terpadu.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Berkas Data</span>
                        <span><strong class="text-slate-800">Output:</strong> Data Penyandang Disabilitas Terdaftar</span>
                    </div>
                         <!-- Step 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-xs ring-4 ring-white">
                    2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-indigo-800 bg-indigo-100 px-3 py-1 rounded-md border border-indigo-200">
                            👤 Pelaksana: Staff Dinas Sosial
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 120 Menit (2 Jam)</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Permohonan dan/atau kebutuhan alat bantu penyandang disabilitas dan menyampaikan ke Dinas Sosial Kab/Kota</h3>
                    <p class="text-xs text-slate-600 mt-1">Staff Dinas Sosial memproses permohonan dari masyarakat/LKS, meneliti kelengkapan berkas permohonan kebutuhan alat bantu disabilitas, serta menyusun data pengajuan awal.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Berkas pengajuan sesuai persyaratan (KTP, KK, SKTM)</span>
                        <span><strong class="text-slate-800">Output:</strong> Data Penyandang Disabilitas By Name, By Address, NIK, &amp; Foto</span>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-indigo-800 bg-indigo-100 px-3 py-1 rounded-md border border-indigo-200">
                            👤 Pelaksana: Dinas Sosial Kab/Kota
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 120 Menit (2 Jam)</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Menelaah informasi dan melaksanakan peninjauan lapangan atas permohonan kebutuhan alat bantu untuk selanjutnya menyampaikan usulan/rekomendasi ke Dinas Sosial Provinsi</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Sosial Kabupaten/Kota menelaah informasi permohonan via **Decision Node (Belah Ketupat)** &amp; melaksanakan peninjauan lapangan atas permohonan alat bantu disabilitas.</p>
                    
                    <!-- Decision Branch Box -->
                    <div class="mt-3 p-3.5 bg-indigo-50/60 rounded-xl border border-indigo-200/80">
                        <div class="flex items-center gap-1.5 text-xs font-bold text-indigo-900 mb-2">
                            <span>🔷</span> Keputusan Verifikasi Dinas Sosial Kab/Kota:
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px]">
                            <div class="bg-emerald-100/70 border border-emerald-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-emerald-800">✅ YA:</span>
                                <span class="text-emerald-950 font-medium">Berkas lengkap &amp; sesuai persyaratan &rarr; Diteruskan ke Pekerja Sosial untuk Asesmen &amp; Usulan Rekomendasi Provinsi (Langkah 4).</span>
                            </div>
                            <div class="bg-rose-100/70 border border-rose-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-rose-800">❌ TIDAK:</span>
                                <span class="text-rose-950 font-medium">Berkas belum sesuai / kurang &rarr; Dikembalikan ke Staff Dinas Sosial untuk perbaikan berkas (Kembali ke Langkah 2).</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Sesuai Persyaratan</span>
                        <span><strong class="text-slate-800">Output:</strong> Surat Usulan/Rekomendasi Kebutuhan Alat Bantu Mobilitas Penyandang Disabilitas Kab/Kota</span>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-xs ring-4 ring-white">
                    4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-indigo-800 bg-indigo-100 px-3 py-1 rounded-md border border-indigo-200">
                            👤 Pelaksana: Pekerja Sosial
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 3 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Melakukan verifikasi permohonan rekomendasi dari Dinsos Kab/Kota</h3>
                    <p class="text-xs text-slate-600 mt-1">Pekerja Sosial memverifikasi keabsahan berkas permohonan rekomendasi usulan dari Dinas Sosial Kabupaten/Kota beserta kesesuaian spesifikasi alat bantu disabilitas.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Berkas lengkap</span>
                        <span><strong class="text-slate-800">Output:</strong> Data Penyandang Disabilitas by name, by address, by NIK, by Foto beserta kebutuhan Alat Bantu Mobilitas</span>
                    </div>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-indigo-800 bg-indigo-100 px-3 py-1 rounded-md border border-indigo-200">
                            👤 Pelaksana: Kepala Bidang Rehsos
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Proses pengadaan alat bantu melalui proses e katalog</h3>
                    <p class="text-xs text-slate-600 mt-1">Kepala Bidang Rehabilitasi Sosial memproses penetapan paket pengadaan alat bantu disabilitas secara elektronik melalui platform e-Katalog LKPP.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Proses pengadaan alat bantu melalui proses e katalog</span>
                        <span><strong class="text-slate-800">Output:</strong> Usulan/rekomendasi dan verifikasi Kebutuhan Alat Bantu Mobilitas Penyandang Disabilitas Kab/kota</span>
                    </div>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-xs ring-4 ring-white">
                    6
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-indigo-800 bg-indigo-100 px-3 py-1 rounded-md border border-indigo-200">
                            👤 Pelaksana: Kepala Dinas
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 7 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Pengajuan Draf SK Gub.penerima Alat Bantu Disabilitas Kab/Kota Se-Sumatera Utara</h3>
                    <p class="text-xs text-slate-600 mt-1">Kepala Dinas Sosial Provinsi Sumatera Utara mengajukan dan memproses penetapan Draf SK Gubernur penerima Bantuan Alat Bantu Disabilitas se-Sumatera Utara.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> SK Gubernur Penerima Alat Bantu Disabilitas Kab/Kota Se-Sumatera Utara</span>
                        <span><strong class="text-slate-800">Output:</strong> Daftar nama Penerima Alat bantu Disabilitas</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Nama-nama yang tercantum dalam SK sebagai penerima Alat Bantu Disabilitas Kab/Kota Se-Sumatera Utara</span>
                    </div>
                </div>
            </div>

            <!-- Step 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-xs ring-4 ring-white">
                    7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-indigo-800 bg-indigo-100 px-3 py-1 rounded-md border border-indigo-200">
                            👤 Pelaksana: Dinas Sosial Kab/Kota
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 3 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Penyaluran Alat Bantuan Penyandang Disabilitas</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Sosial Kabupaten/Kota melaksanakan penyaluran alat bantuan disabilitas kepada masyarakat penerima manfaat disertai penandatanganan Berita Serah Terima (BST).</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> 1. Penyaluran Alat Bantu Disabilitas Dinas Sosial Kab/kota, 2. Berita Serah Terima Bantuan Sosial, 3. KTP, KK dan SKTM</span>
                        <span><strong class="text-slate-800">Output:</strong> Tersalurnya Alat Bantu Disabilitas Dinas Sosial Kab/Kota</span>
                        <span><strong class="text-slate-800">Spesifikasi Alat:</strong> Alat Bantu Disabilitas Berupa : Kursi Roda, Hearing ( alat Bantu Dengar), Tongkat Kaki 3 , Tongkat Kaki 4, Brailler, wolker, Tongkat siku</span>
                    </div>
                </div>
            </div>

            <!-- Step 8 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-xs ring-4 ring-white">
                    8
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-indigo-800 bg-indigo-100 px-3 py-1 rounded-md border border-indigo-200">
                            👤 Pelaksana: Pekerja Sosial
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 2 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Laporan Berita Serah Terima Penerima Bantuan Alat Bantu Penyandang Disabilitas</h3>
                    <p class="text-xs text-slate-600 mt-1">Pekerja Sosial menyusun dan menyampaikan Laporan Berita Serah Terima Alat Bantu Disabilitas Dinas Sosial Kab/Kota ke Dinas Sosial Provinsi Sumatera Utara.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Laporan Berita Serah Terima Alat Bantu Disabilitas Dinas Sosial Kab/Kota Se-Sumatera Utara Ke- Masyarakat Penerima Alat Disabilitas (1. KTP, KK dan SKTM)</span>
                        <span><strong class="text-slate-800">Output:</strong> Laporan Berita Serah Terima Alat Bantu Disabilitas Dinas Sosial Kab/Kota Se-Sumatera Utara Ke- Masyarakat Penerima Alat Disabilitas 1.KTP,KK dan SKTM</span>
                    </div>
                </div>
            </div>

            <!-- Step 9 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white font-bold text-xs ring-4 ring-white">
                    9
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-indigo-800 bg-indigo-100 px-3 py-1 rounded-md border border-indigo-200">
                            👤 Pelaksana: Staff
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Arsip BST , KTP, KK , SKTM dan Dokumentasi</h3>
                    <p class="text-xs text-slate-600 mt-1">Staff Dinas Sosial mengarsipkan seluruh berkas kelengkapan BST, KTP, KK, SKTM dan Dokumentasi ke dalam dokumen pertanggungjawaban resmi.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> 1. BST, 2. KTP, KK dan SKTM, 3. Dokumentasi</span>
                        <span><strong class="text-slate-800">Output:</strong> Dokumen Pertanggungjawaban</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Arsip BST , KTP, KK , SKTM dan Dokumentasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Tabel Matriks SOP Resmi 9 Langkah -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm overflow-hidden">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-600 text-white text-sm">📋</span>
                Tabel Matriks Standard Operasional Prosedur (SOP Resmi)
            </h2>
            <span class="text-xs font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                Format Standar Menpan-RB (10 Kolom)
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse border border-slate-200">
                <thead>
                    <tr class="bg-slate-100 text-slate-800 font-bold">
                        <th rowspan="2" class="border border-slate-300 p-2.5 text-center w-10">NO</th>
                        <th rowspan="2" class="border border-slate-300 p-2.5 min-w-[200px]">URAIAN PROSEDUR</th>
                        <th colspan="5" class="border border-slate-300 p-2 text-center bg-indigo-50/70 text-indigo-950">PELAKSANA</th>
                        <th colspan="3" class="border border-slate-300 p-2 text-center bg-emerald-50/70 text-emerald-950">MUTU BAKU</th>
                        <th rowspan="2" class="border border-slate-300 p-2.5 min-w-[150px]">KETERANGAN</th>
                    </tr>
                    <tr class="bg-slate-50 text-slate-700 font-semibold text-[11px]">
                        <th class="border border-slate-300 p-2 text-center w-20">Staff</th>
                        <th class="border border-slate-300 p-2 text-center w-24">Dinsos Kab/Kota</th>
                        <th class="border border-slate-300 p-2 text-center w-24">Pekerja Sosial</th>
                        <th class="border border-slate-300 p-2 text-center w-24">Kabid Rehsos</th>
                        <th class="border border-slate-300 p-2 text-center w-24">Kepala Dinas</th>
                        <th class="border border-slate-300 p-2 min-w-[140px]">PERSYARATAN / PERLENGKAPAN</th>
                        <th class="border border-slate-300 p-2 text-center w-20">WAKTU</th>
                        <th class="border border-slate-300 p-2 min-w-[150px]">OUTPUT</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">1</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Melaksanakan pendataan dan entry data penyandang disabilitas</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-indigo-600 bg-indigo-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Berkas Data</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">3 Hari</td>
                        <td class="border border-slate-200 p-2.5">Data Penyandang Disabilitas</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">2</td>
                        <td class="border border-slate-200 p-2.5 font-medium">permohonan dan/atau kebutuhan alat bantu penyandang disabilitas dan menyampaikan ke Dinas Sosial Kab/ Kota</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-indigo-600 bg-indigo-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Berkas pengajuan sesuai persyaratan</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">120 Menit</td>
                        <td class="border border-slate-200 p-2.5">Data Penyandang Disabilitas by name, by address, by NIK, by Foto</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">3</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Menelaah informasi dan melaksanakan peninjauan lapangan atas permohonan kebutuhan alat bantu untuk selanjutnya menyampaikan usulan/rekomendasi ke Dinas Sosial Provinsi</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-indigo-600 bg-indigo-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Sesuai Persyaratan</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">120 Menit</td>
                        <td class="border border-slate-200 p-2.5">Surat Usulan/rekomendasi Kebutuhan Alat Bantu Mobilitas Penyandang Disabilitas Kab/kota</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">4</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Melakukan verifikasi permohonan rekomendasi dari Dinsos Kab/Kota</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-indigo-600 bg-indigo-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Berkas lengkap</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">3 Hari</td>
                        <td class="border border-slate-200 p-2.5">Data Penyandang Disabilitas by name, by address, by NIK, by Foto beserta kebutuhan Alat Bantu Mobilitas</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 5 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">5</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Proses pengadaan alat bantu melalui proses e katalog</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-indigo-600 bg-indigo-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Proses pengadaan alat bantu melalui proses e katalog</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 Hari</td>
                        <td class="border border-slate-200 p-2.5">Usulan/rekomendasi dan verifikasi Kebutuhan Alat Bantu Mobilitas Penyandang Disabilitas Kab/kota</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 6 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">6</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Pengajuan Draf SK Gub.penerima Alat Bantu Disabilitas Kab/Kota Se-Sumatera Utara</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-indigo-600 bg-indigo-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5">SK Gubernur Penerima Alat Bantu Disabilitas Kab/Kota Se-Sumatera Utara</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">7 Hari</td>
                        <td class="border border-slate-200 p-2.5">Daftar nama Penerima Alat bantu Disabilitas</td>
                        <td class="border border-slate-200 p-2.5 text-slate-600">Nama-nama yang tercantum dalam SK sebagai penerima Alat Bantu Disabilitas Kab/Kota Se-Sumatera Utara</td>
                    </tr>
                    <!-- Row 7 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">7</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Penyaluran Alat Bantuan Penyandang Disabilitas</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-indigo-600 bg-indigo-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">1. Penyaluran Alat Bantu Disabilitas Dinas Sosial Kab/kota<br>2. Berita Serah Terima Bantuan Sosial<br>3. KTP, KK dan SKTM</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">3 Hari</td>
                        <td class="border border-slate-200 p-2.5">Tersalurnya Alat Bantu Disabilitas Dinas Sosial Kab/Kota</td>
                        <td class="border border-slate-200 p-2.5 text-slate-600">Alat Bantu Disabilitas Berupa : Kursi Roda, Hearing ( alat Bantu Dengar), Tongkat Kaki 3 , Tongkat Kaki 4, Brailler, wolker, Tongkat siku</td>
                    </tr>
                    <!-- Row 8 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">8</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Laporan Berita Serah Terima Penerima Bantuan Alat Bantu Penyandang Disabilitas</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-indigo-600 bg-indigo-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Laporan Berita Serah Terima Alat Bantu Disabilitas Dinas Sosial Kab/Kota Se-Sumatera Utara Ke- Masyarakat Penerima Alat Disabilitas (1. KTP, KK dan SKTM)</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">2 Hari</td>
                        <td class="border border-slate-200 p-2.5">Laporan Berita Serah Terima Alat Bantu Disabilitas Dinas Sosial Kab/Kota Se-Sumatera Utara Ke- Masyarakat Penerima Alat Disabilitas 1.KTP,KK dan SKTM</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 9 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">9</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Arsip BST , KTP, KK , SKTM dan Dokumentasi</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-indigo-600 bg-indigo-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">1. BST<br>2. KTP, KK dan SKTM<br>3. Dokumentasi</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 Hari</td>
                        <td class="border border-slate-200 p-2.5">Dokumen Pertanggungjawaban</td>
                        <td class="border border-slate-200 p-2.5 text-slate-600">Arsip BST , KTP, KK , SKTM dan Dokumentasi</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
