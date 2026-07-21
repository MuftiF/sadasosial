@extends('layouts.app')

@section('title', 'Patroli UGB — SADA SOSIAL')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Modul Patroli UGB</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola rencana, pelaksanaan, dan pelaporan patroli Undian Gratis Berhadiah.</p>
        </div>
        <a href="{{ route('admin.patroli_ugb.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-5 py-2.5 text-sm font-bold text-white shadow hover:opacity-90 transition">
            + Rencana Patroli Baru
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-blue-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-2xl"><x-heroicon-o-clipboard-document-list class="w-5 h-5 inline-block mr-1" /></div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Rencana</p>
                <p class="text-3xl font-extrabold text-blue-700">{{ $stats['rencana'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-amber-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-2xl"><x-heroicon-o-truck class="w-5 h-5 inline-block mr-1" /></div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Berlangsung</p>
                <p class="text-3xl font-extrabold text-amber-700">{{ $stats['pelaksanaan'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-emerald-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-2xl"><x-heroicon-o-check-circle class="w-5 h-5 inline-block mr-1" /></div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Selesai</p>
                <p class="text-3xl font-extrabold text-emerald-700">{{ $stats['selesai'] }}</p>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-5 p-4 flex items-center gap-4">
        <form method="GET" action="{{ route('admin.patroli_ugb.index') }}" class="flex items-center gap-3">
            <span class="text-xs font-bold text-slate-600">Filter Status:</span>
            <select name="status" onchange="this.form.submit()"
                class="rounded-xl border border-slate-300 px-3 py-2 text-sm text-slate-800 focus:border-emerald-500 focus:outline-none">
                <option value="">Semua Status</option>
                <option value="rencana" {{ request('status') === 'rencana' ? 'selected' : '' }}>Rencana</option>
                <option value="pelaksanaan" {{ request('status') === 'pelaksanaan' ? 'selected' : '' }}>Berlangsung</option>
                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </form>
    </div>

    <!-- Tabel Patroli -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Tanggal Rencana</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Lokasi</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Petugas</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Temuan Pelanggaran</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Status</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($patrolis as $patroli)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-4 font-semibold text-slate-900">
                        {{ $patroli->tanggal_rencana->format('d M Y') }}
                        @if($patroli->tanggal_pelaksanaan)
                            <br><span class="text-[10px] text-slate-400">Pelaksanaan: {{ $patroli->tanggal_pelaksanaan->format('d M Y') }}</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-slate-700 max-w-xs">{{ Str::limit($patroli->lokasi, 60) }}</td>
                    <td class="px-5 py-4 text-slate-600 text-xs">{{ $patroli->petugas->name }}</td>
                    <td class="px-5 py-4">
                        @if($patroli->nama_penyelenggara_temuan)
                            <div class="text-xs">
                                <p class="font-semibold text-slate-800">{{ $patroli->nama_penyelenggara_temuan }}</p>
                                <p class="text-slate-500">{{ \App\Models\PatroliUgb::jenisOptions()[$patroli->jenis_pelanggaran] ?? $patroli->jenis_pelanggaran }}</p>
                            </div>
                        @else
                            <span class="text-[10px] text-slate-400">—</span>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[10px] font-bold {{ $patroli->status_color }}">
                            {{ $patroli->status_label }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.patroli_ugb.show', $patroli->id) }}"
                                class="rounded-lg bg-slate-100 px-3 py-1.5 text-[10px] font-bold text-slate-700 hover:bg-slate-200 transition">
                                Detail
                            </a>
                            @if($patroli->status !== 'selesai')
                            <a href="{{ route('admin.patroli_ugb.edit', $patroli->id) }}"
                                class="rounded-lg bg-emerald-50 px-3 py-1.5 text-[10px] font-bold text-emerald-700 hover:bg-emerald-100 transition">
                                Update
                            </a>
                            @endif
                            <a href="{{ route('admin.patroli_ugb.surat_tugas', $patroli->id) }}" target="_blank"
                                class="rounded-lg bg-blue-50 px-3 py-1.5 text-[10px] font-bold text-blue-700 hover:bg-blue-100 transition">
                                Surat Tugas
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-12 text-center text-slate-400 text-sm">
                        Belum ada rencana patroli. <a href="{{ route('admin.patroli_ugb.create') }}" class="text-emerald-600 font-semibold hover:underline">Buat Rencana Baru &rarr;</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($patrolis->hasPages())
        <div class="px-5 py-4 border-t border-slate-200">
            {{ $patrolis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
