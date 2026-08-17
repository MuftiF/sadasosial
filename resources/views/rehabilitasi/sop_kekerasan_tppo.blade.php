@extends('layouts.app')

@section('title', 'SOP Pemulangan Korban Kekerasan & TPPO')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('rehabilitasi.subproses.index', 'kekerasan') }}" class="text-xs font-bold text-rose-600 hover:underline flex items-center gap-1.5 mb-3">
            &larr; Kembali ke Layanan Korban Kekerasan &amp; TPPO
        </a>
        <span class="inline-flex items-center rounded-md bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-800 ring-1 ring-inset ring-rose-600/20 mb-2">
            SOP Resmi Subproses 3.5 - Bidang Rehabilitasi Sosial
        </span>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">SOP PEMULANGAN PEKERJA MIGRAN KORBAN TINDAK KEKERASAN DAN TPPO</h1>
        <p class="text-sm text-slate-500 mt-2">Standar Operasional Prosedur lintas instansi pengusulan, asesmen, koordinasi OPD/DISNAKER, pemulangan, reunifikasi keluarga, pendampingan, hingga monitoring &amp; pelaporan (Total SLA: ±2 Bulan 6 Hari 3 Jam).</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Total Tahapan Alur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">11 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Instansi/Pihak Terlibat</span>
            <span class="text-2xl font-black text-rose-600 mt-1 block">6 Pihak Utama</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Titik Decision Diamond</span>
            <span class="text-2xl font-black text-indigo-600 mt-1 block">3 Percabangan</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <span class="text-xs text-slate-400 block font-semibold uppercase tracking-wider">Total Mutu Baku (SLA)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">±2 Bln 6 Hr 3 Jam</span>
        </div>
    </div>

    <!-- Section 1: Visual Timeline (11 Steps Flowchart & 3 Decision Nodes) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-rose-600 text-white text-sm">📊</span>
            Visual Diagram Alur &amp; Hubungan Pelaksana Lintas Instansi (11 Langkah Kerja)
        </h2>

        <div class="relative border-l-2 border-rose-200 ml-4 sm:ml-6 space-y-8 pl-6 sm:pl-8 py-2">
            <!-- Step 1 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    1
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Kemenlu &rarr; Dinas Sosial Provinsi
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Laporan kasus dan Pengiriman Pekerja Migran Korban Tindak Kekerasan dan TPPO</h3>
                    <p class="text-xs text-slate-600 mt-1">Kementerian Luar Negeri (Kemenlu) menyampaikan laporan resmi dan mentransfer berkas pengiriman Pekerja Migran Korban Tindak Kekerasan/TPPO ke Dinas Sosial Provinsi Sumatera Utara.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Surat Pengantar, Data BNBA dan Kelengkapan Prokes</span>
                        <span><strong class="text-slate-800">Output:</strong> Data Pekerja Migran Korban Tindak Kekerasan</span>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Dinas Sosial Provinsi
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Jam</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Asesmen dan Rencana Pemulangan</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Sosial Provinsi menyusun rencana pemulangan dan menelaah kelayakan berkas via **Decision Node 1 (Belah Ketupat)**.</p>

                    <!-- Decision Node 1 -->
                    <div class="mt-3 p-3.5 bg-rose-50/60 rounded-xl border border-rose-200/80">
                        <div class="flex items-center gap-1.5 text-xs font-bold text-rose-900 mb-2">
                            <span>🔷</span> Decision Node 1 (Verifikasi Berkas Dinsos Provinsi):
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px]">
                            <div class="bg-emerald-100/70 border border-emerald-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-emerald-800">✅ YA:</span>
                                <span class="text-emerald-950 font-medium">Rencana pemulangan disetujui &rarr; Dilanjutkan ke Koordinasi TIM Pemulangan (Langkah 3).</span>
                            </div>
                            <div class="bg-rose-100/70 border border-rose-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-rose-800">❌ TIDAK:</span>
                                <span class="text-rose-950 font-medium">Dokumen kurang / tidak valid &rarr; Dikembalikan ke Kemenlu untuk kelengkapan berkas (Kembali ke Langkah 1).</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Komputer, Telepon dan Printer</span>
                        <span><strong class="text-slate-800">Output:</strong> Tersusunnya Rencana Pemulangan</span>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Dinas Sosial Provinsi &rarr; Dinsos Kab/Kota &rarr; OPD
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Jam</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Melakukan Koordinasi dengan TIM Pemulangan</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Sosial Provinsi berkoordinasi dengan Dinsos Kabupaten/Kota dan OPD terkait. Dinsos Kab/Kota memverifikasi via **Decision Node 2 (Belah Ketupat)**.</p>

                    <!-- Decision Node 2 -->
                    <div class="mt-3 p-3.5 bg-rose-50/60 rounded-xl border border-rose-200/80">
                        <div class="flex items-center gap-1.5 text-xs font-bold text-rose-900 mb-2">
                            <span>🔷</span> Decision Node 2 (Verifikasi TIM Pemulangan Dinsos Kab/Kota):
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px]">
                            <div class="bg-emerald-100/70 border border-emerald-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-emerald-800">✅ YA:</span>
                                <span class="text-emerald-950 font-medium">Tim Pemulangan terkoordinasi &rarr; Lanjut ke koordinasi teknis OPD &amp; Disnaker (Langkah 4).</span>
                            </div>
                            <div class="bg-rose-100/70 border border-rose-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-rose-800">❌ TIDAK:</span>
                                <span class="text-rose-950 font-medium">Kendala koordinasi daerah &rarr; Dikembalikan ke Dinsos Provinsi untuk penyesuaian rencana (Kembali ke Langkah 2).</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Telepon</span>
                        <span><strong class="text-slate-800">Output:</strong> Terkoordinasinya Rencana Pemulangan</span>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: DISNAKER
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Jam</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Melakukan koordinasi dengan OPD</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Ketenagakerjaan (DISNAKER) melakukan penyesuaian jadwal pelaksanaan pemulangan dan penanganan masalah ketenagakerjaan migran.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Telepon</span>
                        <span><strong class="text-slate-800">Output:</strong> Terjadwalnya Pelaksanaan Pemulangan</span>
                    </div>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Dinas Sosial Provinsi
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Pemulangan ke Daerah Kab./Kota</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Sosial Provinsi memfasilitasi ruang transit, armada kendaraan, souvenir, dan tim penjemputan/pemulangan ke daerah Kabupaten/Kota asal.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Ruang Transit, Kendaraan, Souvenir dan Tim Pemulangan</span>
                        <span><strong class="text-slate-800">Output:</strong> Teresponnya Kasus PPKS</span>
                    </div>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    6
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Dinas Sosial Provinsi &rarr; Dinsos Kab/Kota &rarr; OPD &rarr; Keluarga
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Lanjutan Pemulangan ke Keluarga</h3>
                    <p class="text-xs text-slate-600 mt-1">Tim gabungan Dinsos Prov, Dinsos Kab/Kota, dan OPD mendampingi penyerahan korban langsung ke kediaman keluarga (Reunifikasi).</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Kendaraan dan Pendamping</span>
                        <span><strong class="text-slate-800">Output:</strong> Reunifikasi (Keluarga Kembali Utuh)</span>
                    </div>
                </div>
            </div>

            <!-- Step 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Keluarga &rarr; OPD
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Bulan</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Pendampingan</h3>
                    <p class="text-xs text-slate-600 mt-1">Keluarga bersama OPD &amp; Pilar Sosial melaksanakan prosesi pendampingan psikososial dan pemulihan trauma penerima manfaat selama 1 bulan.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Keluarga dan Pilar Sosial</span>
                        <span><strong class="text-slate-800">Output:</strong> Terpenuhinya Prosesi Pendampingan Penerima Manfaat</span>
                    </div>
                </div>
            </div>

            <!-- Step 8 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    8
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Dinsos Kab/Kota
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Bulan</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Tindak Lanjut</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Sosial Kabupaten/Kota mengevaluasi pemenuhan kebutuhan dasar &amp; pemberdayaan via **Decision Node 3 (Belah Ketupat)**.</p>

                    <!-- Decision Node 3 -->
                    <div class="mt-3 p-3.5 bg-rose-50/60 rounded-xl border border-rose-200/80">
                        <div class="flex items-center gap-1.5 text-xs font-bold text-rose-900 mb-2">
                            <span>🔷</span> Decision Node 3 (Evaluasi Tindak Lanjut Dinsos Kab/Kota):
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px]">
                            <div class="bg-emerald-100/70 border border-emerald-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-emerald-800">✅ YA:</span>
                                <span class="text-emerald-950 font-medium">Kebutuhan dasar &amp; pemberdayaan terpenuhi &rarr; Lanjut ke tahap Monitoring &amp; Pelaporan (Langkah 9).</span>
                            </div>
                            <div class="bg-rose-100/70 border border-rose-300/80 p-2 rounded-lg flex items-start gap-2">
                                <span class="font-bold text-rose-800">❌ TIDAK:</span>
                                <span class="text-rose-950 font-medium">Masih butuh pendampingan ekstra &rarr; Dikembalikan ke tahapan Pendampingan Keluarga/Disnaker (Kembali ke Langkah 7).</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Dinas Sosial Kab./Kota</span>
                        <span><strong class="text-slate-800">Output:</strong> Terpenuhinya Kebutuhan Dasar Penerima Manfaat dan Pemberdayaan</span>
                    </div>
                </div>
            </div>

            <!-- Step 9 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    9
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Dinsos Kab/Kota &rarr; Dinas Sosial Provinsi
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Monitoring dan Pelaporan</h3>
                    <p class="text-xs text-slate-600 mt-1">Dinas Sosial Kabupaten/Kota menyampaikan laporan perkembangan hasil monev penerima manfaat kepada Dinas Sosial Provinsi Sumatera Utara.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Kendaraan dan Tim Monev</span>
                        <span><strong class="text-slate-800">Output:</strong> Termonitoringnya Perkembangan PM</span>
                    </div>
                </div>
            </div>

            <!-- Step 10 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    10
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Dinas Sosial Provinsi
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Penyusunan Pelaporan</h3>
                    <p class="text-xs text-slate-600 mt-1">Tim Dinas Sosial Provinsi menyusun laporan akhir penanganan pemulangan Pekerja Migran Korban Kekerasan dan TPPO.</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Komputer dan Printer</span>
                        <span><strong class="text-slate-800">Output:</strong> Tersusun Laporan</span>
                    </div>
                </div>
            </div>

            <!-- Step 11 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-rose-600 text-white font-bold text-xs ring-4 ring-white">
                    11
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 transition">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-rose-900 bg-rose-100 px-3 py-1 rounded-md border border-rose-200">
                            👤 Pelaksana: Dinas Sosial Provinsi
                        </span>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">Waktu: 1 Hari</span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Penyampaian Laporan</h3>
                    <p class="text-xs text-slate-600 mt-1">Penyampaian laporan respon penanganan resmi ke instansi pembina, Kemenlu, dan pihak berwenang (Prosedur Selesai).</p>
                    <div class="mt-3 pt-3 border-t border-slate-200/60 flex flex-wrap gap-4 text-[11px] text-slate-600 font-medium">
                        <span><strong class="text-slate-800">Persyaratan:</strong> Laporan Perkembangan PM</span>
                        <span><strong class="text-slate-800">Output:</strong> Laporan Respon Tersampaikan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Tabel Matriks SOP Resmi 11 Langkah (12 Kolom Format Menpan-RB) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm overflow-hidden">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-rose-600 text-white text-sm">📋</span>
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
                        <th colspan="6" class="border border-slate-300 p-2 text-center bg-rose-50/80 text-rose-950">PELAKSANA</th>
                        <th colspan="3" class="border border-slate-300 p-2 text-center bg-emerald-50/80 text-emerald-950">MUTU BAKU</th>
                        <th rowspan="2" class="border border-slate-300 p-2.5 min-w-[120px]">KETERANGAN</th>
                    </tr>
                    <tr class="bg-slate-50 text-slate-700 font-semibold text-[10px]">
                        <th class="border border-slate-300 p-1.5 text-center min-w-[90px]">Kemenlu</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[100px]">Dinas Sosial Provinsi</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[100px]">Dinsos Kabupaten/Kota</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[80px]">OPD</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[90px]">DISNAKER</th>
                        <th class="border border-slate-300 p-1.5 text-center min-w-[90px]">Keluarga</th>
                        <th class="border border-slate-300 p-2 min-w-[150px]">PERSYARATAN / PERLENGKAPAN</th>
                        <th class="border border-slate-300 p-2 text-center w-20">WAKTU</th>
                        <th class="border border-slate-300 p-2 min-w-[140px]">OUTPUT</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">1</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Laporan kasus dan Pengiriman Pekerja Migran Korban Tindak Kekerasan dan TPPO</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Surat Pengantar, Data BNBA dan Kelengkapan Prokes</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 hari</td>
                        <td class="border border-slate-200 p-2.5">Data Pekerja Migran Korban Tindak Kekerasan</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">2</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Asesmen dan Rencana Pemulangan</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Komputer, Telepon dan Printer</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 Jam</td>
                        <td class="border border-slate-200 p-2.5">Tersusunya Rencana Pemulangan</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">3</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Melakukan Koordinasi dengan TIM Pemulangan</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Telepon</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 jam</td>
                        <td class="border border-slate-200 p-2.5">Terkoordinasinya Rencana Pemulangan</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">4</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Melakukan koordinasi dengan OPD</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Telepon</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 jam</td>
                        <td class="border border-slate-200 p-2.5">Terjadwalnya Pelaksanaan Pemulangan</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 5 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">5</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Pemulangan ke Daerah Kab./Kota</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Ruang Transit, Kendaraan, Souvenir dan Tim Pemulangan</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 hari</td>
                        <td class="border border-slate-200 p-2.5">Teresponnya Kasus PPKS</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 6 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">6</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Lanjutan Pemulangan ke Keluarga</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5">Kendaraan dan Pendamping</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 hari</td>
                        <td class="border border-slate-200 p-2.5">Reunifikasi</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 7 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">7</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Pendampingan</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5">Keluarga dan Pilar Sosial</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 bulan</td>
                        <td class="border border-slate-200 p-2.5">Terpenuhinya prosesi pendampingan penerima manfaat</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 8 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">8</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Tindak Lanjut</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Dinas Sosial Kab./Kota</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 bulan</td>
                        <td class="border border-slate-200 p-2.5">Terpenuhinya kebutuhan dasar penerima manfaat dan pemberdayaan</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 9 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">9</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Monitoring dan Pelaporan</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Kendaraan dan Tim Monev</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 hari</td>
                        <td class="border border-slate-200 p-2.5">Termonitoringnya Perkembangan PM</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 10 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">10</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Penyusunan Pelaporan</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Komputer dan Printer</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 hari</td>
                        <td class="border border-slate-200 p-2.5">Tersusun Laporan</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                    <!-- Row 11 -->
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="border border-slate-200 p-2.5 text-center font-bold">11</td>
                        <td class="border border-slate-200 p-2.5 font-medium">Penyampaian Laporan</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center font-extrabold text-rose-600 bg-rose-50/40">✓</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5 text-center text-slate-300">-</td>
                        <td class="border border-slate-200 p-2.5">Laporan Perkembangan PM</td>
                        <td class="border border-slate-200 p-2.5 text-center font-semibold text-emerald-700">1 hari</td>
                        <td class="border border-slate-200 p-2.5">Laporan Respon Tersampaikan</td>
                        <td class="border border-slate-200 p-2.5 text-slate-400">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
