@extends('layouts.app')

@section('title', 'SOP Pemutakhiran Data PKJPK - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!-- Top Breadcrumb & Header -->
    <div class="mb-8">
        <a href="{{ route('pemberdayaan.kepahlawanan.index') }}" class="inline-flex items-center text-xs font-bold text-amber-600 hover:underline gap-1 mb-3">
            &larr; Kembali ke Pengelolaan Kepahlawanan &amp; TMP
        </a>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800 mb-2">
                    SOP Resmi - Pemutakhiran Data PKJPK (K2KS)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Pemutakhiran Data Perintis &amp; Janda Perintis Kemerdekaan (PKJPK)</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Standar Operasional Prosedur Permohonan Data ke Kab/Kota, Penyusunan Instrumen Verval, Pelaksanaan Verval Lapangan/Berkas (1 Bulan), Input Rekapitulasi Data, hingga Pengarsipan Laporan.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pemberdayaan.kepahlawanan.create') }}" class="rounded-xl bg-amber-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-amber-700 transition">
                    + Buat Agenda Pemutakhiran Data
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Tahapan Alur Prosedur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">5 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-amber-600 mt-1 block">3 Aktor / Tim</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">1 Bulan + 2 Hari Kerja</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (5 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-600 text-white text-sm">🔄</span>
            Visual Diagram Alur Pemutakhiran Data PKJPK (5 Tahapan)
        </h2>

        <div class="relative border-l-2 border-amber-200 ml-4 sm:ml-6 space-y-6 pl-6 sm:pl-8 py-2">
            <!-- Step 1 & 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    1-2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Ketua Tim K2KS
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 3.5 Jam (210 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Surat Permohonan Kab/Kota &amp; Rancangan Instrumen Verval PKJPK</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Membuat surat resmi permohonan pemutakhiran data PKJPK ke Dinas Sosial Kab/Kota se-Sumatera Utara serta menyusun instrumen verifikasi dan validasi data.
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Pengolah Data
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 Bulan Kalender
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pelaksanaan Verifikasi &amp; Validasi Data Lapangan / Berkas</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Melakukan proses verifikasi dan validasi faktual data Perintis Kemerdekaan dan Janda/Duda Perintis Kemerdekaan di seluruh Kabupaten/Kota.
                    </p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Pengadministrasi Umum
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 8 Jam (480 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penginputan Data &amp; Penyusunan Rekap Laporan Verval PKJPK</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Menginput seluruh instrumen hasil verval ke dalam database SADA SOSIAL serta merekapitulasi laporan hasil pemutakhiran data PKJPK.
                    </p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pengadministrasi Umum
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 5 Jam (300 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pengarsipan Dokumen Laporan Pemutakhiran Data PKJPK</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pengarsipan resmi dokumen rekap laporan hasil verifikasi dan validasi data Perintis &amp; Janda Perintis Kemerdekaan secara manual dan digital.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; SLA SOP Pemutakhiran Data PKJPK</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 border-b border-slate-200">
                        <th class="p-3 font-bold text-center w-12 border-r border-slate-200">No</th>
                        <th class="p-3 font-bold border-r border-slate-200 min-w-[200px]">Uraian Prosedur</th>
                        <th class="p-3 font-bold border-r border-slate-200">Pelaksana</th>
                        <th class="p-3 font-bold border-r border-slate-200">Persyaratan / Perlengkapan</th>
                        <th class="p-3 font-bold text-center border-r border-slate-200 w-28">Waktu</th>
                        <th class="p-3 font-bold">Output</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Membuat surat permohonan pemutakhiran data PKJPK ke Dinsos Kab/Kota se-Sumut</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">Data Perintis dan Janda Perintis Kemerdekaan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Surat Permohonan Pemutakhiran Data PKJPK</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Menyusun rancangan instrumen verifikasi dan validasi data PKJPK</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">Kumpulan Peraturan, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">180 Menit (3 Jam)</td>
                        <td class="p-3">Instrumen Verifikasi &amp; Validasi Data PKJPK</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Melakukan verifikasi data Perintis Kemerdekaan dan Janda Perintis Kemerdekaan</td>
                        <td class="p-3 border-r border-slate-200">Pengolah Data</td>
                        <td class="p-3 border-r border-slate-200">Instrumen Verval, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Bulan</td>
                        <td class="p-3">Instrumen Hasil Verval Data PKJPK</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Menginput data hasil verifikasi data Perintis Kemerdekaan dan Janda Perintis Kemerdekaan</td>
                        <td class="p-3 border-r border-slate-200">Pengadministrasi Umum</td>
                        <td class="p-3 border-r border-slate-200">Instrumen Hasil Verval, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">480 Menit (8 Jam)</td>
                        <td class="p-3">Rekap Laporan Hasil Verval Data PKJPK</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mengarsipkan dokumen laporan pemutakhiran data PKJPK</td>
                        <td class="p-3 border-r border-slate-200">Pengadministrasi Umum</td>
                        <td class="p-3 border-r border-slate-200">Rekap Laporan Hasil Verval Data PKJPK</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">300 Menit (5 Jam)</td>
                        <td class="p-3">Arsip Laporan Hasil Verval Manual &amp; Digital</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-amber-50 font-bold text-amber-900 border-t-2 border-amber-300">
                        <td colspan="4" class="p-3 text-right uppercase tracking-wider border-r border-amber-200">Total Mutu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-amber-200">1 Bulan + 2 Hari Kerja</td>
                        <td class="p-3">Sesuai SOP Resmi Dinsos Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
