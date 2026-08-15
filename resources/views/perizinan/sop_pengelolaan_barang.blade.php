@extends('layouts.app')

@section('title', 'SOP Pengelolaan Barang HTT/HTDP - SADA SOSIAL')

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
                    SOP Resmi - Pengelolaan Barang HTT / HTDP
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Pengelolaan Barang HTT &amp; HTDP</h1>
                <p class="text-sm text-slate-500 mt-1">
                    Alur serah terima, penyimpanan, pelaporan, dan penyaluran Hadiah Tidak Tertebak (HTT) atau Hadiah Tidak Diambil Pemenang (HTDP) dari penyelenggaraan UGB ke LKS melalui Dinas Sosial.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('perizinan.form', 'ugb') }}" class="rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-emerald-700 transition">
                    + Ajukan Izin / Laporan UGB
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Tahapan Prosedur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">16 Langkah Kerja</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Aktor Pelaksana Terlibat</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">5 Pihak (Kemensos s/d LKS)</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Target Mutu Baku (SLA Total)</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">810 Menit (13.5 Jam)</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (16 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-600 text-white text-sm">📦</span>
            Visual Diagram Alur Pengelolaan Barang HTT / HTDP (16 Tahapan)
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
                            Penyelenggara Undian
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Menyerahkan Barang HTT / HTDP</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Penyelenggara menyerahkan fisik barang HTT/HTDP disertai dengan surat pengantar penyerahan resmi kepada Dinas Sosial.
                    </p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Melakukan Pemeriksaan &amp; Penerimaan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Kabid Pemberdayaan Sosial menerima dan memeriksa kesesuaian jumlah, kondisi fisik barang, dan dokumen pengantar.
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 30 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Membuat Berita Acara Serah Terima (BAST)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Menyusun dokumen BAST resmi yang ditandatangani oleh pihak penyelenggara undian dan pejabat Dinsos.
                    </p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 30 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pencatatan ke Buku Register Barang</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Membukukan barang HTT/HTDP yang masuk ke dalam buku register khusus inventaris barang jaminan/hadiah Dinsos.
                    </p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 30 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penyimpanan &amp; Koordinasi Gudang</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Memindahkan barang ke gudang penyimpanan resmi Dinsos dan berkoordinasi dengan pengurus/staf gudang.
                    </p>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    6
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 15 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Melaporkan Daftar Barang ke Kementerian Sosial</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Mengirimkan laporan tertulis daftar inventarisasi barang HTT/HTDP yang dikelola kepada Direktorat Jenderal PSDBS Kementerian Sosial RI.
                    </p>
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
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Penyusunan Perencanaan Pendistribusian</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Menyusun draf rencana penyaluran barang sosial tersebut untuk didistribusikan kepada kelompok rentan atau LKS yang membutuhkan bantuan fisik.
                    </p>
                </div>
            </div>

            <!-- Step 8 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    8
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Koordinasi dengan Calon Penerima (LKS/Orsos)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Menghubungi pengurus LKS/Organisasi Sosial di wilayah Sumut yang dinilai layak dan masuk kriteria penerima bantuan barang HTT/HTDP.
                    </p>
                </div>
            </div>

            <!-- Step 9 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    9
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pengurus LKS (Lembaga Penerima)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Membuat Permohonan Pemanfaatan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        LKS mengajukan proposal dan surat permohonan pemanfaatan barang HTT/HTDP untuk menunjang operasional panti asuhan/lembaga sosial mereka.
                    </p>
                </div>
            </div>

            <!-- Step 10 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    10
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Verifikasi &amp; Tinjauan Lapangan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Melakukan survei visitasi langsung ke LKS pemohon untuk memastikan kesiapan penerimaan barang dan memverifikasi kebutuhan riil menggunakan instrumen penilaian.
                    </p>
                </div>
            </div>

            <!-- Step 11 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    11
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Pengurus LKS (Lembaga Penerima)
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 30 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Membuat Surat Pernyataan Tanggung Jawab Mutlak (SPTJM)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Pengurus LKS menandatangani SPTJM bermaterai yang menyatakan komitmen penuh pemanfaatan barang murni untuk program kesejahteraan sosial dan tidak diperjualbelikan.
                    </p>
                </div>
            </div>

            <!-- Step 12 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    12
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Dinas Sosial
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 30 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Persetujuan Penyaluran / Pendistribusian</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Kepala Dinas Sosial menerbitkan Surat Persetujuan Penyaluran Barang HTT/HTDP secara resmi tingkat wilayah provinsi.
                    </p>
                </div>
            </div>

            <!-- Step 13 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    13
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Mengirim Surat Permohonan Penyaluran ke Kemensos</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Mengirimkan dokumen permohonan penyaluran yang telah disetujui Kadis kepada Menteri Sosial RI c.q. Direktorat Jenderal terkait untuk mendapatkan persetujuan pusat.
                    </p>
                </div>
            </div>

            <!-- Step 14 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    14
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-purple-700 bg-purple-50 px-2.5 py-1 rounded-md border border-purple-200">
                            Kementerian Sosial RI
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 120 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Verifikasi &amp; Penerbitan Surat Persetujuan Pusat</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Kemensos melakukan verifikasi akhir kelayakan penyaluran dan mengirimkan surat jawaban balasan berisi Surat Keputusan (SK) Persetujuan Penyaluran HTT/HTDP.
                    </p>
                </div>
            </div>

            <!-- Step 15 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    15
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Dinas Sosial
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-slate-200">
                            ⏱️ 60 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Menyalurkan Barang HTT / HTDP</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Melakukan penyerahan fisik barang secara simbolis/langsung dari gudang Dinsos kepada LKS penerima disertai bukti penyerahan barang (Berita Acara Penyerahan Barang).
                    </p>
                </div>
            </div>

            <!-- Step 16 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    16
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Bidang Dayasos
                        </span>
                        <span class="text-xs font-semibold text-slate-500 bg-white px-2.5 py-1 rounded-md border border-emerald-200">
                            ⏱️ 15 Menit
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pencatatan Penyaluran &amp; Update Register Gudang</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Membukukan data penyaluran dan mengurangi persediaan barang HTT/HTDP di dalam database register dan sistem pergudangan secara digital.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Rincian Tabel Mutu Baku / SLA -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Tabel Mutu Baku &amp; SLA Pengelolaan Barang HTT / HTDP</h2>
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
                    <!-- Steps 1-16 -->
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">1</td>
                        <td class="p-3 border-r border-slate-200">Menyerahkan barang HTT / HTDP disertai surat pengantar</td>
                        <td class="p-3 border-r border-slate-200">Penyelenggara Undian</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Barang HTT / HTDP</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Barang HTT / HTDP diterima Dinsos</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">2</td>
                        <td class="p-3 border-r border-slate-200">Melakukan pemeriksaan dan penerimaan</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Dokumen Pemeriksaan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Dokumen Pemeriksaan tervalidasi</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">3</td>
                        <td class="p-3 border-r border-slate-200">Membuat Berita Acara Serah Terima Barang HTT / HTDP</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Berita Acara Penyerahan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Berita Acara Penyerahan ditandatangani</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">4</td>
                        <td class="p-3 border-r border-slate-200">Mencatat barang HTT / HTDP yang diterima ke dalam buku register</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Buku Register / Aplikasi</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Catatan inventaris register</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">5</td>
                        <td class="p-3 border-r border-slate-200">Menyimpan barang HTT / HTDP dan berkoordinasi dengan pengurus gudang</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Tempat Penyimpanan Gudang</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Catatan log pergudangan</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">6</td>
                        <td class="p-3 border-r border-slate-200">Melaporkan daftar HTT / HTDP kepada Kementerian Sosial</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Format Laporan Kemensos</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">15 Menit</td>
                        <td class="p-3">Laporan terkirim ke Kemensos</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">7</td>
                        <td class="p-3 border-r border-slate-200">Menyusun perencanaan pendistribusian/ penyaluran barang HTT / HTDP</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Dokumen perencanaan penyaluran</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Dokumen perencanaan disahkan</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">8</td>
                        <td class="p-3 border-r border-slate-200">Berkoordinasi dengan LKS / Orsos calon penerima barang HTT / HTDP</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Alat Komunikasi / Surat Undangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Konfirmasi kesediaan calon penerima</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">9</td>
                        <td class="p-3 border-r border-slate-200">Membuat permohonan pemanfaatan HTT / HTDP</td>
                        <td class="p-3 border-r border-slate-200">Pengurus LKS</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Surat permohonan pemanfaatan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Surat permohonan diterima Dinsos</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">10</td>
                        <td class="p-3 border-r border-slate-200">Melakukan verifikasi dan tinjauan lapangan kepada LKS calon penerima barang HTT / HTDP</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Instrumen verifikasi lapangan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Laporan kelayakan lapangan (BAP)</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">11</td>
                        <td class="p-3 border-r border-slate-200">Membuat Surat Pertanggungjawaban mutlak atas barang HTT / HTDP yang diterima agar dimanfaatkan untuk penyelenggaraan kesejahteraan sosial</td>
                        <td class="p-3 border-r border-slate-200">Pengurus LKS</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Surat tanggung jawab mutlak (SPTJM)</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Dokumen SPTJM ditandatangani</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">12</td>
                        <td class="p-3 border-r border-slate-200">Menyetujui pendistribusian / penyaluran barang HTT / HTDP</td>
                        <td class="p-3 border-r border-slate-200">Kepala Dinas Sosial</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Surat Persetujuan Kadis</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">30 Menit</td>
                        <td class="p-3">Surat persetujuan terbit</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">13</td>
                        <td class="p-3 border-r border-slate-200">Mengirimkan surat permohonan penyaluran kepada kementerian sosial</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Surat permohonan ke Kemensos</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Dokumen terkirim ke pusat</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">14</td>
                        <td class="p-3 border-r border-slate-200">Melakukan verifikasi dan persetujuan penyaluran HTT / HTDP</td>
                        <td class="p-3 border-r border-slate-200">Kementerian Sosial</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Evaluasi administrasi pusat</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">120 Menit</td>
                        <td class="p-3">Surat balasan persetujuan Kemensos</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">15</td>
                        <td class="p-3 border-r border-slate-200">Menyalurkan HTT / HTDP</td>
                        <td class="p-3 border-r border-slate-200">Kepala Dinas Sosial</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Fisik Barang, Bukti penyerahan</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">60 Menit</td>
                        <td class="p-3">Bukti penyaluran ditandatangani LKS</td>
                    </tr>
                    <tr>
                        <td class="p-3 text-center font-bold border-r border-slate-200">16</td>
                        <td class="p-3 border-r border-slate-200">Mencatat data penyaluran dan perubahan register barang HTT / HTDP</td>
                        <td class="p-3 border-r border-slate-200">Kepala Bidang Dayasos</td>
                        <td class="p-3 border-r border-slate-200 text-slate-500">Buku Register Gudang</td>
                        <td class="p-3 text-center font-bold border-r border-slate-200">15 Menit</td>
                        <td class="p-3">Catatan register berkurang (Selesai)</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-emerald-50 font-bold text-emerald-900 border-t-2 border-emerald-300">
                        <td colspan="4" class="p-3 text-right uppercase tracking-wider border-r border-emerald-200">Total Mutu Baku (SLA)</td>
                        <td class="p-3 text-center text-sm border-r border-emerald-200">810 Menit (13.5 Jam)</td>
                        <td class="p-3">Sesuai SOP Resmi Dinsos Pemprovsu &amp; Kemensos</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
