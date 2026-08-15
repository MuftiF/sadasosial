@extends('layouts.app')

@section('title', 'SOP Rekomendasi PUB - SADA SOSIAL')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('perizinan.create') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-3">
            &larr; Kembali ke Pilihan Layanan
        </a>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 mb-2">
                    SOP Resmi - Rekomendasi PUB (Bidang Dayasos)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Penerbitan Rekomendasi PUB</h1>
                <p class="text-sm text-slate-500 mt-1">
                    Panduan alur resmi penerbitan Surat Rekomendasi Pengumpulan Uang dan Barang (PUB) berdasarkan kelaikan administrasi dan peninjauan lapangan.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('perizinan.form', 'pub') }}" class="rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-emerald-700 transition">
                    + Ajukan Izin / Rekomendasi PUB
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

    <!-- Visual Flowchart Cards (9 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-600 text-white text-sm">📋</span>
            Visual Diagram Alur Rekomendasi PUB (9 Tahapan)
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
                    <h3 class="text-base font-bold text-slate-900">Melakukan Registrasi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Pemohon mendaftar akun di aplikasi SADA SOSIAL.
                        <br><strong>Persyaratan:</strong> NIK, email, HP (Perseorangan); NPWP, email, HP pemohon (Non-Perseorangan).
                    </p>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Akun pemohon siap digunakan untuk login.
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
                    <h3 class="text-base font-bold text-slate-900">Melakukan Permohonan &amp; Unggah Berkas Persyaratan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Pemohon melengkapi isian permohonan dan mengunggah dokumen digital persyaratan berikut:
                    </p>
                    <ul class="list-disc pl-5 text-xs text-slate-505 space-y-1">
                        <li>Akta Notaris Pendirian</li>
                        <li>SK Kemenkumham Pengesahan Yayasan/Lembaga</li>
                        <li>Surat Domisili Yayasan</li>
                        <li>Surat Tanda Pendaftaran LKS (STP/STPU)</li>
                        <li>Surat Keterangan Catatan Kepolisian (SKCK) Pengurus / Keterangan Baik</li>
                        <li>Surat Pernyataan Keabsahan Dokumen</li>
                        <li>Surat Pernyataan bermaterai bahwa hasil PUB tidak disalurkan untuk kegiatan radikalisme, terorisme, dan kegiatan bertentangan dengan hukum</li>
                        <li>Rekomendasi Dinas Sosial Kabupaten/Kota setempat</li>
                    </ul>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Berkas terupload di aplikasi dan diterima sistem.
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
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Sekretariat memeriksa kecocokan berkas dengan regulasi/persyaratan yang ada.
                    </p>
                    <div class="p-3 bg-white rounded-xl border border-slate-200 text-xs">
                        <span class="font-bold text-amber-600 uppercase tracking-wide block mb-1">Decision Point:</span>
                        <ul class="list-none space-y-1 pl-1">
                            <li class="flex items-center gap-1.5"><span class="text-emerald-500">✔️ Ya:</span> Dokumen valid &amp; lengkap, lanjut ke pemeriksaan lapangan (jika perlu).</li>
                            <li class="flex items-center gap-1.5"><span class="text-rose-500">❌ Tidak:</span> Dikembalikan kepada Pemohon untuk perbaikan berkas (kembali ke Tahap 2).</li>
                        </ul>
                    </div>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Berkas dinyatakan benar, lengkap, dan siap diproses lebih lanjut.
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
                    <h3 class="text-base font-bold text-slate-900">Pemeriksaan Lapangan / Survei Kelayakan (Bila Perlu)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Petugas melakukan peninjauan lokasi lapangan untuk memastikan validitas dan kesesuaian lembaga penyelenggara dengan data instrumen tinjauan.
                    </p>
                    <div class="p-3 bg-white rounded-xl border border-slate-200 text-xs">
                        <span class="font-bold text-slate-700 uppercase tracking-wide block mb-1">Decision Point:</span>
                        <ul class="list-none space-y-1 pl-1">
                            <li class="flex items-center gap-1.5"><span class="text-emerald-500">✔️ Ya:</span> Lapangan sesuai dengan berkas, lanjut ke pembuatan berita acara.</li>
                            <li class="flex items-center gap-1.5"><span class="text-rose-500">❌ Tidak:</span> Dinyatakan tidak sesuai, dikembalikan/ditolak dengan catatan revisi.</li>
                        </ul>
                    </div>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Dokumen dan keadaan nyata dinyatakan sesuai.
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
                    <h3 class="text-base font-bold text-slate-900">Pembuatan Berita Acara &amp; Rekomendasi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Menyusun Berita Acara Pemeriksaan (BAP) Lapangan serta memformulasikan draf rekomendasi persetujuan atau penolakan penerbitan rekomendasi PUB.
                    </p>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Terbitnya rekomendasi penerbitan izin.
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
                    <h3 class="text-base font-bold text-slate-900">Verifikasi Izin / Penolakan di Sistem</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Melakukan verifikasi berkas izin digital di sistem berdasarkan rekomendasi teknis yang diajukan oleh tim pemeriksa sebelum diajukan ke Kepala Bidang.
                    </p>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Berkas izin terverifikasi di aplikasi.
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
                            Kepala Bidang Pemberdayaan Sosial
                        </span>
                        <span class="text-xs font-semibold text-emerald-700 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 15 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Persetujuan &amp; Tanda Tangan Elektronik (TTE) Kabid</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Kepala Bidang Dayasos melakukan pemeriksaan akhir dan menandatangani rekomendasi perizinan PUB menggunakan tanda tangan elektronik (TTE) resmi.
                    </p>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Persetujuan elektronik / Tanda Tangan Elektronik tersemat di surat rekomendasi.
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
                    <h3 class="text-base font-bold text-slate-900">Pencetakan Surat Rekomendasi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Pemohon dapat langsung mengunduh file Surat Rekomendasi PUB resmi berformat PDF yang memiliki kode verifikasi digital, lalu mencetaknya secara mandiri.
                    </p>
                    <div class="text-[11px] text-emerald-750 font-bold mt-1">
                        ➡️ Output: Lembar fisik Surat Rekomendasi PUB tercetak.
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
                        Sekretariat mencatat dan mengarsipkan dokumen rekomendasi yang diterbitkan secara elektronik di database pangkalan data SADA SOSIAL.
                    </p>
                    <div class="text-[11px] text-emerald-800 font-bold mt-1">
                        ➡️ Output: Dokumen rekomendasi tersimpan dan di-backup secara digital.
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; SLA SOP Rekomendasi PUB</h2>
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
                            Akta Notaris, SK Kemenkumham, Domisili Yayasan, STP/STPU, SKCK Pengurus, Pernyataan Keabsahan, Pernyataan Bebas Terorisme/Radikalisme, Rekom Dinsos Kab/Kota
                        </td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">120 Menit</td>
                        <td class="p-3">Berkas terupload di aplikasi</td>
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
                        <td class="p-3">Rekomendasi penerbitan izin</td>
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
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Pemberdayaan Sosial</td>
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
                        <td class="p-3">Dokumen perizinan yang tercetak fisik</td>
                    </tr>
                    <!-- Row 9 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">9</td>
                        <td class="p-3 border-r border-slate-200">Pengarsipan dokumen izin / non izin yang diterbitkan secara elektronik</td>
                        <td class="p-3 border-r border-slate-200">Pengadministrasi Perizinan (Sekretariat)</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Database / cloud / harddisk</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10 Menit</td>
                        <td class="p-3">Dokumen perizinan tersimpan / di back up via aplikasi</td>
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
