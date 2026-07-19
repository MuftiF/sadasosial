@extends('layouts.app')

@section('title', 'Pilih Jenis Layanan Perizinan')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-10">
        <a href="{{ route('perizinan.index') }}" class="text-xs font-bold text-emerald-400 hover:underline flex items-center gap-1.5 mb-4">
            &larr; Kembali ke Dashboard
        </a>
        <h1 class="text-3xl font-extrabold text-white tracking-tight">Ajukan Permohonan Baru</h1>
        <p class="text-sm text-slate-400 mt-1">Pilih salah satu jenis pelayanan perizinan atau rekomendasi sosial di bawah ini.</p>
    </div>

    <!-- Catalog Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- UGB Card -->
        <div class="glass-panel rounded-3xl p-8 hover:border-emerald-500/30 transition duration-300 flex flex-col justify-between group">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-400 text-2xl group-hover:scale-110 transition duration-200">
                        🎁
                    </span>
                    <span class="inline-flex items-center rounded-full bg-slate-900 px-2.5 py-1 text-[10px] font-bold text-slate-400 ring-1 ring-slate-800">
                        Subproses 8.1
                    </span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Undian Gratis Berhadiah (UGB)</h3>
                <p class="text-xs text-slate-400 leading-relaxed mb-6">
                    Penerbitan izin/rekomendasi penyelenggaraan undian gratis berhadiah yang ditujukan untuk promosi produk, jasa, atau kegiatan komersial lembaga/perusahaan.
                </p>
                <div class="border-t border-slate-900 pt-4 mb-6">
                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Persyaratan Dokumen:</h4>
                    <ul class="text-[11px] text-slate-500 space-y-1.5">
                        <li class="flex items-center gap-1.5">✔️ Proposal Lengkap & Mekanisme</li>
                        <li class="flex items-center gap-1.5">✔️ Draft Surat Pernyataan / Hadiah</li>
                        <li class="flex items-center gap-1.5">✔️ Akta Notaris & Legalitas Lembaga</li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('perizinan.form', 'ugb') }}" class="block w-full text-center rounded-xl bg-slate-900 py-3 text-xs font-bold text-slate-200 ring-1 ring-slate-800 hover:bg-emerald-500 hover:text-slate-950 hover:ring-0 transition duration-200">
                Mulai Pengajuan &rarr;
            </a>
        </div>

        <!-- PUB Card -->
        <div class="glass-panel rounded-3xl p-8 hover:border-emerald-500/30 transition duration-300 flex flex-col justify-between group">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-400 text-2xl group-hover:scale-110 transition duration-200">
                        💰
                    </span>
                    <span class="inline-flex items-center rounded-full bg-slate-900 px-2.5 py-1 text-[10px] font-bold text-slate-400 ring-1 ring-slate-800">
                        Subproses 8.2
                    </span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Pengumpulan Uang atau Barang (PUB)</h3>
                <p class="text-xs text-slate-400 leading-relaxed mb-6">
                    Izin/rekomendasi pengumpulan sumbangan berupa uang atau barang dari masyarakat untuk keperluan penanggulangan bencana, sosial, pendidikan, atau keagamaan.
                </p>
                <div class="border-t border-slate-900 pt-4 mb-6">
                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Persyaratan Dokumen:</h4>
                    <ul class="text-[11px] text-slate-500 space-y-1.5">
                        <li class="flex items-center gap-1.5">✔️ Proposal & Tujuan Kegiatan</li>
                        <li class="flex items-center gap-1.5">✔️ Rekening Bank atas nama Lembaga</li>
                        <li class="flex items-center gap-1.5">✔️ Akta Notaris & SK Organisasi</li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('perizinan.form', 'pub') }}" class="block w-full text-center rounded-xl bg-slate-900 py-3 text-xs font-bold text-slate-200 ring-1 ring-slate-800 hover:bg-emerald-500 hover:text-slate-950 hover:ring-0 transition duration-200">
                Mulai Pengajuan &rarr;
            </a>
        </div>

        <!-- LKS Card -->
        <div class="glass-panel rounded-3xl p-8 hover:border-emerald-500/30 transition duration-300 flex flex-col justify-between group">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-400 text-2xl group-hover:scale-110 transition duration-200">
                        🏢
                    </span>
                    <span class="inline-flex items-center rounded-full bg-slate-900 px-2.5 py-1 text-[10px] font-bold text-slate-400 ring-1 ring-slate-800">
                        Subproses 8.3
                    </span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Tanda Daftar & Izin Operasional LKS</h3>
                <p class="text-xs text-slate-400 leading-relaxed mb-6">
                    Penerbitan surat tanda terdaftar dan izin operasional untuk Lembaga Kesejahteraan Sosial (LKS) agar sah menyelenggarakan layanan sosial.
                </p>
                <div class="border-t border-slate-900 pt-4 mb-6">
                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Persyaratan Dokumen:</h4>
                    <ul class="text-[11px] text-slate-500 space-y-1.5">
                        <li class="flex items-center gap-1.5">✔️ Akta Notaris LKS & AD/ART</li>
                        <li class="flex items-center gap-1.5">✔️ Struktur Pengurus & Domisili</li>
                        <li class="flex items-center gap-1.5">✔️ Foto Sarana Prasarana Layanan</li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('perizinan.form', 'lks') }}" class="block w-full text-center rounded-xl bg-slate-900 py-3 text-xs font-bold text-slate-200 ring-1 ring-slate-800 hover:bg-emerald-500 hover:text-slate-950 hover:ring-0 transition duration-200">
                Mulai Pengajuan &rarr;
            </a>
        </div>

        <!-- ADOPSI Card -->
        <div class="glass-panel rounded-3xl p-8 hover:border-emerald-500/30 transition duration-300 flex flex-col justify-between group">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-400 text-2xl group-hover:scale-110 transition duration-200">
                        👶
                    </span>
                    <span class="inline-flex items-center rounded-full bg-slate-900 px-2.5 py-1 text-[10px] font-bold text-slate-400 ring-1 ring-slate-800">
                        Subproses 8.4
                    </span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Rekomendasi Pengangkatan Anak</h3>
                <p class="text-xs text-slate-400 leading-relaxed mb-6">
                    Pengajuan rekomendasi sosial pengangkatan/adopsi anak oleh Calon Orang Tua Angkat (COTA) sebelum masuk ke proses pengadilan.
                </p>
                <div class="border-t border-slate-900 pt-4 mb-6">
                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Persyaratan Dokumen:</h4>
                    <ul class="text-[11px] text-slate-500 space-y-1.5">
                        <li class="flex items-center gap-1.5">✔️ KTP & KK Suami Istri</li>
                        <li class="flex items-center gap-1.5">✔️ Surat Nikah & Keterangan Sehat</li>
                        <li class="flex items-center gap-1.5">✔️ Rekening / Bukti Penghasilan</li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('perizinan.form', 'adopsi') }}" class="block w-full text-center rounded-xl bg-slate-900 py-3 text-xs font-bold text-slate-200 ring-1 ring-slate-800 hover:bg-emerald-500 hover:text-slate-950 hover:ring-0 transition duration-200">
                Mulai Pengajuan &rarr;
            </a>
        </div>

    </div>
</div>
@endsection
