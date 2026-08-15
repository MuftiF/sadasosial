@extends('layouts.app')

@section('title', 'SOP Sidang Tim Peneliti dan Pengkaji Gelar Daerah (TP2GD) - SADA SOSIAL')

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
                    SOP Resmi - Sidang TP2GD (Bidang Dayasos K2KS)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Sidang Tim Peneliti &amp; Pengkaji Gelar Daerah</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Standar Operasional Prosedur Penelaahan DPA/ROK, SK Gubernur Pembentukan TP2GD, SK Kadinsos Moderator, Rapat Persiapan, Distribusi Berkas, Sidang TP2GD, Berita Acara &amp; Pengarsipan.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pemberdayaan.kepahlawanan.create') }}" class="rounded-xl bg-amber-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-amber-700 transition">
                    + Ajukan Usulan Agenda TP2GD
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Tahapan Alur Prosedur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">13 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-amber-600 mt-1 block">5 Aktor / Tim</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">7 - 10 Hari Kerja</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (13 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-600 text-white text-sm">⚖️</span>
            Visual Diagram Alur Sidang TP2GD (13 Tahapan)
        </h2>

        <div class="relative border-l-2 border-amber-200 ml-4 sm:ml-6 space-y-6 pl-6 sm:pl-8 py-2">
            <!-- Step 1, 2, 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    1-3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Ketua Tim K2KS &amp; Kabid Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 4 Jam (240 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penelaahan DPA &amp; ROK + Konsultasi Kuasa Pengguna Anggaran</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Mempelajari DPA &amp; ROK kegiatan Sidang TP2GD serta berkonsultasi dengan Kepala Bidang Pemberdayaan Sosial selaku Kuasa Pengguna Anggaran.
                    </p>
                </div>
            </div>

            <!-- Step 4 & 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    4-5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Ketua Tim K2KS &amp; Gubernur Sumut
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 - 3 Hari + 3 Jam
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penyusunan Draf &amp; Penandatanganan SK Gubernur Pembentukan TP2GD</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pembuatan draf dan pengesahan Keputusan Gubernur Provinsi Sumatera Utara tentang Tim Peneliti dan Pengkaji Gelar Daerah (TP2GD).
                    </p>
                </div>
            </div>

            <!-- Step 6 & 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    6-7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Ketua Tim K2KS &amp; Kadinsos Prov
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 Hari + 3 Jam
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penyusunan &amp; TTD SK Kadinsos Narasumber &amp; Moderator Sidang</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Penyusunan draf dan penandatanganan Keputusan Kepala Dinas Sosial Provinsi tentang Narasumber &amp; Moderator Sidang TP2GD.
                    </p>
                </div>
            </div>

            <!-- Step 8 & 9 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    8-9
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Kabid Dayasos &amp; Ketua Tim K2KS
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 11 Jam (660 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Rapat Persiapan &amp; Persuratan Administrasi Persiapan Sidang</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pelaksanaan rapat teknis persiapan Sidang TP2GD serta penyiapan seluruh dokumen dan persuratan resmi pelaksanaan sidang.
                    </p>
                </div>
            </div>

            <!-- Step 10 & 11 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    10-11
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Tim K2KS &amp; Anggota TP2GD
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 12 Jam (720 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Distribusi Berkas CPN &amp; Pelaksanaan Sidang TP2GD</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Mengantarkan berkas lengkap CPN kepada seluruh anggota TP2GD dan melaksanakan Sidang TP2GD pembahasan usulan gelar pahlawan.
                    </p>
                </div>
            </div>

            <!-- Step 12 & 13 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    12-13
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Ketua Tim K2KS
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 8 Jam (480 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penyusunan Berita Acara, Notulen &amp; Pengarsipan Dokumen Sidang</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Membuat Berita Acara dan Notulen Resmi Sidang TP2GD serta melakukan pengarsipan dokumen fisik (manual) dan digital.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; SLA SOP Sidang TP2GD</h2>
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
                        <td class="p-3 font-semibold border-r border-slate-200">Mempelajari &amp; memahami DPA Dinas Sosial Provinsi</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">Dokumen DPA Dinsos Prov</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit (1 Jam)</td>
                        <td class="p-3">Dokumen DPA Terpahami</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mempelajari Rencana Operasional Kegiatan (ROK) Sidang TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">ROK Sidang TP2GD</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit (1 Jam)</td>
                        <td class="p-3">Disposisi &amp; Petunjuk Dokumen CPN</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Konsultasi dengan Kabid Pemberdayaan Sosial (Kuasa Pengguna Anggaran)</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS &amp; Kabid</td>
                        <td class="p-3 border-r border-slate-200">DPA, ROK, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">120 Menit (2 Jam)</td>
                        <td class="p-3">Disposisi &amp; Petunjuk Pimpinan</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Membuat Keputusan Gubernur tentang TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">DPA, ROK, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">180 Menit (3 Jam)</td>
                        <td class="p-3">Draf Keputusan Gubernur tentang TP2GD</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penandatanganan Keputusan Gubernur tentang TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Gubernur Sumut</td>
                        <td class="p-3 border-r border-slate-200">Draf Keputusan Gubernur</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 - 3 Hari Kerja</td>
                        <td class="p-3">Keputusan Gubernur Resmi TTD</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">6</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Membuat Keputusan Kadinsos tentang Narasumber &amp; Moderator Sidang TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">DPA, ROK, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">180 Menit (3 Jam)</td>
                        <td class="p-3">Draf Keputusan Kadinsos Moderator</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">7</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penandatanganan Keputusan Kadinsos tentang Narasumber &amp; Moderator</td>
                        <td class="p-3 border-r border-slate-200">Kadinsos Prov</td>
                        <td class="p-3 border-r border-slate-200">Draf Keputusan Kadinsos</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Keputusan Kadinsos Resmi TTD</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">8</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Melaksanakan rapat persiapan Sidang TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Kabid Dayasos</td>
                        <td class="p-3 border-r border-slate-200">DPA, ROK, Data CPN, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">180 Menit (3 Jam)</td>
                        <td class="p-3">Notulen Rapat Persiapan Sidang TP2GD</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">9</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Menyiapkan administrasi surat menyurat persiapan Sidang TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">DPA, ROK, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">480 Menit (8 Jam)</td>
                        <td class="p-3">Surat Menyurat Persiapan Sidang TP2GD</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mengantar berkas dokumen CPN ke masing-masing anggota TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS &amp; TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Berkas Administrasi CPN</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">480 Menit (8 Jam)</td>
                        <td class="p-3">Berkas CPN Diterima Anggota TP2GD</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">11</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Pelaksanaan Sidang Tim Peneliti dan Pengkaji Gelar Daerah (TP2GD)</td>
                        <td class="p-3 border-r border-slate-200">TP2GD</td>
                        <td class="p-3 border-r border-slate-200">DPA, ROK, Berkas CPN, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">240 Menit (4 Jam)</td>
                        <td class="p-3">Hasil Sidang TP2GD Pembahasan Gelar</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">12</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Membuat berita acara dan notulen hasil Sidang TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">Hasil Sidang TP2GD</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">180 Menit (3 Jam)</td>
                        <td class="p-3">Berita Acara &amp; Notulen Hasil Sidang</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">13</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mengarsipkan dokumen Sidang TP2GD</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">Dokumen Sidang TP2GD Lengkap</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">300 Menit (5 Jam)</td>
                        <td class="p-3">Arsip Dokumen Sidang Manual &amp; Digital</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-amber-50 font-bold text-amber-900 border-t-2 border-amber-300">
                        <td colspan="4" class="p-3 text-right uppercase tracking-wider border-r border-amber-200">Total Mutu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-amber-200">7 - 10 Hari Kerja</td>
                        <td class="p-3">Sesuai SOP Resmi Dinsos Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
