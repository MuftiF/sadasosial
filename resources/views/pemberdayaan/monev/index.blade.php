@extends('layouts.app')

@section('title', 'Monitoring & Evaluasi Pemberdayaan Sosial - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('pemberdayaan.index') }}" class="text-sm font-semibold text-purple-600 hover:underline">&larr; Portal Pemberdayaan</a>
                <span class="text-slate-300">/</span>
                <span class="text-sm text-slate-500 font-medium">Subproses 2.6</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Monitoring &amp; Evaluasi (Monev) Program Pemberdayaan</h1>
            <p class="text-sm text-slate-600">Laporan capaian program, analisis kendala, dan rekomendasi perbaikan berkala.</p>
        </div>
        @if(Auth::user()->isStaff())
            <div>
                <a href="{{ route('pemberdayaan.monev.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-purple-600 px-4 py-2.5 text-sm font-bold text-white shadow-md hover:bg-purple-700 transition">
                    + Buat Laporan Monev Baru
                </a>
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-purple-50 p-4 border border-purple-200 text-purple-800 text-sm font-semibold flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Real-time Summary Cards (Interactive Executive Monev Dashboard) -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="glass-panel p-4 rounded-2xl border border-slate-200 text-center">
            <span class="text-xs text-slate-500 block mb-1">Total LKS Dibina</span>
            <span class="text-2xl font-extrabold text-emerald-600">{{ $summary['total_lks'] }}</span>
        </div>
        <div class="glass-panel p-4 rounded-2xl border border-slate-200 text-center">
            <span class="text-xs text-slate-500 block mb-1">Pilar Sosial Dibina</span>
            <span class="text-2xl font-extrabold text-teal-600">{{ $summary['total_pilar'] }}</span>
        </div>
        <div class="glass-panel p-4 rounded-2xl border border-slate-200 text-center">
            <span class="text-xs text-slate-500 block mb-1">Kelompok Rentan</span>
            <span class="text-2xl font-extrabold text-cyan-600">{{ $summary['total_komunitas'] }}</span>
        </div>
        <div class="glass-panel p-4 rounded-2xl border border-slate-200 text-center">
            <span class="text-xs text-slate-500 block mb-1">Kegiatan Kesetiakawanan</span>
            <span class="text-2xl font-extrabold text-indigo-600">{{ $summary['total_kegiatan'] }}</span>
        </div>
        <div class="glass-panel p-4 rounded-2xl border border-slate-200 text-center">
            <span class="text-xs text-slate-500 block mb-1">Agenda TMP / Pahlawan</span>
            <span class="text-2xl font-extrabold text-amber-600">{{ $summary['total_tmp'] }}</span>
        </div>
    </div>

    <div class="glass-panel rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-100 text-xs font-semibold text-slate-600 uppercase border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Periode &amp; Tahun</th>
                        <th class="px-6 py-4">Wilayah Audit</th>
                        <th class="px-6 py-4">Akumulasi Capaian Data</th>
                        <th class="px-6 py-4">Status Workflow</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($data as $index => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $data->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $item->periode_evaluasi }}</div>
                                <div class="text-xs text-slate-500">Tahun: {{ $item->tahun }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $item->kab_kota }}</td>
                            <td class="px-6 py-4 text-xs">
                                <div class="font-semibold text-slate-800">
                                    LKS: {{ $item->total_lks_dibina }} | Pilar: {{ $item->total_pilar_dibina }} | Komunitas: {{ $item->total_komunitas_difasilitasi }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium bg-slate-100 text-slate-800">
                                    {{ str_replace('_', ' ', ucfirst($item->status_workflow)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('pemberdayaan.monev.show', $item->id) }}" class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-purple-600 hover:text-white transition">
                                    Detail &amp; Laporan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                Belum ada laporan monitoring &amp; evaluasi.
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
