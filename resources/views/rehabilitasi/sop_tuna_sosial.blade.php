@extends('layouts.app')

@section('title', 'SOP Pemulangan Orang Terlantar (Tuna Sosial)')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('rehabilitasi.subproses.index', 'tuna_sosial') }}" class="text-xs font-bold text-orange-600 hover:underline flex items-center gap-1.5 mb-3">
            &larr; Kembali ke Layanan Tuna Sosial &amp; Warga Rentan
        </a>
        <span class="inline-flex items-center rounded-md bg-orange-50 px-2.5 py-1 text-xs font-semibold text-orange-800 ring-1 ring-inset ring-orange-600/20 mb-2">
            SOP Resmi Subproses 3.4 - Bidang Rehabilitasi Sosial
        </span>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">SOP PEMULANGAN ORANG TERLANTAR (OT)</h1>
        <p class="text-sm text-slate-500 mt-2">Standar Operasional Prosedur penerimaan rujukan darurat, asesmen kebutuhan, verifikasi persetujuan, penyiapan tiket/uang saku, hingga pengantaran pemulangan klien ke daerah asal (Total SLA: 270 Menit / ~4,5 Jam).</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Total Tahapan Alur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">6 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-orange-600 mt-1 block">6 Aktor Utama</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Total Mutu Baku (SLA)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">270 Menit (~4,5 Jam)</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Sifat Layanan</span>
            <span class="text-2xl font-black text-rose-600 mt-1 block">Darurat PPKS</span>
        </div>
    </div>

    <!-- Section 1: Visual Timeline (6 Steps Flowchart & Decision Node) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-orange-600 text-white text-sm">📊</span>
            Visual Diagram Alur &amp; Hubungan Pelaksana (6 Langkah Kerja)
        </h2>

        <div class="relative border-l-2 border-orange-200 ml-4 sm:ml-6 space-y-8 pl-6 sm:pl-8 py-2">
            <!-- Step 1 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-orange-600 text-white font-bold text-xs ring-4 ring-white">
                    1
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-orange-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-orange-900 bg-orange-100 px-3 py-1 rounded-md border border-orange-200">
                            👤 Pelaksana: Kepolisian / Dinas Sosial Kab/Kota / Warga / Kelurahan
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 15 Menit</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Klien didampingi oleh petugas kepolisian/Dinas Sosial Kab/Kota membawa surat keterangan terlantar datang ke Dinas Sosial Provsu</h3>
                    <p class="text-xs text-slate-600 mt-1">Penerimaan rujukan darurat klien Orang Terlantar (OT) yang didampingi aparat kepolisian atau Dinsos Kab/Kota lengkap dengan Surat Keterangan Terlantar.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Perlengkapan:</strong> Surat keterangan terlantar dari kepolisian dan Surat Dinas Sosial Kab/Kota</span>
                        <span><strong class="text-slate-800">Output:</strong> Surat Keterangan Terlantar (Diterima)</span>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-orange-600 text-white font-bold text-xs ring-4 ring-white">
                    2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-orange-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-orange-900 bg-orange-100 px-3 py-1 rounded-md border border-orange-200">
                            👤 Pelaksana: Sub Koordinator Dinsos Provsu / Peksos / Pendamping Rehsos
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 90 Menit</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Melakukan assement masalah, kebutuhan dan sistem sumber masalah</h3>
                    <p class="text-xs text-slate-600 mt-1">Petugas Pekerja Sosial / Pendamping Rehsos melakukan wawancara dan asesmen mendalam mengenai kronologi keterlantaran, sanak keluarga, dan kebutuhan tempat tujuan pemulangan.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Perlengkapan:</strong> a. Surat Keterangan Terlantar, b. Info cerita keluarga, c. Fotocopy KTP/KK (bila ada)</span>
                        <span><strong class="text-slate-800">Output:</strong> Formulir Layanan Sosial Terisi</span>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-orange-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-orange-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-orange-900 bg-orange-100 px-3 py-1 rounded-md border border-orange-200">
                            👤 Pelaksana: Sub Koordinator Rehsos / Kabid Sosial
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 30 Menit</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Memverifikasi dan memutuskan hasil dari formulir layanan sosial yang telah diisi</h3>
                    <p class="text-xs text-slate-600 mt-1">Pimpinan memverifikasi keabsahan formulir asesmen via **Decision Node (Belah Ketupat)** untuk menetapkan persetujuan bantuan pemulangan.</p>

                    <!-- Decision Branch Box -->
                    <div class="mt-3 p-3.5 bg-orange-50/60 rounded-xl border border-orange-200/80">
                        <div class="flex items-center gap-1.5 text-xs font-bold text-orange-900 mb-2">
                            <span>🔷</span> Keputusan Verifikasi Sub Koordinator / Kabid Sosial:
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px]">
                            <div class="bg-emerald-100/70 border border-emerald-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-emerald-800">✅ YA:</span>
                                <span class="text-emerald-950 font-medium">Berkas lengkap &amp; terverifikasi sah &rarr; Dilanjutkan ke Pekerja Sosial untuk permohonan pemulangan (Langkah 4).</span>
                            </div>
                            <div class="bg-rose-100/70 border border-rose-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-rose-800">❌ TIDAK:</span>
                                <span class="text-rose-950 font-medium">Berkas belum lengkap / meragukan &rarr; Dikembalikan ke Kepolisian / Dinsos Kab-Kota / Kelurahan (Kembali ke Langkah 1).</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Perlengkapan:</strong> Instrumen asesmen Staf Rehsos</span>
                        <span><strong class="text-slate-800">Output:</strong> Instrumen Asesmen / Laporan Hasil Asesmen</span>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-orange-600 text-white font-bold text-xs ring-4 ring-white">
                    4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-orange-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-orange-900 bg-orange-100 px-3 py-1 rounded-md border border-orange-200">
                            👤 Pelaksana: Pekerja Sosial / Pendamping Rehsos
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 15 Menit</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Menyampaikan surat permohonan bantuan pemulangan orang terlantar beserta persyaratan ke Dinas Sosial Provinsi yang dituju</h3>
                    <p class="text-xs text-slate-600 mt-1">Pekerja Sosial menerbitkan dan menyampaikan surat permohonan rekomendasi pemulangan resmi serta koordinasi ke Dinsos Provinsi tujuan.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Perlengkapan:</strong> a. Foto/KK (bila ada), b. Surat keterangan terlantar dari kepolisian dan Dinsos Kab/Kota</span>
                        <span><strong class="text-slate-800">Output:</strong> Teresponnya Kasus PPKS</span>
                    </div>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-orange-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-orange-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-orange-900 bg-orange-100 px-3 py-1 rounded-md border border-orange-200">
                            👤 Pelaksana: Staf Rehsos Pengadministrasi / Pendamping
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 60 Menit</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Menerima berkas dan uang untuk pembelian tiket klien orang terlantar</h3>
                    <p class="text-xs text-slate-600 mt-1">Staf Pengadministrasi mencairkan dana tiket/uang saku, menyiapkan bantuan pakaian bersih (kemeja, celana, handuk, pakaian dalam), dan menandatangani tanda terima.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Perlengkapan:</strong> a. Daftar tanda terima uang saku pemulangan OT, b. Daftar tanda terima pakaian (kemeja, celana panjang, handuk &amp; celana dalam)</span>
                        <span><strong class="text-slate-800">Output:</strong> Tanda Terima OT</span>
                    </div>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-orange-600 text-white font-bold text-xs ring-4 ring-white">
                    6
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-orange-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-orange-900 bg-orange-100 px-3 py-1 rounded-md border border-orange-200">
                            👤 Pelaksana: Rehsos Staf Rehsos / Pengantar OT
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 60 Menit</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Klien diantar ke terminal bus untuk dipulangkan ke daerah asal</h3>
                    <p class="text-xs text-slate-600 mt-1">Petugas Pengantar mendampingi klien OT ke terminal bus/stasiun/pelabuhan, menyerahkan tiket resmi &amp; perbekalan, hingga armada bus berangkat menuju daerah asal.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Perlengkapan:</strong> a. Tiket bus, b. Syarat keberangkatan yang ditetapkan pemerintah, c. Surat keterangan terlantar</span>
                        <span><strong class="text-slate-800">Output:</strong> Klien OT Selesai Dipulangkan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Tabel Matriks SOP Resmi 6 Langkah (12 Kolom Format Menpan-RB) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm overflow-hidden">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-orange-600 text-white text-sm">📋</span>
                Tabel Matriks Standard Operasional Prosedur (SOP Resmi 12 Kolom)
            </h2>
            <span class="text-xs font-medium text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                Format Standar Menpan-RB (12 Kolom)
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse border border-slate-200">
                <thead>
                    <tr class="bg-slate-100 text-slate-800 font-bold">
                        <th rowspan="2" class="border border-slate-300 p-2.5 text-center w-10">NO</th>
                        <th rowspan="2" class="border border-slate-300 p-2.5 min-w-[220px]">URAIAN PROSEDUR</th>
                        <th colspan="6" class="border border-slate-300 p-2 text-center bg-orange-50/80 text-orange-950">PELAKSANA</th>
                        <th colspan="3" class="border border-slate-300 p-2 text-center bg-emerald-50/80 text-emerald-950">MUTU BAKU</th>
                        <th rowspan="2" class="border border-slate-300 p-2.5 min-w-[120px]">KETERANGAN</th>
                    </tr>
                    <tr class="bg-slate-50 text-slate-700 font-semibold text-[10px]">
                        <th class="border border-slate-300 p-1.5 text-center min-w-[100px]">Kepolisian / Dinsos Kab/Kota / Warga / Kelurahan</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[110px]">Sub Koordinator Dinsos Provsu / Peksos / Pendamping</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[100px]">Sub Koordinator Rehsos / Kabid Sosial</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[100px]">Pekerja Sosial / Pendamping Rehsos</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[110px]">Staf Rehsos Pengadministrasi / Pendamping</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[100px]">Rehsos Staf Rehsos / Pengantar OT</th>
                        <th class="border border-slate-300 p-2 min-w-[150px]">PERLENGKAPAN</th>
                        <th class="border border-slate-300 p-2 text-center w-20">WAKTU</th>
                        <th class="border border-slate-300 p-2 min-w-[140px]">OUTPUT</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">1</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Klien didampingi oleh petugas kepolisian/Dinas Sosial Kab/Kota membawa surat keterangan terlantar datang ke Dinas Sosial Provsu</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-orange-600 bg-orange-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Surat keterangan terlantar dari kepolisian dan Surat Dinas Sosial Kab/Kota</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">15 menit</td>
                        <td class="border border-slate-200 p-2.5">surat ketengan terlantar</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">2</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Melakukan assement masalah, kebutuhan dan sistem sumber masalah</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-orange-600 bg-orange-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">a. surat keterangan terlantar(kepolisian/Dinas Sosial Kab/Kota)<br>b.info cerita keluarga<br>c.fotocopy ktp/kk (bila ada)</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">90 menit</td>
                        <td class="border border-slate-200 p-2.5">formulir lanyanan sosial</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">3</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Memverifikasi dan memutuskan hasil dari formulir layanan sosial yang telah diisi</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-orange-600 bg-orange-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Instrumen asssment Staf Rehsos</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">30 menit</td>
                        <td class="border border-slate-200 p-2.5">instrumen assesmen/ laporan hasil assesmen</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">4</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Menyampaikan surat permohonan bantuan pemulangan orang terlantar beserta persyaratan ke Dinas Sosial Provinsi yang dituju</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-orange-600 bg-orange-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">surat permohonan bantuan pemulangan orang terlantar:<br>a.Foto/KK(bila ada)<br>b.surat keterangan terlantar dari kepolisian dan Surat Dinas Sosial Kab/Kota</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">15 menit</td>
                        <td class="border border-slate-200 p-2.5">Teresponnya Kasus PPKS</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 5 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">5</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Menerima berkas dan uang untuk pembelian tiket klien orang terlantar</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-orange-600 bg-orange-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">a.daftar tanda terima uang saku pemulangan OT<br>b.daftar tanda terima pakaian (kemeja,celana panjang ,handukdan celana dalam.)</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">60 menit</td>
                        <td class="border border-slate-200 p-2.5">Tanda Terima OT</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 6 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">6</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Klien diantar ke terminal bus untuk dipulangkan ke daerah asal</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-orange-600 bg-orange-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5">a. Tiket bus<br>b. syarat keberangkatan yang ditetapkan pemerintah<br>c. surat keterangan terlantar</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">60 menit</td>
                        <td class="border border-slate-200 p-2.5">klien OT selesai dipulangkan</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
