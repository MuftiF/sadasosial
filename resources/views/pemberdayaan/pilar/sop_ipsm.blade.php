@extends('layouts.app')

@section('title', 'SOP Pembentukan & Penugasan IPSM / PSM - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!-- Top Breadcrumb & Header -->
    <div class="mb-8">
        <a href="{{ route('pemberdayaan.pilar.index') }}" class="inline-flex items-center text-xs font-bold text-teal-600 hover:underline gap-1 mb-3">
            &larr; Kembali ke Pembinaan Pilar Sosial
        </a>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <span class="inline-flex items-center rounded-full bg-teal-100 px-3 py-1 text-xs font-semibold text-teal-800 mb-2">
                    SOP Resmi - Pekerja Sosial Masyarakat (PSM / IPSM)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Pembentukan, Pembekalan &amp; Penugasan PSM</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Standar Operasional Prosedur Identifikasi, Penjaringan, Verifikasi, Bimtek, Penetapan SK, Pendataan, hingga Monitoring Penugasan Pekerja Sosial Masyarakat (PSM).
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pemberdayaan.pilar.create') }}" class="rounded-xl bg-teal-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-teal-700 transition">
                    + Ajukan Usulan PSM / IPSM
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Tahapan Alur Prosedur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">15 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-teal-600 mt-1 block">6 Unit / Jabatan</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">30 Hari + 60 Menit</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (15 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-teal-600 text-white text-sm">📋</span>
            Visual Diagram Alur Pembentukan &amp; Penugasan PSM (15 Tahapan)
        </h2>

        <div class="relative border-l-2 border-teal-200 ml-4 sm:ml-6 space-y-6 pl-6 sm:pl-8 py-2">
            <!-- Step 1 & 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    1-2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Pengelolaan Kesejahteraan Sosial
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Identifikasi Kebutuhan PSM</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Mengumpulkan data potensi PSKS wilayah dan memetakan jumlah alokasi kebutuhan Pekerja Sosial Masyarakat (PSM) di tiap Desa/Kelurahan &amp; Kecamatan.
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Pengelolaan Data Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 2 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penyusunan Rencana Pembentukan PSM</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Menyusun dokumen rencana pembentukan PSM berbasis data lokasi dan jadwal pelaksanaan sosialisasi &amp; penjaringan.
                    </p>
                </div>
            </div>

            <!-- Step 4 & 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    4-5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Kabid Dayasos &amp; Pengelolaan Kesra
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 8 Hari Kerja (1 + 7)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Sosialisasi Desa/Kelurahan &amp; Penjaringan Calon PSM</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pengiriman surat undangan sosialisasi ke desa/kelurahan serta pembukaan masa penjaringan calon anggota PSM di wilayah sasaran.
                    </p>
                </div>
            </div>

            <!-- Step 6 & 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    6-7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Pengelolaan Data Dayasos &amp; Kesra
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 8 Hari Kerja (4 + 4)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Verifikasi Administrasi &amp; Seleksi Wawancara</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Memeriksa kelengkapan berkas administrasi calon PSM, dilanjutkan seleksi wawancara untuk menerbitkan Berita Acara Hasil Seleksi.
                    </p>
                </div>
            </div>

            <!-- Step 8 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    8
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Fungsional
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Bimbingan Teknis Dasar Bagi Calon PSM</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pemberian bimbingan teknis dasar mengenai tugas pokok, fungsi, etika, dan peran PSM dalam pendampingan masalah kesejahteraan sosial.
                    </p>
                </div>
            </div>

            <!-- Step 9 & 10 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    9-10
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Kepala Dinas Sosial &amp; Kesra
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 5 Hari Kerja (3 + 2)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penetapan SK Kadinas &amp; Pembekalan Pelatihan Dasar</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Penandatanganan Surat Keputusan (SK) Penetapan PSM oleh Kadinsos, diikuti pembekalan pelatihan intensif sebelum penugasan lapangan.
                    </p>
                </div>
            </div>

            <!-- Step 11, 12, 13 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    11-13
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Pengelolaan Kesra
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 4 Hari Kerja + 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pendataan SIM-PSKS, Penugasan &amp; Monitoring Evaluasi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Mengentri data PSM terdaftar ke sistem SIM-PSKS/SADA SOSIAL, menerbitkan Surat Tugas Penugasan PSM, serta melaksanakan monev berkala.
                    </p>
                </div>
            </div>

            <!-- Step 14 & 15 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    14-15
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Arsiparis &amp; Pengelolaan Kesra
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 1 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pengarsipan Dokumen Laporan &amp; Selesai</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pengarsipan resmi seluruh dokumen pembentukan dan penugasan PSM. Kebutuhan PSM di Kabupaten/Kota resmi terpenuhi.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; Rincian SLA SOP IPSM / PSM</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 border-b border-slate-200">
                        <th class="p-3 font-bold text-center w-12 border-r border-slate-200">No</th>
                        <th class="p-3 font-bold border-r border-slate-200 min-w-[200px]">Uraian Prosedur</th>
                        <th class="p-3 font-bold border-r border-slate-200">Pelaksana</th>
                        <th class="p-3 font-bold border-r border-slate-200">Persyaratan / Perlengkapan</th>
                        <th class="p-3 font-bold text-center border-r border-slate-200 w-24">Waktu</th>
                        <th class="p-3 font-bold">Output</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mulai</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">-</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">-</td>
                        <td class="p-3">Permulaan alur pembentukan PSM</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Identifikasi kebutuhan PSM</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">Data PSKS</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari</td>
                        <td class="p-3">Dokumen hasil identifikasi kebutuhan PSM</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penyusunan rencana pembentukan PSM</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Data Dayasos</td>
                        <td class="p-3 border-r border-slate-200">Data Lokasi pembentukan PSM</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2 Hari</td>
                        <td class="p-3">Rencana Pembentukan PSM</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Sosialisasi kepada desa/kelurahan</td>
                        <td class="p-3 border-r border-slate-200">Kabid Dayasos</td>
                        <td class="p-3 border-r border-slate-200">Surat Undangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari</td>
                        <td class="p-3">Tersalurnya informasi kebutuhan PSM</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penjaringan calon PSM</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">Surat Undangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">7 Hari</td>
                        <td class="p-3">Daftar calon PSM terjaring</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">6</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Verifikasi administrasi calon PSM</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Data Dayasos</td>
                        <td class="p-3 border-r border-slate-200">Persyaratan menjadi PSM</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4 Hari</td>
                        <td class="p-3">Daftar calon PSM lulus administrasi</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">7</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Seleksi / wawancara calon PSM</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">Pedoman seleksi/wawancara</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4 Hari</td>
                        <td class="p-3">Berita acara hasil seleksi calon PSM</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">8</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Bimbingan teknis dasar bagi calon PSM</td>
                        <td class="p-3 border-r border-slate-200">Fungsional</td>
                        <td class="p-3 border-r border-slate-200">Materi bimbingan teknis dasar</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari</td>
                        <td class="p-3">Calon PSM telah mengikuti bimtek dasar</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">9</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penetapan PSM melalui SK</td>
                        <td class="p-3 border-r border-slate-200">Kepala Dinas Sosial</td>
                        <td class="p-3 border-r border-slate-200">Berita acara hasil seleksi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3 Hari</td>
                        <td class="p-3">Surat Keputusan (SK) penetapan PSM</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Pembekalan dan pelatihan dasar PSM</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">Materi pembekalan/pelatihan dasar</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2 Hari</td>
                        <td class="p-3">PSM yang telah dibekali dan dilatih</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">11</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Pendataan PSM</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">Sistem pendataan PSKS</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Data PSM terdaftar di sistem</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">12</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penugasan PSM</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">Surat tugas penugasan PSM</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari</td>
                        <td class="p-3">Surat tugas penugasan PSM resmi</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">13</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Monitoring dan evaluasi</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">Instrumen monitoring dan evaluasi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3 Hari</td>
                        <td class="p-3">Laporan hasil monitoring dan evaluasi</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">14</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mengarsipkan laporan</td>
                        <td class="p-3 border-r border-slate-200">Arsiparis</td>
                        <td class="p-3 border-r border-slate-200">Laporan Hasil Pembinaan dan Fasilitasi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari</td>
                        <td class="p-3">Dokumen &amp; laporan terarsip</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">15</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Selesai</td>
                        <td class="p-3 border-r border-slate-200">Arsiparis / Kesra</td>
                        <td class="p-3 border-r border-slate-200">Laporan Hasil Pembinaan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">-</td>
                        <td class="p-3">PSM Kabupaten/Kota terpenuhi</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-teal-50 font-bold text-teal-900 border-t-2 border-teal-300">
                        <td colspan="4" class="p-3 text-right uppercase tracking-wider border-r border-teal-200">Total Mutu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-teal-200">30 Hari + 60 Mins</td>
                        <td class="p-3">Sesuai SOP Resmi Dinsos Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
