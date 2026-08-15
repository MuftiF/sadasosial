@extends('layouts.app')

@section('title', 'Detail Fasilitasi Kelompok Rentan - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-5xl sm:px-6 lg:px-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('pemberdayaan.komunitas.index') }}" class="text-sm font-semibold text-cyan-600 hover:underline">&larr; Kembali ke Daftar</a>
            <h1 class="text-2xl font-bold text-slate-900 mt-2">{{ $item->nama_komunitas }}</h1>
            <p class="text-sm text-slate-500">Jenis: {{ strtoupper($item->jenis_kelompok) }} | Tanggal Pengajuan: {{ $item->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div>
            <span class="inline-flex items-center rounded-full px-4 py-1.5 text-xs font-bold uppercase tracking-wider bg-cyan-100 text-cyan-800">
                {{ str_replace('_', ' ', strtoupper($item->status_workflow)) }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-cyan-50 p-4 border border-cyan-200 text-cyan-800 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Main Data -->
        <div class="md:col-span-2 space-y-6">
            <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Informasi Kelompok &amp; Usulan Kebutuhan</h3>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-xs text-slate-400 block">Jenis Kelompok</span>
                        <span class="font-semibold text-slate-800 uppercase">{{ $item->jenis_kelompok }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Kabupaten / Kota</span>
                        <span class="font-semibold text-slate-800">{{ $item->kab_kota }}</span>
                    </div>
                </div>

                <div>
                    <span class="text-xs text-slate-400 block mb-1">Alamat Komunitas</span>
                    <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100">{{ $item->alamat }}</p>
                </div>

                <div>
                    <span class="text-xs text-slate-400 block mb-1">Usulan Kebutuhan Pemberdayaan</span>
                    <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100">{{ $item->usulan_kebutuhan }}</p>
                </div>
            </div>

            <!-- Verifikasi & Plan Monitoring -->
            @if($item->catatan_verifikasi_dinsos || $item->rencana_fasilitasi)
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Status Verifikasi &amp; Plan Fasilitasi</h3>
                    
                    @if($item->catatan_verifikasi_dinsos)
                        <div class="bg-amber-50/50 p-4 rounded-xl border border-amber-100 space-y-1 text-sm">
                            <span class="text-xs font-bold text-amber-800 uppercase tracking-wider block">Verifikasi Dinsos Kab/Kota</span>
                            <div><strong>Status:</strong> {{ strtoupper($item->status_verifikasi_dinsos) }}</div>
                            <div><strong>Catatan Verifikasi:</strong> {{ $item->catatan_verifikasi_dinsos }}</div>
                        </div>
                    @endif

                    @if($item->rencana_fasilitasi)
                        <div class="bg-cyan-50/50 p-4 rounded-xl border border-cyan-100 space-y-2 text-sm">
                            <span class="text-xs font-bold text-cyan-800 uppercase tracking-wider block">Rencana Fasilitasi &amp; Monitoring Hasil</span>
                            <div><strong>Rencana Fasilitasi:</strong> {{ $item->rencana_fasilitasi }}</div>
                            <div><strong>Hasil Monitoring:</strong> {{ $item->hasil_monitoring }}</div>
                            <div><strong>Hasil Efektif:</strong> {{ $item->is_efektif ? 'YA, EFEKTIF' : 'TIDAK' }}</div>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Workflow Actions -->
        <div class="space-y-6">
            <!-- Dinsos Wilayah / Admin: Verifikasi Kewilayahan -->
            @if((Auth::user()->isDinsosWilayah() || Auth::user()->isAdmin() || Auth::user()->isBidangPemberdayaan()) && $item->status_workflow === 'diajukan')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-amber-50/30">
                    <h3 class="text-sm font-bold text-amber-900 mb-3">Verifikasi Dinsos Kab/Kota</h3>
                    <form action="{{ route('pemberdayaan.komunitas.verifikasi_wilayah', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Keputusan Verifikasi *</label>
                            <select name="status_verifikasi_dinsos" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                                <option value="diverifikasi">Verifikasi &amp; Teruskan ke Bidang Pemberdayaan</option>
                                <option value="ditolak">Tolak Usulan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Verifikasi Wilayah</label>
                            <textarea name="catatan_verifikasi_dinsos" rows="2" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-amber-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-amber-700">
                            Simpan Verifikasi Dinsos Wilayah
                        </button>
                    </form>
                </div>
            @endif

            <!-- Bidang Pemberdayaan: Rencana Fasilitasi & Monitoring -->
            @if(Auth::user()->isBidangPemberdayaan() && in_array($item->status_workflow, ['diverifikasi_wilayah', 'rencana_fasilitasi', 'dilaksanakan']))
                <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Form Rencana Fasilitasi &amp; Monitoring</h3>
                    <form action="{{ route('pemberdayaan.komunitas.fasilitasi.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Rencana Fasilitasi *</label>
                            <textarea name="rencana_fasilitasi" rows="2" required placeholder="Detail program fasilitasi" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Hasil Monitoring &amp; Pendampingan *</label>
                            <textarea name="hasil_monitoring" rows="2" required placeholder="Catatan hasil evaluasi fasilitasi" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Hasil Efektif? *</label>
                            <select name="is_efektif" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                                <option value="1">Ya, Efektif (Teruskan ke Sekretariat &amp; Kadinas)</option>
                                <option value="0">Tidak Efektif</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-cyan-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-cyan-700">
                            Simpan Rencana &amp; Monitoring
                        </button>
                    </form>
                </div>
            @endif

            <!-- Sekretariat: Arsip -->
            @if((Auth::user()->isSekretariat() || Auth::user()->isAdmin()) && $item->status_workflow === 'monitoring')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-purple-50/40">
                    <h3 class="text-sm font-bold text-purple-900 mb-2">Aksi Sekretariat</h3>
                    <form action="{{ route('pemberdayaan.komunitas.arsip.store', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-purple-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-purple-700">
                            Arsipkan Laporan Fasilitasi
                        </button>
                    </form>
                </div>
            @endif

            <!-- Kepala Dinas: Approval Keberlanjutan -->
            @if((Auth::user()->isKadinas() || Auth::user()->isAdmin()) && $item->status_workflow === 'diarsipkan_sekretariat')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-emerald-50/40">
                    <h3 class="text-sm font-bold text-emerald-900 mb-2">Persetujuan Keberlanjutan Kadinas</h3>
                    <form action="{{ route('pemberdayaan.komunitas.approval.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Keputusan *</label>
                            <select name="status" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                                <option value="disetujui_keberlanjutan">Setujui Keberlanjutan Program</option>
                                <option value="ditolak">Tolak Program</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Kepala Dinas</label>
                            <textarea name="catatan_revisi" rows="2" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-emerald-700">
                            Simpan Decision Kadinas
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
