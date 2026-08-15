@extends('layouts.app')

@section('title', 'SOP Pembinaan & Fasilitasi Karang Taruna - SADA SOSIAL')

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
                    SOP Resmi - Karang Taruna (Bidang Dayasos)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Pembinaan &amp; Fasilitasi Karang Taruna</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Standar Operasional Prosedur Pendataan Pengurus, Undangan Pembinaan, Persiapan Sarpras, Pelaksanaan Fasilitasi, hingga Pengesahan Laporan Karang Taruna.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pemberdayaan.pilar.create') }}" class="rounded-xl bg-teal-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-teal-700 transition">
                    + Ajukan Usulan Karang Taruna
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Tahapan Alur Prosedur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">14 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-teal-600 mt-1 block">10 Unit / Jabatan</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">1 Hari + 8 Jam 5 Mins</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (14 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-teal-600 text-white text-sm">📋</span>
            Visual Diagram Alur Pembinaan Karang Taruna (14 Tahapan)
        </h2>

        <div class="relative border-l-2 border-teal-200 ml-4 sm:ml-6 space-y-6 pl-6 sm:pl-8 py-2">
            <!-- Step 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Pengelolaan Data Pemberdayaan Sosial
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 Jam (60 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pendataan Susunan Pengurus Karang Taruna</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Mendata dan memverifikasi SK Pengurus Karang Taruna Kabupaten/Kota &amp; Kecamatan sasaran pembinaan.
                    </p>
                </div>
            </div>

            <!-- Step 3, 4, 5, 6, 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    3-7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Persuratan, Sekretaris, Kadis, Data &amp; Kesra
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 Hari + 45 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pembuatan, Verifikasi, TTD Kadis &amp; Pengiriman Undangan Pembinaan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Penyusunan naskah undangan, verifikasi Sekretaris, TTD Kadinsos, penggandaan surat, dan distribusi pengiriman undangan resmi ekspedisi ke pengurus Karang Taruna.
                    </p>
                </div>
            </div>

            <!-- Step 8 & 9 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    8-9
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Staf Dayasos &amp; Pramu Kebersihan
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 2 Jam (120 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Persiapan &amp; Kebersihan Sarana Prasarana Kegiatan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Staf Dayasos dan pramu kebersihan menyiapkan, menata, serta memastikan ruang dan peralatan pembinaan Karang Taruna siap pakai &amp; bersih.
                    </p>
                </div>
            </div>

            <!-- Step 10 & 11 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    10-11
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Fungsional
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 4 Jam (240 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pelaksanaan Pembinaan, Fasilitasi &amp; Pembuatan Draft Laporan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Penyampaian materi pembinaan Karang Taruna, fasilitasi diskusi pemuda, pencatatan notulen/dokumentasi, serta pembuatan draft laporan kegiatan.
                    </p>
                </div>
            </div>

            <!-- Step 12, 13, 14 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    12-14
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Kesra, Sekretaris &amp; Kadinsos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 15 Menit (5 + 5 + 5)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Verifikasi, Penyampaian &amp; Penandatanganan Laporan Hasil Pembinaan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Verifikasi teknis laporan oleh Kesra, pengajuan ringkasan laporan oleh Sekretaris, dan penandatanganan pengesahan laporan oleh Kadinsos.
                    </p>
                </div>
            </div>

            <!-- Step 15 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    15
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Arsiparis
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 5 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pengarsipan Laporan Pembinaan Karang Taruna</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Dokumen laporan pembinaan dan fasilitasi Karang Taruna yang disahkan disimpan secara sistematis dalam arsip bidang.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; SLA SOP Karang Taruna</h2>
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
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mendata susunan pengurus Karang Taruna</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Data Dayasos</td>
                        <td class="p-3 border-r border-slate-200">SK Pengurus Karang Taruna</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Jam</td>
                        <td class="p-3">SK Pengurus Karang Taruna terverifikasi</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Membuat undangan ke pengurus Karang Taruna</td>
                        <td class="p-3 border-r border-slate-200">Pengadministrasian Persuratan</td>
                        <td class="p-3 border-r border-slate-200">Surat Undangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10 Menit</td>
                        <td class="p-3">Draft Surat Undangan Pembinaan</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Verifikasi undangan</td>
                        <td class="p-3 border-r border-slate-200">Sekretaris</td>
                        <td class="p-3 border-r border-slate-200">Surat Undangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5 Menit</td>
                        <td class="p-3">Surat Undangan Disetujui</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Menandatangani undangan</td>
                        <td class="p-3 border-r border-slate-200">Kadis</td>
                        <td class="p-3 border-r border-slate-200">Surat Undangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10 Menit</td>
                        <td class="p-3">Surat Undangan Bertanda Tangan Kadis</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">6</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penggandaan undangan</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Data Dayasos</td>
                        <td class="p-3 border-r border-slate-200">Surat Undangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">20 Menit</td>
                        <td class="p-3">Salinan Surat Undangan Pembinaan</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">7</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Pengiriman undangan</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">Surat Undangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari</td>
                        <td class="p-3">Ekspedisi Pengiriman Surat Undangan</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">8</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mempersiapkan sarana prasarana</td>
                        <td class="p-3 border-r border-slate-200">Staf Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200">Sarana Prasarana</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Sarana Prasarana Siap Pakai</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">9</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Membersihkan sarana prasarana</td>
                        <td class="p-3 border-r border-slate-200">Pramu Kebersihan</td>
                        <td class="p-3 border-r border-slate-200">Sarana Prasarana</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Sarana Prasarana Bersih</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Melaksanakan pembinaan dan fasilitasi Karang Taruna</td>
                        <td class="p-3 border-r border-slate-200">Fungsional</td>
                        <td class="p-3 border-r border-slate-200">Daftar Hadir, Notulen, Materi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3 Jam</td>
                        <td class="p-3">Daftar Hadir, Notulen, Dokumentasi Pembinaan</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">11</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Membuat laporan hasil pembinaan dan fasilitasi</td>
                        <td class="p-3 border-r border-slate-200">Fungsional</td>
                        <td class="p-3 border-r border-slate-200">Laporan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Draft Laporan hasil Pembinaan dan Fasilitasi</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">12</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Verifikasi laporan hasil pembinaan dan fasilitasi</td>
                        <td class="p-3 border-r border-slate-200">Pengelolaan Kesra</td>
                        <td class="p-3 border-r border-slate-200">Laporan Hasil Pembinaan &amp; Fasilitasi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5 Menit</td>
                        <td class="p-3">Draft Laporan Terverifikasi</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">13</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Menyampaikan laporan hasil pembinaan dan fasilitasi</td>
                        <td class="p-3 border-r border-slate-200">Sekretaris</td>
                        <td class="p-3 border-r border-slate-200">Laporan Hasil Pembinaan &amp; Fasilitasi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5 Menit</td>
                        <td class="p-3">Laporan Hasil Pembinaan Teruskan ke Kadis</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">14</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Menandatangani laporan</td>
                        <td class="p-3 border-r border-slate-200">Kadis</td>
                        <td class="p-3 border-r border-slate-200">Laporan Hasil Pembinaan &amp; Fasilitasi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5 Menit</td>
                        <td class="p-3">Laporan Hasil Pembinaan Disetujui Kadis</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">15</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mengarsipkan laporan</td>
                        <td class="p-3 border-r border-slate-200">Arsiparis</td>
                        <td class="p-3 border-r border-slate-200">Laporan Hasil Pembinaan &amp; Fasilitasi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5 Menit</td>
                        <td class="p-3">Dokumen Terarsip Resmi</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-teal-50 font-bold text-teal-900 border-t-2 border-teal-300">
                        <td colspan="4" class="p-3 text-right uppercase tracking-wider border-r border-teal-200">Total Mutu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-teal-200">1 Hari + 8 Jam 5 Mins</td>
                        <td class="p-3">Sesuai SOP Resmi Dinsos Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
