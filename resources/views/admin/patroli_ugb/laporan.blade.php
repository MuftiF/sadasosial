@extends('layouts.app')

@section('title', 'Laporan Patroli UGB #' . $patroli->id)

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8 print:hidden">
        <div>
            <a href="{{ route('admin.patroli_ugb.index') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-3">
                &larr; Kembali ke Daftar Patroli
            </a>
            <h1 class="text-2xl font-extrabold text-slate-900">Detail Patroli UGB #{{ $patroli->id }}</h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.patroli_ugb.surat_tugas', $patroli->id) }}" target="_blank"
                class="rounded-xl bg-blue-50 border border-blue-200 px-4 py-2 text-xs font-bold text-blue-700 hover:bg-blue-100 transition">
                <x-heroicon-o-printer class="w-4 h-4 inline-block mr-1" /> Surat Tugas
            </a>
            <button onclick="window.print()"
                class="rounded-xl bg-slate-100 border border-slate-200 px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-200 transition">
                <x-heroicon-o-printer class="w-4 h-4 inline-block mr-1" /> Cetak Laporan
            </button>
            @if($patroli->status !== 'selesai')
            <a href="{{ route('admin.patroli_ugb.edit', $patroli->id) }}"
                class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-5 py-2 text-xs font-bold text-white shadow hover:opacity-90 transition">
                Update Patroli &rarr;
            </a>
            @endif
        </div>
    </div>

    <!-- Status Badge -->
    <div class="flex items-center gap-3 mb-6">
        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold {{ $patroli->status_color }}">
            {{ $patroli->status_label }}
        </span>
        <span class="text-xs text-slate-500">Dibuat oleh {{ $patroli->petugas->name }} pada {{ $patroli->created_at->format('d M Y') }}</span>
    </div>

    <!-- Konten Laporan -->
    <div class="space-y-5">
        <!-- Info Rencana -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-sm font-bold text-slate-700 uppercase tracking-wide mb-4"><x-heroicon-o-clipboard-document-list class="w-5 h-5 inline-block mr-1" /> Rencana Patroli</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-xs text-slate-500 uppercase tracking-wide font-bold mb-1">Tanggal Rencana</p>
                    <p class="text-slate-900 font-semibold">{{ $patroli->tanggal_rencana->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 uppercase tracking-wide font-bold mb-1">Tanggal Pelaksanaan</p>
                    <p class="text-slate-900 font-semibold">{{ $patroli->tanggal_pelaksanaan ? $patroli->tanggal_pelaksanaan->format('d F Y') : '— Belum dilaksanakan' }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs text-slate-500 uppercase tracking-wide font-bold mb-1">Lokasi</p>
                    <p class="text-slate-900">{{ $patroli->lokasi }}</p>
                </div>
            </div>

            @if($patroli->pembagian_tugas)
            <div class="mt-4 pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-500 uppercase tracking-wide font-bold mb-3">Tim Patroli</p>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-bold text-slate-500 uppercase">Nama</th>
                                <th class="px-3 py-2 text-left text-xs font-bold text-slate-500 uppercase">Jabatan</th>
                                <th class="px-3 py-2 text-left text-xs font-bold text-slate-500 uppercase">Tugas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($patroli->pembagian_tugas as $anggota)
                            <tr>
                                <td class="px-3 py-2 font-semibold text-slate-800">{{ $anggota['nama'] ?? '-' }}</td>
                                <td class="px-3 py-2 text-slate-600">{{ $anggota['jabatan'] ?? '-' }}</td>
                                <td class="px-3 py-2 text-slate-600">{{ $anggota['tugas'] ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

        <!-- Temuan Pelanggaran -->
        @if($patroli->nama_penyelenggara_temuan)
        <div class="bg-amber-50 rounded-2xl border border-amber-200 p-6">
            <h2 class="text-sm font-bold text-amber-800 uppercase tracking-wide mb-4"><x-heroicon-o-exclamation-triangle class="w-5 h-5 inline-block mr-1" /> Temuan Pelanggaran</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-xs text-amber-600 uppercase tracking-wide font-bold mb-1">Penyelenggara</p>
                    <p class="text-slate-900 font-semibold">{{ $patroli->nama_penyelenggara_temuan }}</p>
                </div>
                <div>
                    <p class="text-xs text-amber-600 uppercase tracking-wide font-bold mb-1">Jenis Pelanggaran</p>
                    <p class="text-slate-900">{{ \App\Models\PatroliUgb::jenisOptions()[$patroli->jenis_pelanggaran] ?? $patroli->jenis_pelanggaran }}</p>
                </div>
                <div>
                    <p class="text-xs text-amber-600 uppercase tracking-wide font-bold mb-1">Tanggal Temuan</p>
                    <p class="text-slate-900">{{ $patroli->tanggal_temuan ? $patroli->tanggal_temuan->format('d F Y') : '—' }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Hasil Pelaksanaan -->
        @if($patroli->catatan_pembinaan || $patroli->checklist_kondisi)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-sm font-bold text-slate-700 uppercase tracking-wide mb-4"><x-heroicon-o-truck class="w-5 h-5 inline-block mr-1" /> Hasil Pelaksanaan</h2>

            @if($patroli->checklist_kondisi)
            <div class="mb-4">
                <p class="text-xs text-slate-500 uppercase tracking-wide font-bold mb-2">Checklist Kondisi Lapangan</p>
                @php
                $checklistLabels = [
                    'lokasi_aman'       => 'Lokasi aman dan kondusif',
                    'ada_aktivitas_ugb' => 'Terdapat aktivitas UGB yang dipantau',
                    'izin_ditunjukkan'  => 'Pihak penyelenggara dapat menunjukkan izin',
                    'tidak_menyimpang'  => 'Pelaksanaan tidak menyimpang dari izin',
                    'masyarakat_aman'   => 'Tidak ada keresahan masyarakat',
                ];
                @endphp
                <div class="space-y-1.5">
                    @foreach($checklistLabels as $key => $label)
                    <div class="flex items-center gap-2">
                        @if(!empty($patroli->checklist_kondisi[$key]))
                            <span class="text-emerald-500 text-sm"><x-heroicon-o-check-circle class="w-5 h-5 inline-block mr-1" /></span>
                        @else
                            <span class="text-slate-300 text-sm"><x-heroicon-o-stop class="w-4 h-4 inline-block mr-1" /></span>
                        @endif
                        <span class="text-sm text-slate-700">{{ $label }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($patroli->catatan_pembinaan)
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wide font-bold mb-2">Catatan Pembinaan</p>
                <p class="text-sm text-slate-700 leading-relaxed">{{ $patroli->catatan_pembinaan }}</p>
            </div>
            @endif
        </div>
        @endif

        <!-- Laporan Selesai -->
        @if($patroli->ringkasan_temuan)
        <div class="bg-white rounded-2xl border border-emerald-200 shadow-sm p-6">
            <h2 class="text-sm font-bold text-emerald-700 uppercase tracking-wide mb-4"><x-heroicon-o-chart-bar class="w-5 h-5 inline-block mr-1" /> Laporan Hasil Patroli</h2>
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-slate-500 uppercase tracking-wide font-bold mb-2">Ringkasan Temuan</p>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $patroli->ringkasan_temuan }}</p>
                </div>
                @if($patroli->tindakan_diambil)
                <div>
                    <p class="text-xs text-slate-500 uppercase tracking-wide font-bold mb-2">Tindakan yang Diambil</p>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $patroli->tindakan_diambil }}</p>
                </div>
                @endif
                @if($patroli->rekomendasi)
                <div>
                    <p class="text-xs text-slate-500 uppercase tracking-wide font-bold mb-2">Rekomendasi</p>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $patroli->rekomendasi }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
