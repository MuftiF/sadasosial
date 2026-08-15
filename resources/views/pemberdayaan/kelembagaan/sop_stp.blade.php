@extends('layouts.app')

@section('title', 'SOP Penerbitan STP - SADA SOSIAL')

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
                    SOP Resmi - Penerbitan STP (Bidang Dayasos)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Penerbitan Surat Tanda Pendaftaran (STP) LKS</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Standar Operasional Prosedur registrasi pemohon, pemeriksaan kelengkapan dokumen pendirian LKS, peninjauan lapangan, pembuatan berita acara, verifikasi teknis, hingga pengesahan tanda daftar elektronik oleh Kepala Dinas.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pemberdayaan.kelembagaan.create') }}" class="rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-emerald-700 transition">
                    + Ajukan Usulan Pembinaan LKS
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Tahapan Alur Prosedur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">9 Langkah Prosedur</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Aktor Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">4 Pihak Utama</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">470 Menit (7.8 Jam)</span>
        </div>
    </div>

    <!-- Interactive Visual Flowchart Cards (9 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-600 text-white text-sm">📋</span>
            Visual Alur Proses Penerbitan STP LKS (9 Tahapan)
        </h2>

        <div class="relative border-l-2 border-emerald-200 ml-4 sm:ml-6 space-y-6 pl-6 sm:pl-8 py-2">
            
            <!-- Step 1 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    1
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pemohon (LKS/Organisasi)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 30 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Melakukan Registrasi Akun</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pemohon melakukan pendaftaran akun pada sistem SADA SOSIAL. 
                        <strong>Persyaratan:</strong> NIK, email, &amp; HP (Perseorangan); NPWP, email, &amp; HP pemohon (Non-Perseorangan).
                    </p>
                    <div class="text-[11px] text-emerald-705 font-bold mt-1">
                        ➡️ Output: Akun pemohon aktif dan siap digunakan untuk masuk sistem.
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pemohon (LKS/Organisasi)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 120 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Mengajukan Permohonan &amp; Unggah Dokumen Persyaratan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Pemohon mengisi formulir usulan izin tanda daftar dan mengunggah berkas persyaratan digital:
                    </p>
                    <ul class="list-disc pl-5 text-xs text-slate-505 space-y-1">
                        <li>Akta Notaris Pendirian LKS</li>
                        <li>Rekomendasi Dinas Sosial Kabupaten/Kota setempat</li>
                        <li>Pernyataan Sumber Dana</li>
                        <li>Surat Keterangan Domisili dari Lurah/Kepala Desa</li>
                        <li>Daftar Identitas Klien beserta Foto</li>
                        <li>Susunan Pengurus LKS/Orsos</li>
                        <li>Data Isian instrumen Orsos/LKS</li>
                    </ul>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Berkas permohonan masuk ke bagian Pengadministrasian Perizinan.
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pengadministrasi Perizinan (Sekretariat)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pemeriksaan Kelengkapan &amp; Kebenaran Administrasi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sekretariat memeriksa kecocokan berkas dengan standar regulasi yang berlaku.
                    </p>
                    <div class="p-3 bg-white rounded-xl border border-slate-200 text-xs">
                        <span class="font-bold text-amber-600 uppercase tracking-wide block mb-1">Decision Point:</span>
                        <ul class="list-none space-y-1 pl-1">
                            <li class="flex items-center gap-1.5"><span class="text-emerald-500">✔️ Ya:</span> Dokumen valid &amp; lengkap, lanjut ke pemeriksaan lapangan (jika perlu) atau verifikasi teknis.</li>
                            <li class="flex items-center gap-1.5"><span class="text-rose-500">❌ Tidak:</span> Dikembalikan kepada Pemohon untuk perbaikan berkas (kembali ke Tahap 2).</li>
                        </ul>
                    </div>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Berkas dinyatakan benar, lengkap, dan tervalidasi.
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pengolah Data (Bidang Teknis)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 180 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pemeriksaan Lapangan / Survei Fisik LKS (Bila Perlu)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Petugas teknis melakukan survei ke kantor LKS untuk memastikan kesesuaian fisik panti/lembaga dengan instrumen tinjauan lapangan.
                    </p>
                    <div class="p-3 bg-white rounded-xl border border-slate-200 text-xs">
                        <span class="font-bold text-slate-700 uppercase tracking-wide block mb-1">Decision Point:</span>
                        <ul class="list-none space-y-1 pl-1">
                            <li class="flex items-center gap-1.5"><span class="text-emerald-500">✔️ Ya:</span> Lapangan sesuai dengan data pengajuan, lanjut ke penyusunan berita acara.</li>
                            <li class="flex items-center gap-1.5"><span class="text-rose-500">❌ Tidak:</span> Keadaan nyata tidak sesuai, berkas dikembalikan/ditolak dengan catatan revisi.</li>
                        </ul>
                    </div>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Dokumen kesesuaian lapangan dan keadaan nyata dinyatakan sesuai.
                    </div>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pengolah Data (Bidang Teknis)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 30 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pembuatan Berita Acara Pemeriksaan &amp; Rekomendasi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Pengolah data menyusun Berita Acara Pemeriksaan Lapangan (BAP) serta memformulasi draf surat rekomendasi persetujuan atau penolakan penerbitan STP LKS.
                    </p>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Draf berita acara dan draf rekomendasi tanda daftar LKS selesai disusun.
                    </div>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    6
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pengolah Data (Bidang Teknis)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 15 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Verifikasi Draf Izin / Penolakan di Aplikasi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Verifikator bidang melakukan verifikasi final terhadap draf permohonan penerbitan izin/non-izin berbasis usulan tim teknis sebelum diteruskan ke pimpinan.
                    </p>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Dokumen izin digital dinyatakan terverifikasi dan siap ditandatangani.
                    </div>
                </div>
            </div>

            <!-- Step 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Dinas Sosial
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 15 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Persetujuan &amp; Tanda Tangan Elektronik (TTE)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Kepala Dinas Sosial meninjau berkas verifikasi dan memberikan persetujuan penerbitan atau penolakan dengan menyematkan Tanda Tangan Elektronik (TTE) tersertifikasi.
                    </p>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Terbitnya persetujuan elektronik / dokumen STP LKS dengan tanda tangan elektronik sah.
                    </div>
                </div>
            </div>

            <!-- Step 8 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    8
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pemohon (LKS/Organisasi)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 10 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pencetakan Dokumen Izin / Penolakan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Pemohon mengunduh lembar Surat Tanda Pendaftaran (STP) LKS berformat PDF yang telah dilengkapi dengan kode QR verifikasi dari sistem, lalu melakukan pencetakan fisik.
                    </p>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Dokumen Tanda Daftar LKS yang tercetak secara fisik oleh pemohon.
                    </div>
                </div>
            </div>

            <!-- Step 9 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    9
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pengadministrasi Perizinan (Sekretariat)
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 10 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pengarsipan Dokumen secara Elektronik</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Sekretariat melakukan pengarsipan data digital permohonan dan dokumen STP yang terbit ke dalam pangkalan data terpusat (cloud/harddisk/database SADA SOSIAL).
                    </p>
                    <div class="text-[11px] text-emerald-800 font-bold mt-1">
                        ➡️ Output: Salinan arsip dokumen STP tersimpan dan ter-backup di pangkalan data secara aman.
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; SLA SOP Penerbitan STP</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 border-b border-slate-200">
                        <th class="p-3 font-bold text-center w-12 border-r border-slate-200">No</th>
                        <th class="p-3 font-bold border-r border-slate-200 min-w-[220px]">Uraian Prosedur</th>
                        <th class="p-3 font-bold border-r border-slate-200">Pelaksana</th>
                        <th class="p-3 font-bold border-r border-slate-200">Persyaratan / Perlengkapan</th>
                        <th class="p-3 font-bold text-center border-r border-slate-200 w-28">Waktu</th>
                        <th class="p-3 font-bold">Output</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700 font-medium">
                    <!-- Row 1 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1</td>
                        <td class="p-3 border-r border-slate-200">Melakukan registrasi</td>
                        <td class="p-3 border-r border-slate-200">Pemohon</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">
                            Perseorangan: NIK, email, HP<br>
                            Non Perseorangan: NPWP, email, HP pemohon
                        </td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Akun pemohon untuk login</td>
                    </tr>
                    <!-- Row 2 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 border-r border-slate-200">Melakukan permohonan penerbitan izin yang diinginkan, dilengkapi dengan pengunggahan dokumen elektronik sesuai persyaratan</td>
                        <td class="p-3 border-r border-slate-200">Pemohon</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">
                            Akta Notaris, Rekom Dinsos Kab/Kota, Sumber Dana, Keterangan Domisili Lurah/Kades, Identitas Klien dengan foto, Susunan Pengurus, Data Isian LKS
                        </td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">120 Menit</td>
                        <td class="p-3">Berkas di bagian Pengadministrasian</td>
                    </tr>
                    <!-- Row 3 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 border-r border-slate-200">Melakukan pemeriksaan kelengkapan dan kebenaran dokumen persyaratan *(Ada keputusan Ya/Tidak)*</td>
                        <td class="p-3 border-r border-slate-200">Pengadministrasi Perizinan (Sekretariat)</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Data Pemohon, Data Badan Usaha / Organisasi, Dokumen persyaratan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Berkas dinyatakan benar dan lengkap</td>
                    </tr>
                    <!-- Row 4 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 border-r border-slate-200">Melakukan pemeriksaan lapangan (bila perlu) *(Ada keputusan Ya/Tidak)*</td>
                        <td class="p-3 border-r border-slate-200">Pengolah Data</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Instrumen tinjauan lapangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">180 Menit</td>
                        <td class="p-3">Dokumen dan keadaan nyata dinyatakan sesuai</td>
                    </tr>
                    <!-- Row 5 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 border-r border-slate-200">Membuat Berita Acara Pemeriksaan Lapangan / Rekomendasi Penerbitan / Penolakan Izin / Non Izin</td>
                        <td class="p-3 border-r border-slate-200">Pengolah Data</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Berita Acara Pemeriksaan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Rekomendasi penerbitan Tanda Daftar LKS</td>
                    </tr>
                    <!-- Row 6 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">6</td>
                        <td class="p-3 border-r border-slate-200">Memverifikasi penerbitan izin / non izin berdasarkan rekomendasi perangkat daerah teknis</td>
                        <td class="p-3 border-r border-slate-200">Pengolah Data</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Laptop / Komputer, Jaringan internet</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">15 Menit</td>
                        <td class="p-3">Dokumen terverifikasi</td>
                    </tr>
                    <!-- Row 7 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">7</td>
                        <td class="p-3 border-r border-slate-200">Memberikan persetujuan penerbitan / penolakan izin / non izin dengan pembubuhan tanda tangan elektronik *(Ada keputusan Ya/Tidak)*</td>
                        <td class="p-3 border-r border-slate-200">Kepala Dinas Sosial</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Laptop / Komputer, Jaringan internet</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">15 Menit</td>
                        <td class="p-3">Persetujuan elektronik / Tanda Tangan Elektronik</td>
                    </tr>
                    <!-- Row 8 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">8</td>
                        <td class="p-3 border-r border-slate-200">Mencetak Dokumen Izin / Non Izin yang telah diterbitkan</td>
                        <td class="p-3 border-r border-slate-200">Pemohon</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Printer</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10 Menit</td>
                        <td class="p-3">Dokumen Tanda Daftar LKS yang tercetak fisik</td>
                    </tr>
                    <!-- Row 9 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">9</td>
                        <td class="p-3 border-r border-slate-200">Pengarsipan dokumen izin / non izin yang diterbitkan secara elektronik</td>
                        <td class="p-3 border-r border-slate-200">Pengadministrasi Perizinan (Sekretariat)</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Database / cloud / harddisk</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10 Menit</td>
                        <td class="p-3">Dokumen Tanda Daftar LKS tersimpan / di back up via aplikasi</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-emerald-50 font-bold text-emerald-900 border-t-2 border-emerald-300">
                        <td colspan="4" class="p-3 text-right uppercase tracking-wider border-r border-emerald-200">Total Mutu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-emerald-200">470 Menit (7.8 Jam)</td>
                        <td class="p-3">Sesuai SOP Resmi Dinsos Pemprovsu</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
