@extends('layouts.app')

@section('title', 'Kegiatan Kesetiakawanan & Penyuluhan - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('pemberdayaan.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">&larr; Portal Pemberdayaan</a>
                <span class="text-slate-300">/</span>
                <span class="text-sm text-slate-500 font-medium">Subproses 2.4</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Kegiatan Kesetiakawanan, Restorasi &amp; Penyuluhan Sosial</h1>
            <p class="text-sm text-slate-600">Agenda kegiatan penyuluhan sosial, restorasi, dan peringatan Hari Kesetiakawanan Sosial Nasional (HKSN).</p>
        </div>
        @if(Auth::user()->isStaff())
            <div>
                <a href="{{ route('pemberdayaan.kesetiakawanan.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-bold text-white shadow-md hover:bg-indigo-700 transition">
                    + Buat Rencana Kegiatan Baru
                </a>
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-indigo-50 p-4 border border-indigo-200 text-indigo-800 text-sm font-semibold flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="glass-panel rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-100 text-xs font-semibold text-slate-600 uppercase border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Jenis &amp; Judul Kegiatan</th>
                        <th class="px-6 py-4">Tanggal &amp; Lokasi</th>
                        <th class="px-6 py-4">Target / Peserta</th>
                        <th class="px-6 py-4">Status Workflow</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($data as $index => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $data->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-0.5 text-xs font-bold text-indigo-800 uppercase tracking-wider">
                                    {{ str_replace('_', ' ', strtoupper($item->jenis_kegiatan)) }}
                                </span>
                                <div class="font-bold text-slate-900 mt-1">{{ $item->judul_kegiatan }}</div>
                                @if($item->tema)
                                    <div class="text-xs text-slate-500">Tema: "{{ $item->tema }}"</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->format('d F Y') }}</div>
                                <div class="text-xs text-slate-500">{{ $item->lokasi }}, {{ $item->kab_kota }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-800">
                                    {{ $item->pesertas_count }} / {{ $item->target_peserta }} Terdaftar
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium bg-slate-100 text-slate-800">
                                    {{ str_replace('_', ' ', ucfirst($item->status_workflow)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('pemberdayaan.kesetiakawanan.show', $item->id) }}" class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-indigo-600 hover:text-white transition">
                                    Detail &amp; Pendaftaran
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                Belum ada rencana kegiatan kesetiakawanan / penyuluhan sosial.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($data->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
