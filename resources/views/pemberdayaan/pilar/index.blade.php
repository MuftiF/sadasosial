
@extends('layouts.app')

@section('title', 'Pembinaan Pilar-Pilar Sosial - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('pemberdayaan.index') }}" class="text-sm font-semibold text-teal-600 hover:underline">&larr; Portal Pemberdayaan</a>
                <span class="text-slate-300">/</span>
                <span class="text-sm text-slate-500 font-medium">Subproses 2.2</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Pembinaan Pilar-Pilar Sosial</h1>
            <p class="text-sm text-slate-600">Penguatan kapasitas PSM, TKSK, Karang Taruna, dan Relawan Sosial melalui Bimbingan Teknis.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('pemberdayaan.pilar.sop_tksk') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-teal-400 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                📖 SOP TKSK (8 Langkah)
            </a>
            <a href="{{ route('pemberdayaan.pilar.sop_ipsm') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-teal-400 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                📖 SOP IPSM / PSM (15 Langkah)
            </a>
            <a href="{{ route('pemberdayaan.pilar.sop_karang_taruna') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-teal-400 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                📖 SOP Karang Taruna (14 Langkah)
            </a>
            <a href="{{ route('pemberdayaan.pilar.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-teal-600 px-4 py-2.5 text-sm font-bold text-white shadow-md hover:bg-teal-700 transition">
                + Ajukan Usulan Pembinaan Pilar
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-teal-50 p-4 border border-teal-200 text-teal-800 text-sm font-semibold flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="glass-panel rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-100 text-xs font-semibold text-slate-600 uppercase border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Kategori &amp; Nama Pilar</th>
                        <th class="px-6 py-4">Kab/Kota</th>
                        <th class="px-6 py-4">Skor Evaluasi</th>
                        <th class="px-6 py-4">Status Workflow</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($data as $index => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $data->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md bg-teal-50 px-2 py-0.5 text-xs font-bold text-teal-800 uppercase tracking-wider">
                                    {{ str_replace('_', ' ', strtoupper($item->kategori_pilar)) }}
                                </span>
                                <div class="font-bold text-slate-900 mt-1">{{ $item->nama_pilar }}</div>
                                <div class="text-xs text-slate-500">Pengaju: {{ $item->user->name ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $item->kab_kota }}</td>
                            <td class="px-6 py-4">
                                @if($item->evaluasi_skor > 0)
                                    <span class="inline-flex items-center rounded-md bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-800">
                                        {{ $item->evaluasi_skor }} / 100
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">Belum Dievaluasi</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $badgeClasses = [
                                        'diajukan' => 'bg-amber-100 text-amber-800',
                                        'bimtek_dilaksanakan' => 'bg-blue-100 text-blue-800',
                                        'dievaluasi' => 'bg-indigo-100 text-indigo-800',
                                        'diarsipkan_sekretariat' => 'bg-purple-100 text-purple-800',
                                        'disahkan_kadinas' => 'bg-emerald-100 text-emerald-800 font-bold',
                                        'ditolak' => 'bg-rose-100 text-rose-800',
                                    ];
                                @endphp
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium {{ $badgeClasses[$item->status_workflow] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ str_replace('_', ' ', ucfirst($item->status_workflow)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('pemberdayaan.pilar.show', $item->id) }}" class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-teal-600 hover:text-white transition">
                                    Detail &amp; Workflow
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                Belum ada data pembinaan pilar sosial.
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
