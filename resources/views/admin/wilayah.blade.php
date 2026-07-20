@extends('layouts.app')

@section('title', 'Dashboard Dinsos Wilayah')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">



    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-emerald-500/10 text-emerald-600 ring-1 ring-emerald-500/20 mb-2">
                PETUGAS / KABUPATEN-KOTA
            </span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Antrean Dinsos Wilayah</h1>
            <p class="text-sm text-slate-500 mt-1">Mengurus peninjauan lapangan (survei lokasi/kegiatan) dan mengeluarkan konfirmasi kelayakan.</p>
        </div>
    </div>

    <!-- Queue Table -->
    <div class="glass-panel rounded-2xl overflow-hidden mb-10">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-base">Antrean Konfirmasi Wilayah / Lokasi ({{ count($queues) }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 text-xs font-bold text-slate-500 uppercase bg-slate-50">
                        <th class="px-6 py-4">Tanggal Pengajuan</th>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4">Jenis Layanan</th>
                        <th class="px-6 py-4">Status Alur</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($queues as $q)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-xs font-medium text-slate-500">
                                {{ $q->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900 text-sm">{{ $q->pemohon->name }}</div>
                                @if($q->pemohon->nama_lembaga)
                                    <div class="text-[10px] text-slate-500 mt-0.5 font-medium">{{ $q->pemohon->nama_lembaga }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-slate-700">
                                @if($q->jenis_layanan === 'ugb') Undian Gratis Berhadiah (UGB)
                                @elseif($q->jenis_layanan === 'pub') Pengumpulan Uang/Barang (PUB)
                                @elseif($q->jenis_layanan === 'lks') Izin Operasional LKS
                                @elseif($q->jenis_layanan === 'adopsi') Rekomendasi Adopsi Anak
                                @endif
                                <div class="text-[10px] text-slate-400 mt-0.5">ID: #{{ $q->id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-blue-500/10 text-blue-600 ring-1 ring-blue-500/20">
                                    MENUNGGU SURVEI & KONFIRMASI
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('perizinan.show', $q->id) }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600/15 border border-emerald-500/25 px-4 py-2 text-xs font-bold text-emerald-600 hover:bg-emerald-600 hover:text-white transition">
                                    🔑 Ulas &amp; Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-xs text-slate-400">
                                Antrean kosong. Semua survei lokasi telah selesai dilaporkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
