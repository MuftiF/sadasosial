@extends('layouts.app')

@section('title', 'SOP Bantuan BK3S - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!-- Top Breadcrumb & Header -->
    <div class="mb-8">
        <a href="{{ route('pemberdayaan.kelembagaan.index') }}" class="inline-flex items-center text-xs font-bold text-emerald-600 hover:underline gap-1 mb-3">
            &larr; Kembali ke Pembinaan Kelembagaan &amp; Organisasi Sosial
        </a>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 mb-2">
                    SOP Resmi - Bantuan BK3S (Bidang Dayasos)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Bantuan Badan Koordinasi Kegiatan Kesejahteraan Sosial (BK3S)</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Standar Operasional Prosedur Pengumpulan Data Penerima Bantuan dari Kab/Kota, Rekapitulasi &amp; Input Data, Verifikasi Kabid Dayasos, Rekomendasi Kadinsos, Penerusan Berkas ke BK3S, hingga Penyaluran Bantuan Tepat Sasaran.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pemberdayaan.kelembagaan.create') }}" class="rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-emerald-700 transition">
                    + Ajukan Usulan Bantuan BK3S
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Tahapan Alur Prosedur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">9 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">5 Aktor / Instansi</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">16 Hari Kerja</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (9 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-600 text-white text-sm">🏢</span>
            Visual Diagram Alur Bantuan BK3S (9 Tahapan)
        </h2>

        <div class="relative border-l-2 border-emerald-200 ml-4 sm:ml-6 space-y-6 pl-6 sm:pl-8 py-2">
            <!-- Step 1, 2, 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    1-3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Dinsos Kab/Kota &amp; Pengolah Data
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 7 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pengumpulan, Rekapitulasi &amp; Penginputan Data Calon Penerima Bansos</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pengumpulan data penerima bantuan sosial dari Dinsos Kab/Kota, rekapitulasi data calon penerima bansos, serta penginputan data calon ke dalam sistem.
                    </p>
                </div>
            </div>

            <!-- Step 4 & 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    4-5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kabid Dayasos &amp; Kepala Dinas Sosial
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 4 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Verifikasi Kelayakan Berkas LKS &amp; Rekomendasi Kadinsos Provinsi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pemeriksaan berkas pendirian LKS &amp; kelayakan calon penerima oleh Kabid Dayasos, dilanjutkan penerbitan Surat Rekomendasi Resmi Kepala Dinas Sosial Provinsi kepada Dinsos Kab/Kota.
                    </p>
                </div>
            </div>

            <!-- Step 6 & 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    6-7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Dinsos Kab/Kota &amp; Pengolah Data
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 4 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Persiapan Dokumen Penerima &amp; Pengiriman Berkas Lengkap Kab/Kota</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Dinsos Kab/Kota menyiapkan dokumen final data penerima bansos dan mengirimkan berkas data lengkap yang terverifikasi ke Dinas Sosial Provinsi.
                    </p>
                </div>
            </div>

            <!-- Step 8 & 9 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    8-9
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            BK3S &amp; Dinsos Kab/Kota
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 1 Hari + 5 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penerusan Berkas ke BK3S &amp; Penyaluran Bantuan Sosial Tepat Sasaran</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Berkas data diteruskan ke pengurus BK3S untuk pelaksanaan penyaluran bantuan sosial kepada penerima manfaat secara tepat sasaran.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; SLA SOP Bantuan BK3S</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 border-b border-slate-200">
                        <th class="p-3 font-bold text-center w-12 border-r border-slate-200">No</th>
                        <th class="p-3 font-bold border-r border-slate-200 min-w-[200px]">Kegiatan</th>
                        <th class="p-3 font-bold border-r border-slate-200">Pelaksana</th>
                        <th class="p-3 font-bold border-r border-slate-200">Kelengkapan</th>
                        <th class="p-3 font-bold text-center border-r border-slate-200 w-28">Waktu</th>
                        <th class="p-3 font-bold">Output</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Pengumpulan Data Penerima Bantuan dari Kabupaten/Kota</td>
                        <td class="p-3 border-r border-slate-200">Dinsos Kab/Kota</td>
                        <td class="p-3 border-r border-slate-200">Berkas Data Penerima</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3 Hari Kerja</td>
                        <td class="p-3">Diterimanya Data Sesuai Persyaratan</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Rekapitulasi Data Calon Penerima Bansos</td>
                        <td class="p-3 border-r border-slate-200">Pengolah Data</td>
                        <td class="p-3 border-r border-slate-200">Berkas Pengajuan Sesuai Syarat</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2 Hari Kerja</td>
                        <td class="p-3">Tersedianya Data Calon Penerima Bansos</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penginputan Data Calon Penerima Bansos</td>
                        <td class="p-3 border-r border-slate-200">Pengolah Data</td>
                        <td class="p-3 border-r border-slate-200">Dokumen Sesuai Persyaratan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2 Hari Kerja</td>
                        <td class="p-3">Daftar Calon Penerima Bansos Terinput</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Hasil Verifikasi Data Calon Penerima Bansos *(Keputusan Ya/Tidak)*</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200">Berkas Pendirian LKS &amp; Syarat Penerima Bansos</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2 Hari Kerja</td>
                        <td class="p-3">Daftar Penerima Memenuhi Syarat Bansos</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Rekomendasi Calon Penerima Bansos *(Keputusan Ya/Tidak)*</td>
                        <td class="p-3 border-r border-slate-200">Kepala Dinas Sosial</td>
                        <td class="p-3 border-r border-slate-200">Berkas Lengkap Terverifikasi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2 Hari Kerja</td>
                        <td class="p-3">Menyurati Kab/Kota Persiapan Data Penerima</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">6</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Kabupaten/Kota Mempersiapkan Data Penerima Bansos</td>
                        <td class="p-3 border-r border-slate-200">Dinsos Kab/Kota</td>
                        <td class="p-3 border-r border-slate-200">Dokumen Data Penerima Bansos</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3 Hari Kerja</td>
                        <td class="p-3">Dokumen Data Penerima Bansos Lengkap</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">7</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Kabupaten/Kota Mengirim Data Penerima Bansos</td>
                        <td class="p-3 border-r border-slate-200">Pengolah Data</td>
                        <td class="p-3 border-r border-slate-200">Berkas Lengkap dari Kab/Kota</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Berkas Lengkap Diterima Provinsi</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">8</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Data diteruskan ke BK3S untuk penyaluran Bantuan</td>
                        <td class="p-3 border-r border-slate-200">BK3S</td>
                        <td class="p-3 border-r border-slate-200">Berkas Terkirim Resmi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5 Menit</td>
                        <td class="p-3">Berkas Penyaluran BK3S Selesai</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">9</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penyaluran Bantuan</td>
                        <td class="p-3 border-r border-slate-200">Dinsos Kab/Kota &amp; BK3S</td>
                        <td class="p-3 border-r border-slate-200">Penyaluran Bantuan Sosial BK3S</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Bantuan Sosial BK3S Tepat Sasaran</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-emerald-50 font-bold text-emerald-900 border-t-2 border-emerald-300">
                        <td colspan="4" class="p-3 text-right uppercase tracking-wider border-r border-emerald-200">Total Mutu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-emerald-200">16 Hari Kerja</td>
                        <td class="p-3">Sesuai SOP Resmi Dinsos Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
