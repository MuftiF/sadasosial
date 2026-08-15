@extends('layouts.app')

@section('title', 'Monitoring Rujukan Rehabilitasi Sosial (PB 3.7)')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('rehabilitasi.index') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-2">
            &larr; Kembali ke Portal Utama
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Monitoring Rujukan Rehabilitasi (Subproses 3.7)</h1>
        <p class="text-sm text-slate-500 mt-1">Lacak status penerimaan, perkembangan penanganan rujukan klien di UPTD / Lembaga Mitra Dinas Sosial.</p>
    </div>

    <!-- Stats widgets -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="glass-panel rounded-2xl p-6 glow-emerald">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Kasus Dirujuk</span>
                <span class="text-xl">📋</span>
            </div>
            <h2 class="text-2xl font-black text-slate-900">{{ $stats['total_rujukan'] }}</h2>
            <p class="text-[11px] text-slate-500 mt-1">Kasus membutuhkan rujukan</p>
        </div>

        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Menunggu Tanggapan</span>
                <span class="text-xl">⏳</span>
            </div>
            <h2 class="text-2xl font-black text-amber-600">{{ $stats['pending'] }}</h2>
            <p class="text-[11px] text-slate-500 mt-1">Pending kapasitas UPTD</p>
        </div>

        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rujukan Diterima</span>
                <span class="text-xl">✅</span>
            </div>
            <h2 class="text-2xl font-black text-emerald-600">{{ $stats['diterima'] }}</h2>
            <p class="text-[11px] text-slate-500 mt-1">Klien aktif di UPTD/Mitra</p>
        </div>

        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rujukan Ditolak</span>
                <span class="text-xl">❌</span>
            </div>
            <h2 class="text-2xl font-black text-rose-600">{{ $stats['ditolak'] }}</h2>
            <p class="text-[11px] text-slate-500 mt-1">Perlu alur alternatif</p>
        </div>
    </div>

    <!-- Rujukan Table -->
    <div class="glass-panel rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-xs">
                <thead>
                    <tr>
                        <th class="p-4 font-bold text-slate-600">ID Kasus</th>
                        <th class="p-4 font-bold text-slate-600">Nama Klien</th>
                        <th class="p-4 font-bold text-slate-600">Program / Kategori</th>
                        <th class="p-4 font-bold text-slate-600">Lembaga Rujukan</th>
                        <th class="p-4 font-bold text-slate-600">Status Penerimaan</th>
                        <th class="p-4 font-bold text-slate-600">Progres Terakhir</th>
                        <th class="p-4 font-bold text-slate-600 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($rujukans as $item)
                        <tr>
                            <td class="p-4 text-slate-500">#{{ $item->id }}</td>
                            <td class="p-4 text-slate-900 font-bold">{{ $item->nama_klien }}</td>
                            <td class="p-4 text-slate-900">{{ $item->kategori_label }}</td>
                            <td class="p-4 text-indigo-600 font-bold">{{ $item->nama_uptd_lembaga }}</td>
                            <td class="p-4">
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 font-bold uppercase text-[9px] 
                                    @if($item->status_penerimaan_uptd === 'pending') bg-amber-100 text-amber-800 ring-1 ring-inset ring-amber-200
                                    @elseif($item->status_penerimaan_uptd === 'diterima') bg-emerald-100 text-emerald-800 ring-1 ring-inset ring-emerald-200
                                    @elseif($item->status_penerimaan_uptd === 'ditolak') bg-rose-100 text-rose-800 ring-1 ring-inset ring-rose-200
                                    @endif">
                                    {{ strtoupper($item->status_penerimaan_uptd) }}
                                </span>
                            </td>
                            <td class="p-4 max-w-xs truncate text-slate-600 italic">
                                @if(is_array($item->progress_layanan) && count($item->progress_layanan) > 0)
                                    "{{ collect($item->progress_layanan)->last()['log'] }}"
                                @else
                                    <span class="text-slate-400">Belum ada progres dilaporkan</span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <a href="{{ route('rehabilitasi.show', $item->id) }}" class="text-emerald-600 hover:text-emerald-800 font-bold">Buka Pelacakan &rarr;</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-500">Belum ada data rujukan pelayanan rehabilitasi sosial terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($rujukans->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $rujukans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
