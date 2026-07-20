@extends('layouts.app')

@section('title', 'Layanan Perizinan & Rekomendasi Sosial')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Portal Perizinan & Rekomendasi Sosial</h1>
            <p class="text-sm text-slate-400 mt-1">Ajukan, kelola, dan pantau status permohonan perizinan sosial Anda secara transparan.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('perizinan.create') }}" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-5 py-2.5 text-xs font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-90 hover:scale-[1.02] transition-all duration-200">
                + Ajukan Permohonan Baru
            </a>
        </div>
    </div>

    <!-- Stats summary for Pemohon -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Permohonan</span>
                <span class="text-slate-400">📄</span>
            </div>
            <h3 class="text-2xl font-black text-white">{{ $perizinans->count() }}</h3>
        </div>
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Sedang Diproses</span>
                <span class="text-blue-400">⏳</span>
            </div>
            <h3 class="text-2xl font-black text-white">{{ $perizinans->where('status', 'diperiksa')->count() }}</h3>
        </div>
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Telah Terbit</span>
                <span class="text-emerald-400">✅</span>
            </div>
            <h3 class="text-2xl font-black text-white">{{ $perizinans->where('status', 'selesai')->count() }}</h3>
        </div>
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Butuh Perbaikan</span>
                <span class="text-amber-400">⚠️</span>
            </div>
            <h3 class="text-2xl font-black text-white">{{ $perizinans->where('perlu_perbaikan', true)->count() }}</h3>
        </div>
    </div>

    <!-- Application Table -->
    <div class="glass-panel rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-900 bg-slate-900/30 flex justify-between items-center">
            <h3 class="font-bold text-white text-base">Daftar Pengajuan Anda</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-900 text-xs font-bold text-slate-400 uppercase bg-slate-950/40">
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Layanan</th>
                        <th class="px-6 py-4">Nomor Izin / Rekomendasi</th>
                        <th class="px-6 py-4">Tahapan Verifikasi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-900">
                    @forelse($perizinans as $p)
                        <tr class="hover:bg-slate-900/20 transition">
                            <td class="px-6 py-4 text-xs font-medium text-slate-400">
                                {{ $p->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-white text-sm">
                                    @if($p->jenis_layanan === 'ugb')
                                        Undian Gratis Berhadiah (UGB)
                                    @elseif($p->jenis_layanan === 'pub')
                                        Pengumpulan Uang/Barang (PUB)
                                    @elseif($p->jenis_layanan === 'lks')
                                        Izin Operasional LKS
                                    @elseif($p->jenis_layanan === 'adopsi')
                                        Rekomendasi Adopsi Anak
                                    @endif
                                </div>
                                <div class="text-[11px] text-slate-500 mt-0.5">ID: #{{ $p->id }}</div>
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-slate-300">
                                {{ $p->nomor_izin ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($p->status === 'draft')
                                    <span class="text-xs text-slate-500 font-semibold">DRAFT</span>
                                @elseif($p->status === 'selesai')
                                    <span class="text-xs text-emerald-400 font-bold flex items-center gap-1">
                                        <span>🟢</span> Dokumen Terbit
                                    </span>
                                @elseif($p->status === 'ditolak')
                                    <span class="text-xs text-rose-500 font-bold">Ditolak Permanen</span>
                                @else
                                    <div class="flex flex-col">
                                        <span class="text-xs text-slate-200 font-semibold">
                                            @if($p->tahap_verifikasi === 'sekretariat')
                                                Pemeriksaan Awal (Sekretariat)
                                            @elseif($p->tahap_verifikasi === 'verifikator')
                                                Verifikasi Legalitas
                                            @elseif($p->tahap_verifikasi === 'dinsos_wilayah')
                                                Konfirmasi Wilayah
                                            @elseif($p->tahap_verifikasi === 'bidang_teknis')
                                                Telaah Substansi Bidang
                                            @elseif($p->tahap_verifikasi === 'kepala_dinas')
                                                Persetujuan Kepala Dinas
                                            @endif
                                        </span>
                                        @if($p->perlu_perbaikan)
                                            <span class="text-[10px] text-amber-400 font-medium mt-0.5">⚠️ Perlu Perbaikan Dokumen</span>
                                        @else
                                            <span class="text-[10px] text-slate-400 font-medium mt-0.5">Menunggu Ulasan Petugas</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold {{ $p->status === 'ditolak' ? 'bg-rose-500/10 text-rose-400 ring-1 ring-rose-500/20' : ($p->status === 'selesai' ? 'bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/20' : 'bg-blue-500/10 text-blue-400 ring-1 ring-blue-500/20') }}">
                                    {{ strtoupper($p->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('perizinan.show', $p->id) }}" class="rounded-lg bg-slate-900 px-3 py-1.5 text-xs font-bold text-slate-300 border border-slate-800 hover:bg-slate-800 hover:text-white transition">
                                        Detail
                                    </a>
                                    @if($p->perlu_perbaikan || $p->status === 'draft')
                                        <a href="{{ route('perizinan.edit', $p->id) }}" class="rounded-lg bg-amber-500/10 px-3 py-1.5 text-xs font-bold text-amber-400 border border-amber-500/20 hover:bg-amber-500/20 transition">
                                            Perbaiki
                                        </a>
                                    @endif
                                    @if($p->status === 'selesai')
                                        <a href="{{ route('perizinan.download_pdf', $p->id) }}" target="_blank" class="rounded-lg bg-emerald-500/10 px-3 py-1.5 text-xs font-bold text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500/20 transition">
                                            Unduh
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-slate-400 text-sm">Belum ada pengajuan perizinan/rekomendasi.</div>
                                <a href="{{ route('perizinan.create') }}" class="inline-block mt-4 text-xs font-bold text-emerald-400 hover:underline">Ajukan permohonan pertama Anda sekarang &rarr;</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
