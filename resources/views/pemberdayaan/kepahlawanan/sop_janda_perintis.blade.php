@extends('layouts.app')

@section('title', 'SOP Pengusulan Calon Janda / Duda Perintis Kemerdekaan - SADA SOSIAL')

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
                    SOP Resmi - Pengusulan Janda / Duda Perintis Kemerdekaan (K2KS)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Pengusulan Calon Janda / Duda Perintis Kemerdekaan</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Standar Operasional Prosedur Penerimaan Limpahan Usulan Janda/Duda Perintis, Verifikasi Surat Kematian, Kajian Dokumen, Rekomendasi Kadinsos, hingga Pengiriman Berkas ke Menteri Sosial RI.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pemberdayaan.kepahlawanan.create') }}" class="rounded-xl bg-amber-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-amber-700 transition">
                    + Ajukan Usulan Janda/Duda Perintis
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Tahapan Alur Prosedur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">6 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-amber-600 mt-1 block">3 Aktor / Tim</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">3 - 6 Hari Kerja</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (6 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-600 text-white text-sm">📇</span>
            Visual Diagram Alur Pengusulan Calon Janda / Duda Perintis Kemerdekaan (6 Tahapan)
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
                            Ketua Tim K2KS &amp; Analis Kebijakan Ahli Muda
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 8.5 Jam (510 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penerimaan Usulan Limpahan &amp; Kajian Surat Kematian / Berkas Usulan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Menerima usulan limpahan Janda/Duda Perintis Kemerdekaan dari Instansi Kab/Kota (disertai Surat Keterangan Kematian Perintis dari instansi berwenang) serta meneliti kelengkapan dokumen persyaratan.
                    </p>
                </div>
            </div>

            <!-- Step 3 & 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    3-4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Ketua Tim K2KS &amp; Kepala Dinas Sosial
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 4 Jam (240 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penyusunan Draf &amp; Penandatanganan Rekomendasi Kadinsos Provinsi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Menyiapkan rekomendasi/keterangan kebenaran dokumen limpahan Janda/Duda Perintis Kemerdekaan, dilanjutkan persetujuan &amp; penandatanganan Surat Rekomendasi Resmi Kadinsos.
                    </p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Ketua Tim K2KS
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 - 3 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pengiriman Usulan Permohonan ke Menteri Sosial RI</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Mengirimkan dokumen usulan permohonan limpahan Janda/Duda Perintis Kemerdekaan yang telah disahkan ke Kementerian Sosial RI di Jakarta.
                    </p>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    6
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Ketua Tim K2KS
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 5 Jam (300 Menit)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pengarsipan Dokumen Usulan Janda / Duda Perintis Kemerdekaan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pengarsipan resmi seluruh berkas dokumen usulan Janda/Duda Perintis Kemerdekaan secara manual (berkas fisik) dan digital pada database SADA SOSIAL.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; SLA SOP Janda / Duda Perintis Kemerdekaan</h2>
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
                        <td class="p-3 font-semibold border-r border-slate-200">Menerima usulan permohonan limpahan Janda/Duda Perintis Kemerdekaan dari Instansi Kab/Kota</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">Disposisi Surat Usulan &amp; Surat Kematian Perintis</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Disposisi Surat Usulan Janda/Duda Perintis</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mempelajari, meneliti dan mengkaji kelengkapan dokumen usulan limpahan Janda/Duda Perintis</td>
                        <td class="p-3 border-r border-slate-200">Analis Kebijakan Ahli Muda</td>
                        <td class="p-3 border-r border-slate-200">Kumpulan Peraturan, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">480 Menit (8 Jam)</td>
                        <td class="p-3">Disposisi/ Petunjuk Dokumen Usulan Janda/Duda Perintis</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Menyiapkan rekomendasi/keterangan kebenaran dokumen limpahan Janda/Duda Perintis</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">Dokumen Usulan Janda/Duda Perintis, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">120 Menit (2 Jam)</td>
                        <td class="p-3">Draf Rekomendasi Kadinsos Prov Sumut</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Rekomendasi Kepala Dinas Sosial Provinsi Sumatera Utara</td>
                        <td class="p-3 border-r border-slate-200">Kepala Dinas Sosial</td>
                        <td class="p-3 border-r border-slate-200">Draf Rekomendasi Kadinsos, Agenda, Laptop</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">120 Menit (2 Jam)</td>
                        <td class="p-3">Surat Rekomendasi Resmi Kadinsos TTD</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mengirimkan usulan permohonan Janda/Duda Perintis Kemerdekaan kepada Menteri Sosial RI</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">Dokumen Usulan Lengkap &amp; Rekomendasi Kadinsos</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 - 3 Hari Kerja</td>
                        <td class="p-3">Dokumen Usulan Janda/Duda Terkirim ke Kemensos</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">6</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Mengarsipkan dokumen usulan Janda/Duda Perintis Kemerdekaan</td>
                        <td class="p-3 border-r border-slate-200">Ketua Tim K2KS</td>
                        <td class="p-3 border-r border-slate-200">Dokumen Usulan Janda/Duda Perintis</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">300 Menit (5 Jam)</td>
                        <td class="p-3">Arsip Dokumen Janda/Duda Perintis Manual &amp; Digital</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-amber-50 font-bold text-amber-900 border-t-2 border-amber-300">
                        <td colspan="4" class="p-3 text-right uppercase tracking-wider border-r border-amber-200">Total Mutu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-amber-200">3 - 6 Hari Kerja</td>
                        <td class="p-3">Sesuai SOP Resmi Dinsos Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
