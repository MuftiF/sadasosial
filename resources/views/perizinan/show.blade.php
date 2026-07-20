@extends('layouts.app')

@section('title', 'Detail Permohonan Perizinan')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">

    <!-- Header & Back Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('perizinan.index') }}" class="text-xs font-bold text-emerald-400 hover:underline flex items-center gap-1.5 mb-2">
                &larr; Kembali ke Dashboard
            </a>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Detail Permohonan #{{ $perizinan->id }}</h1>
            <p class="text-xs text-slate-400 mt-0.5">Pantau alur verifikasi secara real-time dan ulasan petugas dinas sosial.</p>
        </div>
        <div class="flex items-center gap-3">
            @if($perizinan->status === 'selesai')
                <a href="{{ route('perizinan.download_pdf', $perizinan->id) }}" target="_blank" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2.5 text-xs font-bold text-slate-950 shadow-md hover:opacity-90 transition duration-200">
                    📥 Cetak Rekomendasi / Izin
                </a>
            @endif
            @if(($perizinan->pemohon_id === $user->id) && ($perizinan->perlu_perbaikan || $perizinan->status === 'draft'))
                <a href="{{ route('perizinan.edit', $perizinan->id) }}" class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-4 py-2.5 text-xs font-bold text-slate-950 hover:bg-amber-400 transition duration-200">
                    ✏️ Perbaiki & Lengkapi Data
                </a>
            @endif
        </div>
    </div>

    <!-- Alert for Revision/Repair -->
    @if($perizinan->perlu_perbaikan)
        <div class="mb-8 p-4 rounded-2xl border border-amber-500/20 bg-amber-500/5 flex items-start gap-3">
            <span class="text-lg">⚠️</span>
            <div>
                <h4 class="text-sm font-bold text-amber-400">Butuh Perbaikan Dokumen / Informasi</h4>
                <p class="text-xs text-slate-300 mt-1">
                    Permohonan dikembalikan oleh petugas untuk diperbaiki. Silakan klik tombol <strong>"Perbaiki & Lengkapi Data"</strong> di atas.
                </p>
                <div class="mt-2.5 p-3 rounded-xl bg-slate-950 border border-slate-900">
                    <p class="text-xs text-slate-400"><strong class="text-slate-300">Catatan Petugas:</strong> {{ $perizinan->catatan_perbaikan }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- ================== LEFT PANEL: APPLICATION DETAILS ================== -->
        <div class="lg:col-span-7 space-y-6">
            <div class="glass-panel rounded-3xl p-6">
                <div class="border-b border-slate-900 pb-4 mb-6 flex justify-between items-center">
                    <h3 class="font-extrabold text-white text-base">Rincian Formulir Pengajuan</h3>
                    <span class="inline-flex items-center rounded-full bg-slate-950 px-2.5 py-0.5 text-[10px] font-bold text-slate-400 ring-1 ring-slate-800">
                        {{ strtoupper($perizinan->jenis_layanan) }}
                    </span>
                </div>

                <!-- Shared fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <span class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Nama Pemohon</span>
                        <p class="text-sm font-bold text-slate-200 mt-0.5">{{ $perizinan->pemohon->name }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Jenis Layanan</span>
                        <p class="text-sm font-bold text-slate-200 mt-0.5">{{ $jenisLabels[$perizinan->jenis_layanan] }}</p>
                    </div>
                    @if($perizinan->nomor_izin)
                        <div>
                            <span class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Nomor Dokumen Resmi</span>
                            <p class="text-sm font-bold text-emerald-400 mt-0.5">{{ $perizinan->nomor_izin }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Tanggal Masa Berlaku</span>
                            <p class="text-xs font-semibold text-slate-200 mt-0.5">
                                {{ $perizinan->tanggal_terbit->format('d M Y') }} s.d. 
                                @if($perizinan->jenis_layanan === 'adopsi')
                                    Selamanya (Permanen)
                                @else
                                    {{ $perizinan->tanggal_kadaluarsa->format('d M Y') }}
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Conditional fields based on service type -->
                <div class="border-t border-slate-900 pt-6 space-y-4">
                    @php
                        $data = $perizinan->data_tambahan ?? [];
                    @endphp

                    @if($perizinan->jenis_layanan === 'ugb')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Penyelenggara</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_penyelenggara'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Acara Undian</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_undian'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Total Nilai Hadiah</span>
                                <span class="text-xs font-bold text-emerald-400">Rp {{ number_format($data['total_hadiah'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Waktu Pelaksanaan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['waktu_pelaksanaan'] ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            <span class="text-[10px] text-slate-500 block">Deskripsi & Mekanisme</span>
                            <p class="text-xs text-slate-300 mt-1 leading-relaxed bg-slate-950 p-3 rounded-xl border border-slate-900">{{ $data['deskripsi_kegiatan'] ?? '-' }}</p>
                        </div>

                    @elseif($perizinan->jenis_layanan === 'pub')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Lembaga Pemohon</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_penyelenggara'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Tujuan Pengumpulan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['tujuan_pengumpulan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Metode Pengumpulan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['metode_pengumpulan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Target Dana Sumbangan</span>
                                <span class="text-xs font-bold text-emerald-400">Rp {{ number_format($data['target_dana'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Wilayah Pengumpulan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['wilayah_pengumpulan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Jangka Waktu Pengumpulan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['waktu_pelaksanaan'] ?? '-' }}</span>
                            </div>
                        </div>

                    @elseif($perizinan->jenis_layanan === 'lks')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama LKS</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_lks'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Fokus Rehabilitasi / Layanan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['jenis_pelayanan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Pimpinan / Ketua</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_pimpinan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Jumlah Warga Binaan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['jumlah_binaan'] ?? 0 }} Jiwa</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            <span class="text-[10px] text-slate-500 block">Alamat Kantor / Panti LKS</span>
                            <p class="text-xs text-slate-300 mt-1 leading-relaxed bg-slate-950 p-3 rounded-xl border border-slate-900">{{ $data['alamat_lks'] ?? '-' }}</p>
                        </div>

                    @elseif($perizinan->jenis_layanan === 'adopsi')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Calon Ayah</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_ayah'] ?? '-' }} (NIK: {{ $data['nik_ayah'] ?? '-' }})</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Calon Ibu</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_ibu'] ?? '-' }} (NIK: {{ $data['nik_ibu'] ?? '-' }})</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Lama Pernikahan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['lama_menikah'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Penghasilan Bulanan COTA</span>
                                <span class="text-xs font-bold text-emerald-400">Rp {{ number_format($data['penghasilan'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Anak yang Diangkat</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_anak'] ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            <span class="text-[10px] text-slate-500 block">Alamat Tinggal COTA</span>
                            <p class="text-xs text-slate-300 mt-1 bg-slate-950 p-3 rounded-xl border border-slate-900">{{ $data['alamat_cota'] ?? '-' }}</p>
                        </div>
                        <div class="pt-2">
                            <span class="text-[10px] text-slate-500 block">Alasan Pengangkatan Anak</span>
                            <p class="text-xs text-slate-300 mt-1 leading-relaxed bg-slate-950 p-3 rounded-xl border border-slate-900">{{ $data['alasan_adopsi'] ?? '-' }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Uploaded Documents card -->
            <div class="glass-panel rounded-3xl p-6">
                <h3 class="font-extrabold text-white text-base border-b border-slate-900 pb-4 mb-4 flex items-center gap-2">
                    <span>📎</span> Berkas Pendukung
                </h3>
                <div class="space-y-3">
                    @php
                        $docs = [];
                        if($perizinan->jenis_layanan === 'ugb') {
                            $docs = ['Proposal Kegiatan & Mekanisme' => 'dokumen_proposal', 'Daftar Rincian Hadiah' => 'dokumen_hadiah'];
                        } elseif($perizinan->jenis_layanan === 'pub') {
                            $docs = ['Proposal Program PUB' => 'dokumen_proposal', 'Buku Tabungan / Rekening Lembaga' => 'dokumen_rekening'];
                        } elseif($perizinan->jenis_layanan === 'lks') {
                            $docs = ['Akta Notaris & AD/ART' => 'dokumen_akta', 'Surat Domisili Kelurahan' => 'dokumen_domisili'];
                        } elseif($perizinan->jenis_layanan === 'adopsi') {
                            $docs = ['Akta Nikah COTA' => 'dokumen_nikah', 'Surat Keterangan Sehat' => 'dokumen_sehat'];
                        }
                    @endphp

                    @foreach($docs as $label => $key)
                        @php
                            $filePath = $data[$key] ?? null;
                            $fileExists = $filePath && Storage::disk('public')->exists($filePath);
                            $fileName = $filePath ? basename($filePath) : null;
                            $fileExt = $fileName ? strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) : null;
                            $fileSize = $fileExists ? round(Storage::disk('public')->size($filePath) / 1024, 1) . ' KB' : null;
                            $isImage = in_array($fileExt, ['jpg', 'jpeg', 'png', 'webp']);
                            $isPdf = $fileExt === 'pdf';
                            $fileIcon = $isPdf ? '📄' : ($isImage ? '🖼️' : '📁');
                            $fileUrl = $filePath ? Storage::url($filePath) : null;
                        @endphp
                        <div class="rounded-2xl bg-slate-950/40 border border-slate-900 overflow-hidden">
                            <div class="flex items-center justify-between p-3.5 gap-3">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="text-xl flex-shrink-0">{{ $fileIcon }}</span>
                                    <div class="min-w-0">
                                        <h5 class="text-xs font-bold text-slate-300">{{ $label }}</h5>
                                        @if($filePath)
                                            <p class="text-[10px] text-slate-500 mt-0.5 truncate max-w-[180px]" title="{{ $fileName }}">
                                                {{ $fileName }}
                                                @if($fileSize) &bull; {{ $fileSize }} @endif
                                            </p>
                                        @else
                                            <p class="text-[10px] text-slate-600 italic mt-0.5">Belum diunggah</p>
                                        @endif
                                    </div>
                                </div>
                                @if($filePath && $fileExists)
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <a href="{{ $fileUrl }}" target="_blank"
                                           class="inline-flex items-center gap-1 rounded-lg bg-emerald-500/10 border border-emerald-500/20 px-3 py-1.5 text-[11px] font-bold text-emerald-400 hover:bg-emerald-500/20 transition">
                                            Buka
                                        </a>
                                        <a href="{{ $fileUrl }}" download
                                           class="inline-flex items-center gap-1 rounded-lg bg-slate-800 border border-slate-700 px-3 py-1.5 text-[11px] font-bold text-slate-300 hover:bg-slate-700 hover:text-white transition">
                                            ↓
                                        </a>
                                    </div>
                                @elseif($filePath && !$fileExists)
                                    <span class="text-[10px] text-amber-500 italic flex-shrink-0">File tidak ditemukan</span>
                                @else
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-slate-800 text-slate-500 ring-1 ring-slate-700">
                                        Belum ada
                                    </span>
                                @endif
                            </div>
                            {{-- Image Preview (inline) --}}
                            @if($filePath && $fileExists && $isImage)
                                <div class="border-t border-slate-900 px-3.5 pb-3.5 pt-3">
                                    <img src="{{ $fileUrl }}" alt="{{ $label }}"
                                         class="rounded-xl max-h-48 w-auto object-contain border border-slate-800 bg-slate-950/60 p-1">
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            @if($perizinan->jenis_layanan === 'ugb' && $perizinan->status === 'selesai')
                <!-- UGB REPORT CARD -->
                <div class="glass-panel rounded-3xl p-6 border-emerald-500/20 bg-emerald-500/5 glow-emerald mt-6">
                    <div class="flex justify-between items-center border-b border-slate-900 pb-4 mb-4">
                        <h3 class="font-extrabold text-white text-base">Laporan Pelaksanaan UGB</h3>
                        @if($perizinan->laporan_status === 'disetujui')
                            <span class="inline-flex items-center rounded-md bg-emerald-500/10 px-2 py-0.5 text-xs font-bold text-emerald-400 ring-1 ring-emerald-500/20">Approved</span>
                        @elseif($perizinan->laporan_status === 'diperiksa')
                            <span class="inline-flex items-center rounded-md bg-blue-500/10 px-2 py-0.5 text-xs font-bold text-blue-400 ring-1 ring-blue-500/20">Menunggu Ulasan</span>
                        @elseif($perizinan->laporan_status === 'perlu_perbaikan')
                            <span class="inline-flex items-center rounded-md bg-amber-500/10 px-2 py-0.5 text-xs font-bold text-amber-400 ring-1 ring-amber-500/20">Perlu Perbaikan</span>
                        @else
                            <span class="inline-flex items-center rounded-md bg-slate-500/10 px-2 py-0.5 text-xs font-bold text-slate-400 ring-1 ring-slate-500/20">Belum Dikirim</span>
                        @endif
                    </div>

                    @if($perizinan->laporan_status)
                        @php $lap = $perizinan->laporan_data ?? []; @endphp
                        <div class="space-y-4">
                            <div>
                                <span class="text-[10px] text-slate-500 block font-bold uppercase tracking-wide">Catatan Pelaksanaan</span>
                                <p class="text-xs text-slate-350 mt-1 leading-relaxed bg-slate-950 p-3.5 rounded-xl border border-slate-905">{{ $lap['catatan_pelaksanaan'] ?? '-' }}</p>
                            </div>

                            <div class="space-y-2">
                                <span class="text-[10px] text-slate-500 block font-bold uppercase tracking-wide">Berkas Laporan</span>
                                @if(isset($lap['dokumen_laporan']))
                                    <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-950/40 border border-slate-900">
                                        <span class="text-xs text-slate-300 font-medium">📄 Laporan Pelaksanaan UGB</span>
                                        <a href="{{ Storage::url($lap['dokumen_laporan']) }}" target="_blank" class="text-xs font-bold text-emerald-400 hover:underline">Unduh &rarr;</a>
                                    </div>
                                @endif
                                @if(isset($lap['daftar_pemenang']))
                                    <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-950/40 border border-slate-900">
                                        <span class="text-xs text-slate-300 font-medium">📋 Daftar Pemenang Undian</span>
                                        <a href="{{ Storage::url($lap['daftar_pemenang']) }}" target="_blank" class="text-xs font-bold text-emerald-400 hover:underline">Unduh &rarr;</a>
                                    </div>
                                @endif
                                @if(isset($lap['dokumentasi_kegiatan']))
                                    <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-950/40 border border-slate-900">
                                        <span class="text-xs text-slate-300 font-medium">📸 Dokumentasi & Foto Saksi</span>
                                        <a href="{{ Storage::url($lap['dokumentasi_kegiatan']) }}" target="_blank" class="text-xs font-bold text-emerald-400 hover:underline">Unduh &rarr;</a>
                                    </div>
                                @endif
                            </div>

                            @if($perizinan->laporan_status === 'perlu_perbaikan' && $perizinan->laporan_catatan)
                                <div class="p-3.5 rounded-2xl bg-amber-500/5 border border-amber-500/20">
                                    <h4 class="text-xs font-bold text-amber-400 mb-1">Catatan Revisi dari Petugas:</h4>
                                    <p class="text-xs text-slate-300">{{ $perizinan->laporan_catatan }}</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-xs text-slate-400 leading-relaxed mb-4">
                            Undian telah disetujui secara resmi. Penyelenggara wajib menyelenggarakan undian sesuai tata tertib, menyegel alat undian bersama saksi, dan mengirimkan laporan pelaksanaan serta daftar pemenang.
                        </p>
                    @endif

                    <!-- Checklist SOP UGB -->
                    <div class="mt-4 p-4 rounded-2xl bg-slate-100 border border-slate-200">
                        <h4 class="text-xs font-bold text-slate-800 mb-3 flex items-center gap-1.5">
                            <span>🗳️</span> Checklist Panduan Pelaksanaan (SOP UGB)
                        </h4>
                        <div class="space-y-2.5">
                            <!-- Step 1 (Auto Checked) -->
                            <label class="flex items-start gap-2.5 text-xs text-slate-400">
                                <input type="checkbox" checked disabled class="mt-0.5 rounded border-slate-300 text-emerald-500 bg-white focus:ring-emerald-500">
                                <span class="line-through text-slate-400">1. Izin Promosi & SK Mensos Terbit (Selesai Sistem)</span>
                            </label>
                            
                            <!-- Step 2 -->
                            <label class="flex items-start gap-2.5 text-xs text-slate-700 cursor-pointer">
                                <input type="checkbox" id="sop_step_2" onchange="toggleSopStep(2)" class="mt-0.5 rounded border-slate-300 text-emerald-500 bg-white focus:ring-emerald-500">
                                <span>2. Surat Undangan Saksi Resmi Dikirim (Notaris, Kepolisian, Dinsos)</span>
                            </label>

                            <!-- Step 3 -->
                            <label class="flex items-start gap-2.5 text-xs text-slate-700 cursor-pointer">
                                <input type="checkbox" id="sop_step_3" onchange="toggleSopStep(3)" class="mt-0.5 rounded border-slate-300 text-emerald-500 bg-white focus:ring-emerald-500">
                                <span>3. Penerbitan Surat Tugas Saksi oleh Dinas Sosial</span>
                            </label>

                            <!-- Step 4 -->
                            <label class="flex items-start gap-2.5 text-xs text-slate-700 cursor-pointer">
                                <input type="checkbox" id="sop_step_4" onchange="toggleSopStep(4)" class="mt-0.5 rounded border-slate-300 text-emerald-500 bg-white focus:ring-emerald-500">
                                <span>4. Pemeriksaan Kelaikan &amp; Uji Coba Alat Pengundian</span>
                            </label>

                            <!-- Step 5 -->
                            <label class="flex items-start gap-2.5 text-xs text-slate-700 cursor-pointer">
                                <input type="checkbox" id="sop_step_5" onchange="toggleSopStep(5)" class="mt-0.5 rounded border-slate-300 text-emerald-500 bg-white focus:ring-emerald-500">
                                <span>5. Penyegelan Perangkat / Alat dengan Stiker Segel</span>
                            </label>

                            <!-- Step 6 -->
                            <label class="flex items-start gap-2.5 text-xs text-slate-700 cursor-pointer">
                                <input type="checkbox" id="sop_step_6" onchange="toggleSopStep(6)" class="mt-0.5 rounded border-slate-300 text-emerald-500 bg-white focus:ring-emerald-500">
                                <span>6. Pembacaan Tata Tertib Penarikan Undian</span>
                            </label>

                            <!-- Step 7 -->
                            <label class="flex items-start gap-2.5 text-xs text-slate-700 cursor-pointer">
                                <input type="checkbox" id="sop_step_7" onchange="toggleSopStep(7)" class="mt-0.5 rounded border-slate-300 text-emerald-500 bg-white focus:ring-emerald-500">
                                <span>7. Pelepasan Stiker Segel &amp; Penarikan Undian</span>
                            </label>

                            <!-- Step 8 -->
                            <label class="flex items-start gap-2.5 text-xs text-slate-400">
                                <input type="checkbox" id="sop_step_8" disabled class="mt-0.5 rounded border-slate-300 text-emerald-500 bg-white focus:ring-emerald-500">
                                <span id="sop_step_8_label">8. Pengiriman Laporan Pelaksanaan UGB Resmi</span>
                            </label>
                        </div>
                        <div class="mt-3.5 pt-3 border-t border-slate-200 flex justify-between items-center text-[10px]">
                            <span class="text-slate-500">Progres Pelaksanaan: <strong class="text-emerald-600 font-bold" id="sop_progress_text">1/8 Selesai</strong></span>
                            <a href="{{ route('perizinan.sop.ugb') }}" target="_blank" class="text-emerald-600 font-bold hover:underline flex items-center gap-1">
                                Lihat Visual SOP &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Tombol Pengiriman Laporan (Khusus Pemohon) -->
                    @if($perizinan->pemohon_id === $user->id)
                        <div class="mt-4">
                            @if($perizinan->laporan_status === 'disetujui')
                                {{-- Laporan sudah disetujui — tidak ada lagi yang bisa dilakukan --}}
                                <div class="w-full inline-flex items-center justify-center rounded-xl bg-emerald-500/10 border border-emerald-500/20 py-2.5 text-xs font-bold text-emerald-400 gap-2">
                                    ✅ Laporan Pelaksanaan Telah Disetujui
                                </div>
                            @elseif($perizinan->laporan_status === 'diperiksa')
                                {{-- Laporan sedang ditinjau — tidak bisa kirim lagi --}}
                                <div class="w-full inline-flex items-center justify-center rounded-xl bg-blue-500/10 border border-blue-500/20 py-2.5 text-xs font-bold text-blue-400 gap-2">
                                    ⏳ Laporan Sedang Ditinjau Petugas...
                                </div>
                            @else
                                {{-- Belum kirim atau perlu perbaikan — tampilkan tombol --}}
                                <a href="{{ route('perizinan.laporan.form', $perizinan->id) }}" class="w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 py-2.5 text-xs font-bold text-slate-950 shadow-md hover:opacity-90 hover:scale-[1.01] transition-all duration-200">
                                    {{ $perizinan->laporan_status === 'perlu_perbaikan' ? '✏️ Perbaiki Laporan Pelaksanaan' : '📤 Kirim Laporan Pelaksanaan UGB' }}
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- ================== RIGHT PANEL: TRACKING TIMELINE & REVIEW ACTION ================== -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Real-time vertical tracking timeline -->
            <div class="glass-panel rounded-3xl p-6">
                <h3 class="font-extrabold text-white text-base border-b border-slate-900 pb-4 mb-6">Status Pelacakan Alur</h3>
                
                <div class="relative pl-6 border-l border-slate-800 space-y-6">
                    @php
                        $histories = $perizinan->history_status ?? [];
                    @endphp

                    @foreach($histories as $idx => $h)
                        <div class="relative">
                            <!-- Timeline Dot -->
                            <span class="absolute -left-[31px] top-1 flex h-4.5 w-4.5 items-center justify-center rounded-full bg-emerald-500 text-[10px] ring-4 ring-slate-950">
                                ✓
                            </span>
                            <div>
                                <div class="flex items-center justify-between gap-2">
                                    <h4 class="text-xs font-bold text-white">{{ $h['tahap'] }} - {{ $h['status'] }}</h4>
                                    <span class="text-[9px] text-slate-500 font-semibold uppercase">{{ \Carbon\Carbon::parse($h['waktu'])->format('d M H:i') }}</span>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-0.5">Oleh: <strong>{{ $h['oleh'] }}</strong> ({{ $h['role'] }})</p>
                                @if(isset($h['catatan']))
                                    <p class="text-[11px] text-slate-300 bg-slate-950/60 p-2.5 rounded-xl border border-slate-900/60 mt-2 leading-relaxed">
                                        {{ $h['catatan'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <!-- In Progress Step if still active -->
                    @if($perizinan->status === 'diperiksa')
                        <div class="relative">
                            <span class="absolute -left-[31px] top-1 flex h-4.5 w-4.5 animate-pulse items-center justify-center rounded-full bg-blue-500 text-[10px] ring-4 ring-slate-950">
                                ⏳
                            </span>
                            <div>
                                <h4 class="text-xs font-bold text-blue-400">
                                    Sedang Ditinjau: 
                                    @if($perizinan->tahap_verifikasi === 'sekretariat')
                                        Kelengkapan Awal (Sekretariat)
                                    @elseif($perizinan->tahap_verifikasi === 'verifikator')
                                        Legalitas Administrasi (Verifikator)
                                    @elseif($perizinan->tahap_verifikasi === 'dinsos_wilayah')
                                        Konfirmasi Wilayah (Dinsos Kab/Kota)
                                    @elseif($perizinan->tahap_verifikasi === 'bidang_teknis')
                                        Substansi Kegiatan (Bidang Teknis)
                                    @elseif($perizinan->tahap_verifikasi === 'kepala_dinas')
                                        Persetujuan Akhir (Kepala Dinas)
                                    @endif
                                </h4>
                                <p class="text-[10px] text-slate-500 mt-0.5">Status antrean berjalan. Menunggu verifikasi dari petugas terkait.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- OFFICER ACTION PANEL -->
            @if($perizinan->status === 'diperiksa' && !$perizinan->perlu_perbaikan)
                @php
                    $isRoleMatch = false;
                    if($user->isSekretariat() && $perizinan->tahap_verifikasi === 'sekretariat') { $isRoleMatch = true; }
                    elseif($user->isVerifikator() && $perizinan->tahap_verifikasi === 'verifikator') { $isRoleMatch = true; }
                    elseif($user->isDinsosWilayah() && $perizinan->tahap_verifikasi === 'dinsos_wilayah') { $isRoleMatch = true; }
                    elseif($user->isBidangPemberdayaan() && $perizinan->tahap_verifikasi === 'bidang_teknis' && in_array($perizinan->jenis_layanan, ['ugb', 'pub', 'lks'])) { $isRoleMatch = true; }
                    elseif($user->isBidangLinjamsos() && $perizinan->tahap_verifikasi === 'bidang_teknis' && $perizinan->jenis_layanan === 'adopsi') { $isRoleMatch = true; }
                    elseif($user->isKadinas() && $perizinan->tahap_verifikasi === 'kepala_dinas') { $isRoleMatch = true; }
                    elseif($user->isAdmin()) { $isRoleMatch = true; } // Admin bypass
                @endphp

                @if($isRoleMatch)
                    <div class="glass-panel rounded-3xl p-6 border-indigo-500/20 bg-indigo-500/5 glow-indigo">
                        <h3 class="font-extrabold text-white text-base border-b border-indigo-500/10 pb-4 mb-4 flex items-center gap-2">
                            <span>🔑</span> Panel Keputusan Petugas
                        </h3>
                        <p class="text-[11px] text-slate-400 mb-4">Ulas dokumen di sebelah kiri, lalu pilih tindakan keputusan di bawah ini.</p>

                        <form action="{{ route('admin.perizinan.process', $perizinan->id) }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <!-- Decision options -->
                            <div class="space-y-1.5">
                                <label for="action" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Tindakan Ulasan</label>
                                <select id="action" name="action" required onchange="toggleFormFields(this.value)"
                                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-indigo-500">
                                    <option value="approve">
                                        @if($perizinan->tahap_verifikasi === 'sekretariat') Lengkap (Teruskan ke Verifikator)
                                        @elseif($perizinan->tahap_verifikasi === 'verifikator') Valid (Teruskan ke Bidang/Wilayah)
                                        @elseif($perizinan->tahap_verifikasi === 'dinsos_wilayah') Rekomendasi Layak (Teruskan ke Bidang)
                                        @elseif($perizinan->tahap_verifikasi === 'bidang_teknis') Kirim Draft Rekomendasi ke Kadinas
                                        @elseif($perizinan->tahap_verifikasi === 'kepala_dinas') Sah & Setujui Permohonan (Terbit Dokumen)
                                        @endif
                                    </option>
                                    <option value="perbaikan">Kembalikan untuk Perbaikan Dokumen</option>
                                    <option value="reject">Tolak Permohonan (Permanen)</option>
                                </select>
                            </div>

                            <!-- Bidang Teknis Input for Recommendation draft number -->
                            @if($perizinan->tahap_verifikasi === 'bidang_teknis')
                                <div id="nomor_rekomendasi_field" class="space-y-1.5">
                                    <label for="nomor_surat_rekomendasi" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nomor Surat Draft Rekomendasi</label>
                                    <input type="text" id="nomor_surat_rekomendasi" name="nomor_surat_rekomendasi" value="REK-{{ strtoupper($perizinan->jenis_layanan) }}-{{ date('Y') }}-{{ rand(100,999) }}"
                                        class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500">
                                </div>
                            @endif

                            <!-- Display recommendation draft if Kepala Dinas is reviewing -->
                            @if($perizinan->tahap_verifikasi === 'kepala_dinas')
                                <div class="p-3.5 rounded-2xl bg-slate-950 border border-slate-900 space-y-2">
                                    <h4 class="text-xs font-bold text-indigo-400">Rekomendasi dari Bidang Teknis:</h4>
                                    <p class="text-[11px] text-slate-300 font-semibold">Nomor Draft: {{ $data['draft_nomor_rekomendasi'] ?? '-' }}</p>
                                    <p class="text-[11px] text-slate-400 italic">"{{ $data['draft_catatan_bidang'] ?? '-' }}"</p>
                                </div>
                            @endif

                            <div class="space-y-1.5">
                                <label for="catatan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Catatan Pertimbangan / Alasan Perbaikan</label>
                                <textarea id="catatan" name="catatan" required rows="3"
                                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500"
                                    placeholder="Tuliskan catatan ulasan kelayakan berkas, atau alasan pengembalian dokumen..."></textarea>
                            </div>

                            <button type="submit" class="w-full rounded-xl bg-indigo-600 py-3 text-xs font-bold text-white shadow-md hover:bg-indigo-500 transition duration-200">
                                Kirim Keputusan Verifikasi
                            </button>
                        </form>
                    </div>
                @endif
            @endif

            <!-- OFFICER UGB REPORT ACTION PANEL -->
            @if($perizinan->status === 'selesai' && $perizinan->jenis_layanan === 'ugb' && $perizinan->laporan_status === 'diperiksa')
                @if($user->isBidangPemberdayaan() || $user->isAdmin())
                    <div class="glass-panel rounded-3xl p-6 border-indigo-500/20 bg-indigo-500/5 glow-indigo mt-6">
                        <h3 class="font-extrabold text-white text-base border-b border-indigo-500/10 pb-4 mb-4 flex items-center gap-2">
                            <span>🔑</span> Panel Keputusan Laporan UGB
                        </h3>
                        <p class="text-[11px] text-slate-400 mb-4">Ulas dokumen laporan pelaksanaan di sebelah kiri, lalu pilih keputusan verifikasi.</p>

                        <form action="{{ route('admin.perizinan.laporan.process', $perizinan->id) }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <div class="space-y-1.5">
                                <label for="laporan_action" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Tindakan Laporan</label>
                                <select id="laporan_action" name="action" required
                                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-indigo-500">
                                    <option value="approve">Setujui & Sahkan Laporan Pelaksanaan</option>
                                    <option value="perbaikan">Kembalikan Laporan untuk Direvisi / Diperbaiki</option>
                                </select>
                            </div>

                            <div class="space-y-1.5">
                                <label for="laporan_catatan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Catatan Pertimbangan / Alasan Revisi</label>
                                <textarea id="laporan_catatan" name="catatan" required rows="3"
                                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500"
                                    placeholder="Tuliskan catatan pertimbangan ulasan laporan..."></textarea>
                            </div>

                            <button type="submit" class="w-full rounded-xl bg-indigo-600 py-3 text-xs font-bold text-white shadow-md hover:bg-indigo-500 transition duration-200">
                                Kirim Keputusan Laporan
                            </button>
                        </form>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleFormFields(action) {
        const nomField = document.getElementById('nomor_rekomendasi_field');
        if (nomField) {
            if (action === 'approve') {
                nomField.style.display = 'block';
                nomField.querySelector('input').setAttribute('required', 'required');
            } else {
                nomField.style.display = 'none';
                nomField.querySelector('input').removeAttribute('required');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const isReportSubmitted = @json(!is_null($perizinan->laporan_status));
        const step8Checkbox = document.getElementById('sop_step_8');
        const step8Label = document.getElementById('sop_step_8_label');
        
        if (isReportSubmitted && step8Checkbox) {
            step8Checkbox.checked = true;
            if (step8Label) step8Label.classList.add('line-through', 'text-slate-400');
        }

        const keyPrefix = 'sop_ugb_checked_{{ $perizinan->id }}_';
        for (let i = 2; i <= 7; i++) {
            const el = document.getElementById('sop_step_' + i);
            if (el) {
                const checked = localStorage.getItem(keyPrefix + i) === 'true';
                el.checked = checked;
                if (checked) {
                    el.parentElement.classList.add('line-through', 'text-slate-400');
                }
            }
        }
        updateSopProgress();
    });

    window.toggleSopStep = function(stepNum) {
        const el = document.getElementById('sop_step_' + stepNum);
        const key = 'sop_ugb_checked_{{ $perizinan->id }}_' + stepNum;
        localStorage.setItem(key, el.checked);
        if (el.checked) {
            el.parentElement.classList.add('line-through', 'text-slate-400');
        } else {
            el.parentElement.classList.remove('line-through', 'text-slate-400');
        }
        updateSopProgress();
    }

    function updateSopProgress() {
        let completed = 1; // Step 1 is always completed
        if (@json(!is_null($perizinan->laporan_status))) {
            completed++; // Step 8
        }
        for (let i = 2; i <= 7; i++) {
            const el = document.getElementById('sop_step_' + i);
            if (el && el.checked) {
                completed++;
            }
        }
        const txt = document.getElementById('sop_progress_text');
        if (txt) {
            txt.textContent = completed + '/8 Selesai';
        }
    }
</script>
@endsection
