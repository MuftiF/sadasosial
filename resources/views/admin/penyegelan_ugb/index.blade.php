@extends('layouts.app')

@section('title', 'Penyegelan UGB — SADA SOSIAL')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Modul Penyegelan UGB</h1>
            <p class="text-sm text-slate-500 mt-1">Daftar perizinan UGB yang sudah selesai dan siap untuk proses penyegelan alat undian.</p>
        </div>
    </div>

    <!-- Tabel -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">No. Izin</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Penyelenggara</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Tgl Terbit Izin</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Status Penyegelan</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Progress</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($perizinans as $izin)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-4 font-bold text-emerald-700">
                        {{ $izin->nomor_izin ?? ('ID #'.$izin->id) }}
                    </td>
                    <td class="px-5 py-4">
                        <p class="font-semibold text-slate-900">{{ $izin->pemohon->name }}</p>
                        <p class="text-[10px] text-slate-500">{{ $izin->nama_penyelenggara }}</p>
                    </td>
                    <td class="px-5 py-4 text-slate-600">
                        {{ $izin->tanggal_terbit ? \Carbon\Carbon::parse($izin->tanggal_terbit)->format('d M Y') : '-' }}
                    </td>
                    <td class="px-5 py-4">
                        @if($izin->penyegelan)
                            @if($izin->penyegelan->status === 'selesai')
                                <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-[10px] font-bold text-emerald-700">
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-[10px] font-bold text-amber-700">
                                    Dalam Proses
                                </span>
                            @endif
                        @else
                            <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-[10px] font-bold text-slate-600">
                                Belum Dimulai
                            </span>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        @php
                            $progress = $izin->penyegelan ? $izin->penyegelan->progress : 0;
                        @endphp
                        <div class="flex items-center gap-2">
                            <div class="w-24 bg-slate-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <span class="text-[10px] font-bold text-slate-600">{{ $progress }}%</span>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <a href="{{ route('admin.penyegelan_ugb.show', $izin->id) }}"
                            class="rounded-lg bg-emerald-50 px-3 py-1.5 text-[10px] font-bold text-emerald-700 hover:bg-emerald-100 transition inline-block text-center">
                            {{ $izin->penyegelan ? 'Lanjutkan / Detail' : 'Mulai Penyegelan' }}
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-12 text-center text-slate-400 text-sm">
                        Belum ada perizinan UGB yang selesai.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
