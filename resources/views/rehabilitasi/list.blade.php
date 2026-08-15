@extends('layouts.app')

@section('title', 'Daftar Kasus - ' . ucfirst($kategori))

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('rehabilitasi.index') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-2">
                &larr; Kembali ke Portal Utama
            </a>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                @if($kategori === 'anak') Rehabilitasi Sosial Anak
                @elseif($kategori === 'lansia') Rehabilitasi Lanjut Usia
                @elseif($kategori === 'disabilitas') Penyandang Disabilitas
                @elseif($kategori === 'tuna_sosial') Tuna Sosial &amp; Warga Rentan
                @elseif($kategori === 'kekerasan') Korban Kekerasan &amp; TPPO
                @elseif($kategori === 'napza') Korban NAPZA &amp; ODHA
                @endif
            </h1>
            <p class="text-sm text-slate-500 mt-1">Kelola dan pantau daftar pengajuan rehabilitasi sosial.</p>
        </div>
        <div class="flex items-center gap-3">
            @if($kategori === 'anak')
                <a href="{{ route('rehabilitasi.sop.gizi_anak') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-slate-200 ring-1 ring-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                    📋 Alur SOP Bansos Gizi Anak
                </a>
            @endif
            @if(!Auth::user()->isStaff() || Auth::user()->isAdmin())
                <a href="{{ route('rehabilitasi.create', $kategori) }}" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2.5 text-xs font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-90 transition duration-200">
                    + Daftarkan Kasus Baru
                </a>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="glass-panel rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-xs">
                <thead>
                    <tr>
                        <th class="p-4 font-bold text-slate-600">ID</th>
                        <th class="p-4 font-bold text-slate-600">Nama Klien</th>
                        <th class="p-4 font-bold text-slate-600">NIK</th>
                        <th class="p-4 font-bold text-slate-600">Kabupaten / Kota</th>
                        <th class="p-4 font-bold text-slate-600">Terdaftar Pada</th>
                        <th class="p-4 font-bold text-slate-600">Rujukan UPTD</th>
                        <th class="p-4 font-bold text-slate-600">Status Workflow</th>
                        <th class="p-4 font-bold text-slate-600 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($data as $item)
                        <tr>
                            <td class="p-4 text-slate-500">#{{ $item->id }}</td>
                            <td class="p-4 text-slate-900 font-bold">{{ $item->nama_klien }}</td>
                            <td class="p-4 text-slate-600">{{ $item->nik }}</td>
                            <td class="p-4 text-slate-600">{{ $item->kab_kota }}</td>
                            <td class="p-4 text-slate-600">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="p-4">
                                @if($item->perlu_rujukan)
                                    <span class="text-indigo-600 font-bold block">{{ $item->nama_uptd_lembaga }}</span>
                                    <span class="text-[9px] text-slate-400">Penerimaan: {{ strtoupper($item->status_penerimaan_uptd) }}</span>
                                @else
                                    <span class="text-slate-400">Tidak Dirujuk</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 font-bold uppercase text-[9px] 
                                    @if($item->status_workflow === 'diajukan') bg-slate-100 text-slate-600 ring-1 ring-inset ring-slate-200
                                    @elseif($item->status_workflow === 'selesai') bg-emerald-100 text-emerald-800 ring-1 ring-inset ring-emerald-200
                                    @elseif(str_contains($item->status_workflow, 'ditolak')) bg-rose-100 text-rose-800 ring-1 ring-inset ring-rose-200
                                    @else bg-blue-100 text-blue-800 ring-1 ring-inset ring-blue-200
                                    @endif">
                                    {{ str_replace('_', ' ', $item->status_workflow) }}
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <a href="{{ route('rehabilitasi.show', $item->id) }}" class="text-emerald-600 hover:text-emerald-800 font-bold">Lihat Detail &rarr;</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-slate-500">Belum ada data kasus rehabilitasi sosial yang terdaftar untuk kategori ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($data->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
