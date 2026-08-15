@extends('layouts.app')

@section('title', 'Pengelolaan Kepahlawanan & TMP - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('pemberdayaan.index') }}" class="text-sm font-semibold text-amber-600 hover:underline">&larr; Portal Pemberdayaan</a>
                <span class="text-slate-300">/</span>
                <span class="text-sm text-slate-500 font-medium">Subproses 2.5</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Pengelolaan Kepahlawanan &amp; Taman Makam Pahlawan</h1>
            <p class="text-sm text-slate-600">Pengelolaan agenda nilai-nilai kepahlawanan, peringatan hari pahlawan, usulan pahlawan, dan pemeliharaan TMP.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('pemberdayaan.kepahlawanan.sop_perawatan_tmp') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-amber-400 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                🏛️ SOP Perawatan TMP (14 Langkah)
            </a>
            <a href="{{ route('pemberdayaan.kepahlawanan.sop_cpn') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-amber-400 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                🎖️ SOP Gelar CPN (10 Langkah)
            </a>
            <a href="{{ route('pemberdayaan.kepahlawanan.sop_sidang_tp2gd') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-amber-400 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                ⚖️ SOP Sidang TP2GD (13 Langkah)
            </a>
            <a href="{{ route('pemberdayaan.kepahlawanan.sop_perintis_kemerdekaan') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-amber-400 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                📜 SOP Perintis Kemerdekaan (8 Langkah)
            </a>
            <a href="{{ route('pemberdayaan.kepahlawanan.sop_janda_perintis') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-amber-400 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                📇 SOP Janda/Duda Perintis (6 Langkah)
            </a>
            <a href="{{ route('pemberdayaan.kepahlawanan.sop_pemutakhiran_pkjpk') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-amber-400 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                🔄 SOP Pemutakhiran PKJPK (5 Langkah)
            </a>
            <a href="{{ route('pemberdayaan.kepahlawanan.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-amber-600 px-4 py-2.5 text-sm font-bold text-white shadow-md hover:bg-amber-700 transition">
                + Usulan Agenda / Pemeliharaan TMP
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-amber-50 p-4 border border-amber-200 text-amber-800 text-sm font-semibold flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="glass-panel rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-100 text-xs font-semibold text-slate-600 uppercase border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Jenis Agenda &amp; Objek TMP/Pahlawan</th>
                        <th class="px-6 py-4">Kab/Kota</th>
                        <th class="px-6 py-4">Pelaksana / Pengaju</th>
                        <th class="px-6 py-4">Status Workflow</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($data as $index => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $data->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md bg-amber-50 px-2 py-0.5 text-xs font-bold text-amber-800 uppercase tracking-wider">
                                    {{ str_replace('_', ' ', strtoupper($item->jenis_agenda)) }}
                                </span>
                                <div class="font-bold text-slate-900 mt-1">{{ $item->nama_tmp_atau_pahlawan }}</div>
                                @if($item->lokasi_tmp)
                                    <div class="text-xs text-slate-500">Lokasi: {{ $item->lokasi_tmp }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $item->kab_kota }}</td>
                            <td class="px-6 py-4 text-xs text-slate-600">
                                {{ $item->user->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium bg-slate-100 text-slate-800">
                                    {{ str_replace('_', ' ', ucfirst($item->status_workflow)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('pemberdayaan.kepahlawanan.show', $item->id) }}" class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-amber-600 hover:text-white transition">
                                    Detail &amp; Workflow
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                Belum ada usulan agenda kepahlawanan / TMP.
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
