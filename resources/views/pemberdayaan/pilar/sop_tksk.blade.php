@extends('layouts.app')

@section('title', 'SOP Pengusulan & Pergantian TKSK - SADA SOSIAL')

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
                    SOP Resmi No. 3 - Bidang Dayasos
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Pengusulan &amp; Pergantian TKSK</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Standar Operasional Prosedur Pengusulan Calon Tenaga Kesejahteraan Sosial Kecamatan (TKSK) serta Pergantian TKSK Kabupaten/Kota ke Kementerian Sosial.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pemberdayaan.pilar.create') }}" class="rounded-xl bg-teal-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-teal-700 transition">
                    + Ajukan Usulan TKSK
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Tahapan Alur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">8 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-teal-600 mt-1 block">5 Aktor / Jabatan</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">236 Hari Kerja</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (8 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-teal-600 text-white text-sm">📋</span>
            Visual Diagram Alur (Flowchart 8 Langkah)
        </h2>

        <div class="relative border-l-2 border-teal-200 ml-4 sm:ml-6 space-y-8 pl-6 sm:pl-8 py-2">
            <!-- Step 1 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    1
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Bagian Umum
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 5 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Surat Usulan TKSK Serta Pergantian TKSK Diterima</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                        Penerimaan berkas usulan TKSK / pergantian TKSK dari Dinas Sosial Kabupaten/Kota oleh Bagian Umum Dinas Sosial Provinsi.
                    </p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Administrasi Pemberdayaan Sosial
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 1 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pencatatan ke Buku Surat Masuk Bidang Dayasos</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                        Surat usulan dicatat secara administratif ke dalam Agenda Buku Surat Masuk Bidang Pemberdayaan Sosial untuk penomoran dan pengarsipan awal.
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 5 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Disposisi Kepala Bidang untuk Verifikasi &amp; Validasi</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                        Kepala Bidang Pemberdayaan Sosial mendisposisi surat kepada Staf Pengurus TKSK untuk ditindaklanjuti proses verifikasi dan validasi teknis.
                    </p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Staf Dayasos Pengurus TKSK
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 30 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Verifikasi &amp; Validasi Berkas Usulan</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                        Pemeriksaan kelengkapan berkas usulan calon TKSK. Jika lengkap diteruskan membuat draft Surat Rekomendasi TKSK. Apabila belum lengkap, diberitahukan ke Kabid dan diteruskan ke Dinsos Kabupaten/Kota untuk melengkapi dokumen.
                    </p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Staf Dayasos Pengurus TKSK
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 4 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pembuatan Draft Surat Rekomendasi ke Kementerian Sosial</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                        Penyusunan naskah/draft Surat Rekomendasi Usulan Calon TKSK yang akan dikirimkan kepada Direktur Pemberdayaan Sosial Kementerian Sosial RI.
                    </p>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    6
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            Kepala Dinas Sosial
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 5 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penandatanganan &amp; Pengesahan Rekomendasi Kadinas</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                        Kepala Dinas Sosial Provinsi menandatangani secara resmi berkas Surat Rekomendasi usulan calon TKSK dan dibubuhi stempel kedinasan.
                    </p>
                </div>
            </div>

            <!-- Step 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-teal-600 text-white font-bold text-xs ring-4 ring-white">
                    7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-teal-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-teal-700 bg-teal-50 px-2.5 py-1 rounded-md border border-teal-200">
                            PIC PSKS (Staf Dayasos)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 3 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pengentrian Data Usulan TKSK / Pergantian TKSK</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                        PIC PSKS menginput data usulan calon TKSK / pergantian TKSK ke dalam database SIM-PSKS / SADA SOSIAL &amp; sistem rujukan pusat Kemensos.
                    </p>
                </div>
            </div>

            <!-- Step 8 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    8
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Staf Dayasos &amp; Kemensos RI
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 183 Hari Kerja
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penerbitan Surat Keputusan (SK) dari Kementerian Sosial</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                        Menunggu verifikasi tingkat pusat, penetapan, dan pengiriman Surat Keputusan (SK) TKSK resmi dari Menteri Sosial RI.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; Pembagian Tugas Pelaksana</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 border-b border-slate-200">
                        <th class="p-3 font-bold text-center w-12 border-r border-slate-200">No</th>
                        <th class="p-3 font-bold border-r border-slate-200 min-w-[220px]">Kegiatan Workflow</th>
                        <th class="p-3 font-bold border-r border-slate-200">Pelaksana</th>
                        <th class="p-3 font-bold text-center border-r border-slate-200 w-28">Waktu (Hari)</th>
                        <th class="p-3 font-bold">Keterangan &amp; Output</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Surat usulan TKSK serta pergantian TKSK diterima</td>
                        <td class="p-3 border-r border-slate-200">Bagian Umum</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3">Surat masuk teregistrasi di tata usaha</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Surat usulan TKSK dan Pergantian TKSK dicatatkan kedalam Buku Surat Masuk Bidang Pemberdayaan Sosial</td>
                        <td class="p-3 border-r border-slate-200">Administrasi Pemberdayaan Sosial</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1</td>
                        <td class="p-3">Lembar disposisi &amp; registrasi bidang</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Kepala Bidang mendisposisi surat kepada staf yang mengurusi TKSK untuk diperifikasi dan Validasi</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3">Disposisi verifikasi teknis Kabid</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Staf yang mengurusi TKSK memeriksa Berkas usulan yang diterima...</td>
                        <td class="p-3 border-r border-slate-200">Staf Dayasos yang menangani TKSK</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30</td>
                        <td class="p-3">Hasil Verval berkas usulan TKSK</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Staf membuat surat rekomendasi ke Kementerian Sosial</td>
                        <td class="p-3 border-r border-slate-200">Staf Dayasos yang menangani TKSK</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3">Draft Surat Rekomendasi Gubernur/Kadinas</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">6</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Kepala Dinas menandatangani berkas rekomendasi usulan calon TKSK dan dibubuhi stempel</td>
                        <td class="p-3 border-r border-slate-200">Kepala Dinas Sosial</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3">Surat Rekomendasi Resmi bertanda tangan &amp; stempel</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">7</td>
                        <td class="p-3 font-semibold border-r border-slate-200">PIC PSKS Mengentri Data usulan TKSK dan Pergantian TKSK</td>
                        <td class="p-3 border-r border-slate-200">PIC PSKS (Staf Dayasos)</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3">Entry data SIM-PSKS &amp; SADA SOSIAL</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">8</td>
                        <td class="p-3 font-semibold border-r border-slate-200">Menunggu proses penerimaan dan turunnya SK dari Kementerian Sosial</td>
                        <td class="p-3 border-r border-slate-200">Staf Dayasos &amp; Kemensos</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">183</td>
                        <td class="p-3">SK TKSK Resmi dari Kemensos RI</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-teal-50 font-bold text-teal-900 border-t-2 border-teal-300">
                        <td colspan="3" class="p-3 text-right uppercase tracking-wider border-r border-teal-200">Total Waktu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-teal-200">236 Hari</td>
                        <td class="p-3">Sesuai SOP Resmi Dinas Sosial Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
