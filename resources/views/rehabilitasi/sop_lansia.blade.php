@extends('layouts.app')

@section('title', 'SOP Bansos Sembako LKS-LU Panti Swasta')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('rehabilitasi.subproses.index', 'lansia') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-3">
            &larr; Kembali ke Layanan Lansia
        </a>
        <span class="inline-flex items-center rounded-md bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-800 ring-1 ring-inset ring-amber-600/20 mb-2">
            SOP Resmi Subproses 3.2 - Bidang Rehabilitasi Sosial
        </span>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">SOP BANTUAN SOSIAL SEMBAKO LEMBAGA KESEJAHTERAAN SOSIAL LANJUT USIA (LKS-LU) PANTI SWASTA KAB/KOTA SE-SUMATERA UTARA</h1>
        <p class="text-sm text-slate-500 mt-2">Standar Operasional Prosedur pengusulan, verifikasi, hingga penyaluran &amp; pertanggungjawaban bansos sembako LKS-LU Panti Swasta (Total SLA: 21 Hari Kerja).</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Total Tahapan Alur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">10 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-amber-600 mt-1 block">7 Aktor / Jabatan</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Total Mutu Baku (SLA)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">21 Hari Kerja</span>
        </div>
    </div>

    <!-- Section 1: Visual Timeline (10 Steps Flowchart & Pelaksana Details) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-600 text-white text-sm">👵</span>
            Visual Diagram Alur &amp; Hubungan Pelaksana (10 Langkah Kerja)
        </h2>

        <div class="relative border-l-2 border-amber-200 ml-4 sm:ml-6 space-y-8 pl-6 sm:pl-8 py-2">
            <!-- Step 1 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    1
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: Dinsos Kab / Kota
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Melaksanakan Up Date Data LKS-LU dan pengusulan LKS-LU terpilih Penerima Bansos</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Sosial Kabupaten/Kota melakukan pembaruan data LKS-LU serta mengusulkan LKS-LU terpilih yang berkasnya lengkap dan memenuhi persyaratan penerima bantuan sosial.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> Berkas Data</span>
                        <span><strong class="text-slate-800">Output:</strong> Diterimanya data sesuai persyaratan</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Penerimaan Berkas data lengkap dan sesuai persyaratan</span>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: Staf Pengolah Data
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 2 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Berdasarkan data LKS-LU Se-Sumatera Utara yang sudah terdaftar dan terpilih penerima Bansos</h3>
                    <p class="text-xs text-slate-600 mt-1">Staf Pengolah Data mengolah dan menyiapkan berkas pengajuan LKS-LU se-Sumatera Utara yang sudah terdaftar dan terpilih sesuai persyaratan penerima bantuan sosial.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> Berkas pengajuan sesuai persyaratan Sesuai Persyaratan Pendirian LKS-LU</span>
                        <span><strong class="text-slate-800">Output:</strong> Tersedianya data Penerima Bansos</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Sesuai dengan persyaratan penerima Bantuan sosial</span>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: Staf Pengevaluasi
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 2 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Penginputan LKS-LU</h3>
                    <p class="text-xs text-slate-600 mt-1">Staf Pengevaluasi melakukan penginputan data LKS-LU ke dalam daftar penerima bansos terdata se-Sumatera Utara sesuai persyaratan pendirian kelembagaan LKS-LU.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> Berkas pengajuan sesuai persyaratan Sesuai Persyaratan Pendirian LKS-LU</span>
                        <span><strong class="text-slate-800">Output:</strong> Daftar Penerima Bansos</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Penerima Bansos yang terdata LKS-LU Se-Sumatera Utara</span>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: Pekerja Sosial &amp; Kabid Rehsos
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Verifikasi Data dan Penerima Bansos LKS-LU</h3>
                    <p class="text-xs text-slate-600 mt-1">Pekerja Sosial bersama Kepala Bidang Rehsos memverifikasi keabsahan data kelembagaan dan kelayakan calon penerima bansos agar memenuhi persyaratan panti swasta.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> 1. Berkas pendirian LKS-LU; 2. LKS-LU terpilih penerima bantuan sesuai dengan syarat dan layak memperoleh bantuan</span>
                        <span><strong class="text-slate-800">Output:</strong> Daftar LKS-LU yang memenuhi persyaratan menerima Bansos</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> 1. Memenuhi persyaratan kelembagaan; 2. LKS-LU termasuk dalam panti swasta</span>
                    </div>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: LKS-LU
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 2 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Pengajuan Proposal Bansos</h3>
                    <p class="text-xs text-slate-600 mt-1">Lembaga Kesejahteraan Sosial Lanjut Usia (LKS-LU) menyusun dan mengajukan proposal bantuan sosial formal lengkap beserta Rencana Anggaran Biaya (RAB).</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> 1. Persyaratan Lembaga; 2. RAB</span>
                        <span><strong class="text-slate-800">Output:</strong> Daftar Penerima Bansos</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Untuk memperoleh persetujuan sebagai penerima Bansos</span>
                    </div>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    6
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: Dinsos Kab / Kota
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Rekomendasi Penerima Bansos</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Sosial Kabupaten/Kota menerbitkan Surat Rekomendasi resmi atas nama-nama LKS-LU yang telah disetujui memperoleh bantuan sosial.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> Berkas lengkap</span>
                        <span><strong class="text-slate-800">Output:</strong> Rekomendasi Dinsos Kab/Kota</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Nama-nama LKS-LU yang telah disetujui memperoleh Bansos</span>
                    </div>
                </div>
            </div>

            <!-- Step 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: Kepala Dinas
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Pengajuan Draf SK Gubernur</h3>
                    <p class="text-xs text-slate-600 mt-1">Kepala Dinas Sosial menelaah dan mengajukan draf Surat Keputusan (SK) Gubernur mengenai penetapan penerima bantuan sosial.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> Dokumen Penerima Bansos</span>
                        <span><strong class="text-slate-800">Output:</strong> SK Gubernur penerima bansos</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Terbitnya SK gubernur penerima Bansos</span>
                    </div>
                </div>
            </div>

            <!-- Step 8 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    8
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: LKS-LU
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 7 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Terbitnya SK Gubernur Penerima Bansos Sembako LKS-LU Panti Swasta Kab/Kota Se-Sumatera Utara</h3>
                    <p class="text-xs text-slate-600 mt-1">Penetapan resmi penerima bantuan dalam SK Gubernur yang memuat daftar nama lembaga LKS-LU panti swasta se-Sumatera Utara yang berhak menerima bansos sembako.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> SK Gubernur Penerima Bansos Sembako LKS-LU Panti Swasta Kab/Kota Se Sumatera Utara</span>
                        <span><strong class="text-slate-800">Output:</strong> Daftar nama Penerima bansos</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Nama lembaga yang tercantum dalam SK sebagai penerima bansos Sembako LKS-LU Panti Swasta Kab/Kota Se Sumatera Utara</span>
                    </div>
                </div>
            </div>

            <!-- Step 9 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    9
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: LKS-LU (Didampingi Dinsos Kab/Kota)
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 3 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Penyaluran Bantuan Sosial Sembako LKS-LU Panti Swasta Kab/Kota Se-Sumatera Utara</h3>
                    <p class="text-xs text-slate-600 mt-1">Penyaluran fisik barang bansos sembako ke lembaga LKS-LU dengan pendampingan Dinas Sosial Kabupaten/Kota serta pembuatan Berita Serah Terima (BST) Bantuan.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> 1. Penyaluran Bantuan Sosial ke Lembaga LKS-LU dan didampingi Dinas Sosial Kab/kota; 2. Berita Serah Terima Bantuan Sosial; 3. Proposal LKS-LU dan Dokumentasi</span>
                        <span><strong class="text-slate-800">Output:</strong> Tersalurnya Bansos sesuai daftar</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Realisasi Bansos Sembako LKS-LU Panti Swasta Kab/Kota Se Sumatera Utara</span>
                    </div>
                </div>
            </div>

            <!-- Step 10 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    10
                </div>
                <div class="bg-amber-50/80 p-5 rounded-2xl border border-amber-200 hover:border-amber-400 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-md border border-amber-200">
                            👤 Pelaksana: Pekerja Sosial
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Arsip BST LKS-LU, Proposal LKS-LU dan Dokumentasi untuk Pertanggungjawaban</h3>
                    <p class="text-xs text-slate-600 mt-1">Pekerja Sosial mengarsip seluruh dokumen Berita Serah Terima (BST), proposal LKS-LU, dan foto dokumentasi penyaluran sebagai Laporan Pertanggungjawaban resmi.</p>
                    <div class="mt-3 pt-3 border-t border-amber-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Kelengkapan:</strong> 1. BST LKS-LU; 2. Proposal LKS-LU; 3. Dokumentasi</span>
                        <span><strong class="text-slate-800">Output:</strong> 1. Proposal LKS-LU; 2. Dokumentasi</span>
                        <span><strong class="text-slate-800">Keterangan:</strong> Proposal LKS-LU untuk Pertanggungjawaban dan Dokumentasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Detailed Matrix Table (Tabel Mutu Baku & Pelaksana SOP) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-600 text-white text-sm">📊</span>
            Tabel Matriks Mutu Baku &amp; Pelaksana SOP Bansos Sembako LKS-LU
        </h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse border border-slate-200">
                <thead>
                    <tr class="bg-amber-700 text-white font-bold text-center">
                        <th class="p-3 border border-amber-800 w-10" rowspan="2">NO</th>
                        <th class="p-3 border border-amber-800" rowspan="2">KEGIATAN</th>
                        <th class="p-2 border border-amber-800" colspan="7">PELAKSANA</th>
                        <th class="p-2 border border-amber-800" colspan="4">MUTU BAKU</th>
                    </tr>
                    <tr class="bg-amber-600 text-white text-[11px] font-semibold text-center">
                        <th class="p-2 border border-amber-700">Dinsos Kab/Kota</th>
                        <th class="p-2 border border-amber-700">Staf Pengolah Data</th>
                        <th class="p-2 border border-amber-700">Staf Pengevaluasi</th>
                        <th class="p-2 border border-amber-700">Kepala Dinas</th>
                        <th class="p-2 border border-amber-700">LKS-LU</th>
                        <th class="p-2 border border-amber-700">Pekerja Sosial</th>
                        <th class="p-2 border border-amber-700">Kabid Rehsos</th>
                        <th class="p-2 border border-amber-700">Kelengkapan</th>
                        <th class="p-2 border border-amber-700 w-16">Waktu</th>
                        <th class="p-2 border border-amber-700">Output</th>
                        <th class="p-2 border border-amber-700">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700 font-medium">
                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">1</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Melaksanakan Up Date Data LKS-LU dan pengusulan LKS-LU terpilih Penerima Bansos</td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Berkas Data</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">1 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">Diterimanya data sesuai persyaratan</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Penerimaan Berkas data lengkap dan sesuai persyaratan</td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">2</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Berdasarkan data LKS-LU Se-Sumatera Utara yang sudah terdaftar dan terpilih penerima Bansos</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Berkas pengajuan sesuai persyaratan Sesuai Persyaratan Pendirian LKS-LU</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">2 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">Tersedianya data Penerima Bansos</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Sesuai dengan persyaratan penerima Bantuan sosial</td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">3</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Penginputan LKS-LU</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Berkas pengajuan sesuai persyaratan Sesuai Persyaratan Pendirian LKS-LU</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">2 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">Daftar Penerima Bansos</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Penerima Bansos yang terdata LKS-LU Se-Sumatera Utara</td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">4</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Verifikasi Data dan Penerima Bansos LKS-LU</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">1. Berkas pendirian LKS-LU; 2. LKS-LU terpilih penerima bantuan sesuai dengan syarat dan layak memperoleh bantuan</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">1 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">Daftar LKS-LU yang memenuhi persyaratan menerima Bansos</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">1. Memenuhi persyaratan kelembagaan; 2. LKS-LU termasuk dalam panti swasta</td>
                    </tr>
                    <!-- Row 5 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">5</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Pengajuan Proposal Bansos</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">1. Persyaratan Lembaga; 2. RAB</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">2 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">Daftar Penerima Bansos</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Untuk memperoleh persetujuan sebagai penerima Bansos</td>
                    </tr>
                    <!-- Row 6 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">6</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Rekomendasi Penerima Bansos</td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Berkas lengkap</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">1 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">Rekomendasi Dinsos Kab/Kota</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Nama-nama LKS-LU yang telah disetujui memperoleh Bansos</td>
                    </tr>
                    <!-- Row 7 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">7</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Pengajuan Draf SK Gubernur</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Dokumen Penerima Bansos</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">1 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">SK Gubernur penerima bansos</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Terbitnya SK gubernur penerima Bansos</td>
                    </tr>
                    <!-- Row 8 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">8</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Terbitnya SK Gubernur Penerima Bansos Sembako LKS-LU Panti Swasta Kab/Kota Se-Sumatera Utara</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">SK Gubernur Penerima Bansos Sembako LKS-LU Panti Swasta Kab/Kota Se Sumatera Utara</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">7 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">Daftar nama Penerima bansos</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Nama lembaga yang tercantum dalam SK sebagai penerima bansos Sembako LKS-LU Panti Swasta Kab/Kota Se Sumatera Utara</td>
                    </tr>
                    <!-- Row 9 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">9</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Penyaluran Bantuan Sosial Sembako LKS-LU Panti Swasta Kab/Kota Se-Sumatera Utara</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">1. Penyaluran Bantuan Sosial ke Lembaga LKS-LU dan didampingi Dinas Sosial Kab/kota; 2. Berita Serah Terima Bantuan Sosial; 3. Proposal LKS-LU dan Dokumentasi</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">3 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">Tersalurnya Bansos sesuai daftar</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Realisasi Bansos Sembako LKS-LU Panti Swasta Kab/Kota Se Sumatera Utara</td>
                    </tr>
                    <!-- Row 10 -->
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-2.5 text-center font-bold border border-slate-200">10</td>
                        <td class="p-2.5 border border-slate-200 font-semibold">Arsip BST LKS-LU, Proposal LKS-LU dan Dokumentasi untuk Pertanggungjawaban</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 text-center border border-slate-200 bg-amber-50 text-amber-800 font-extrabold text-sm">✓</td>
                        <td class="p-2.5 text-center border border-slate-200"></td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">1. BST LKS-LU; 2. Proposal LKS-LU; 3. Dokumentasi</td>
                        <td class="p-2.5 text-center font-bold border border-slate-200">1 hari</td>
                        <td class="p-2.5 border border-slate-200 font-normal">1. Proposal LKS-LU; 2. Dokumentasi</td>
                        <td class="p-2.5 border border-slate-200 text-slate-600 font-normal">Proposal LKS-LU untuk Pertanggungjawaban dan Dokumentasi</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-amber-100 font-bold text-amber-950 border-t-2 border-amber-400">
                        <td colspan="9" class="p-3 text-right uppercase tracking-wider border border-amber-200">Total Mutu Baku (SLA Penyelesaian)</td>
                        <td class="p-3 text-center text-sm border border-amber-200">21 Hari Kerja</td>
                        <td colspan="2" class="p-3 border border-amber-200">Sesuai SOP Resmi Dinsos Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
