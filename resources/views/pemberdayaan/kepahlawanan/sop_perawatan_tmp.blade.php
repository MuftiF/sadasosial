@extends('layouts.app')

@section('title', 'SOP Perawatan Taman Makam Pahlawan (TMP) - SADA SOSIAL')

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
                    SOP Resmi - Perawatan &amp; Pemeliharaan TMP (Bidang Dayasos)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Perawatan Taman Makam Pahlawan (TMP)</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Standar Operasional Prosedur Penyusunan Jadwal, Distribusi Area Kerja, Pembersihan &amp; Pengecekan Fasilitas, Klasifikasi Kerusakan, Perbaikan Teknis/Kontraktor, Pengajuan Anggaran, hingga Pelaporan Periode Pemeliharaan.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pemberdayaan.kepahlawanan.create') }}" class="rounded-xl bg-amber-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-amber-700 transition">
                    + Ajukan Usulan Pemeliharaan TMP
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
            <span class="text-2xl font-black text-amber-600 mt-1 block">5 Aktor / Tim</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">10 - 12 Hari Kerja</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (14 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-600 text-white text-sm">🏛️</span>
            Visual Diagram Alur Perawatan Taman Makam Pahlawan (14 Tahapan)
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
                            Koordinator TMP
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 Hari + 30 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penyusunan Jadwal &amp; Distribusi Area Kerja Petugas TMP</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Menyusun jadwal pemeliharaan harian/mingguan/bulanan dan menugaskan area kerja lapangan kepada petugas TMP.
                    </p>
                </div>
            </div>

            <!-- Step 3, 4, 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    3-5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Petugas TMP
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 3 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pembersihan Makam &amp; Pengecekan Fasilitas TMP (Jalan, Drainase, Pagar, Lampu)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pembersihan rumput/nisan/taman, dilanjutkan pengecekan fisik seluruh fasilitas jalan, drainase, pagar, lampu, tiang bendera, serta deteksi kondisi kerusakan.
                    </p>
                </div>
            </div>

            <!-- Step 6, 7, 8 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    6-8
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Petugas TMP &amp; Koordinator TMP
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 2 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pencatatan Logbook Harian / Klasifikasi Kerusakan &amp; Perbaikan Ringan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Jika kondisi baik dicatat dalam buku log harian. Jika ada kerusakan, diklasifikasikan (ringan vs berat). Kerusakan ringan (nisan miring, rumput rusak) langsung diperbaiki di tempat oleh petugas.
                    </p>
                </div>
            </div>

            <!-- Step 9, 10, 11, 12 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white font-bold text-xs ring-4 ring-white">
                    9-12
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                            Bidang Dayasos, Kadinsos &amp; Tim Teknis / Kontraktor
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 3 Hari + 30 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Laporan Kerusakan Berat ➔ Inspeksi Dayasos ➔ Pengajuan Anggaran ➔ Perbaikan Kontraktor</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Kerusakan berat dilaporkan ke Dinsos Prov. Staf Dayasos melakukan inspeksi lapangan, pengajuan usul anggaran/perbaikan ke Kadinsos, serta perbaikan fisik oleh kontraktor/tim teknis.
                    </p>
                </div>
            </div>

            <!-- Step 13 & 14 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    13-14
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Koordinator TMP &amp; Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 2 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Laporan Pemeliharaan Periodik &amp; Penyelesaian Periode Pemeliharaan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Penyusunan laporan mingguan/bulanan TMP kepada Kepala Bidang Dayasos, serta pengesahan proses pemeliharaan periode berjalan selesai dan terarsip.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; SLA SOP Perawatan Taman Makam Pahlawan</h2>
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
                        <td class="p-3 font-semibold border-r border-slate-200">Penyusunan jadwal pemeliharaan harian/mingguan/bulanan</td>
                        <td class="p-3 border-r border-slate-200">Koordinator TMP</td>
                        <td class="p-3 border-r border-slate-200">Form Penyusunan Jadwal &amp; Petugas</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Form Jadwal Pemeliharaan Terbuat</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Distribusi area kerja kepada petugas lapangan</td>
                        <td class="p-3 border-r border-slate-200">Koordinator TMP</td>
                        <td class="p-3 border-r border-slate-200">Surat Perintah</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Daftar Nama Petugas Ditunjuk</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Pembersihan area makam, nisan, rumput, taman</td>
                        <td class="p-3 border-r border-slate-200">Petugas TMP</td>
                        <td class="p-3 border-r border-slate-200">Aktivitas Pembersihan Lapangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Form Aktivitas Petugas Kebersihan</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Cek jalan, drainase, pagar, lampu, tiang bendera</td>
                        <td class="p-3 border-r border-slate-200">Petugas TMP</td>
                        <td class="p-3 border-r border-slate-200">Pengecekan Fasilitas TMP</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Form Aktivitas Pengecekan Fasilitas</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Apakah ditemukan kerusakan? *(Keputusan Ya/Tidak)*</td>
                        <td class="p-3 border-r border-slate-200">Petugas TMP</td>
                        <td class="p-3 border-r border-slate-200">Pengecekan Seluruh Fasilitas TMP</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Laporan Kerusakan TMP</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">6</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Catat kondisi baik pada buku log harian *(Jika Tidak)*</td>
                        <td class="p-3 border-r border-slate-200">Petugas TMP</td>
                        <td class="p-3 border-r border-slate-200">Buku Log Harian TMP</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Laporan Buku Log Harian</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">7</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Klasifikasi kerusakan ringan atau berat *(Jika Ya)*</td>
                        <td class="p-3 border-r border-slate-200">Koordinator TMP</td>
                        <td class="p-3 border-r border-slate-200">Laporan Kerusakan Lapangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Laporan Klasifikasi Kerusakan (Ringan/Berat)</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">8</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Perbaikan langsung (nisan miring, rumput rusak) *(Kerusakan Ringan)*</td>
                        <td class="p-3 border-r border-slate-200">Petugas TMP</td>
                        <td class="p-3 border-r border-slate-200">Perbaikan Fisik Ringan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Hasil Perbaikan Ringan Selesai</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">9</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Laporan ke Bidang Kepahlawanan Dinsos *(Kerusakan Berat)*</td>
                        <td class="p-3 border-r border-slate-200">Koordinator TMP</td>
                        <td class="p-3 border-r border-slate-200">Laporan Kerusakan Berat TMP</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Laporan ke Bidang Dayasos Dinsos Prov</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Pemeriksaan oleh pihak Dinsos Provinsi</td>
                        <td class="p-3 border-r border-slate-200">Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200">Staf Dayasos Inspeksi Fasilitas TMP</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Laporan Pemeriksaan Fasilitas TMP</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">11</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Pengajuan kebutuhan anggaran/perbaikan</td>
                        <td class="p-3 border-r border-slate-200">Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200">Usulan Kebutuhan ke Kepala Dinas</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Laporan Usul Anggaran / Perbaikan ke Kadinsos</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">12</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Perbaikan oleh tim teknis/kontraktor</td>
                        <td class="p-3 border-r border-slate-200">Tim Teknis / Kontraktor</td>
                        <td class="p-3 border-r border-slate-200">Perintah Pekerjaan Perbaikan Kontraktor</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Pekerjaan Perbaikan Fisik Kontraktor Selesai</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">13</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Penyusunan laporan mingguan/bulanan</td>
                        <td class="p-3 border-r border-slate-200">Koordinator TMP</td>
                        <td class="p-3 border-r border-slate-200">Form Laporan Mingguan/Bulanan TMP</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Laporan Mingguan/Bulanan ke Kabid</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">14</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Proses pemeliharaan periode berjalan selesai</td>
                        <td class="p-3 border-r border-slate-200">Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200">Proses Pemeliharaan TMP</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1 Hari Kerja</td>
                        <td class="p-3">Laporan Pemeliharaan TMP Selesai &amp; Terarsip</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-amber-50 font-bold text-amber-900 border-t-2 border-amber-300">
                        <td colspan="4" class="p-3 text-right uppercase tracking-wider border-r border-amber-200">Total Mutu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-amber-200">10 - 12 Hari Kerja</td>
                        <td class="p-3">Sesuai SOP Resmi Dinsos Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
