@extends('layouts.app')

@section('title', 'Detail Laporan Monev - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-5xl sm:px-6 lg:px-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('pemberdayaan.monev.index') }}" class="text-sm font-semibold text-purple-600 hover:underline">&larr; Kembali ke Daftar</a>
            <h1 class="text-2xl font-bold text-slate-900 mt-2">Laporan Monev {{ $item->periode_evaluasi }} {{ $item->tahun }}</h1>
            <p class="text-sm text-slate-500">Wilayah: {{ $item->kab_kota }} | Dibuat oleh: {{ $item->user->name ?? '-' }}</p>
        </div>
        <div>
            <span class="inline-flex items-center rounded-full px-4 py-1.5 text-xs font-bold uppercase tracking-wider bg-purple-100 text-purple-800">
                {{ str_replace('_', ' ', strtoupper($item->status_workflow)) }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-purple-50 p-4 border border-purple-200 text-purple-800 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Main Analysis Info -->
        <div class="md:col-span-2 space-y-6">
            <!-- Indicator Cards -->
            <div class="grid grid-cols-5 gap-3 text-center">
                <div class="bg-emerald-50 p-3 rounded-xl border border-emerald-100">
                    <span class="text-[10px] text-emerald-700 font-bold block uppercase">LKS</span>
                    <span class="text-lg font-extrabold text-emerald-900">{{ $item->total_lks_dibina }}</span>
                </div>
                <div class="bg-teal-50 p-3 rounded-xl border border-teal-100">
                    <span class="text-[10px] text-teal-700 font-bold block uppercase">Pilar</span>
                    <span class="text-lg font-extrabold text-teal-900">{{ $item->total_pilar_dibina }}</span>
                </div>
                <div class="bg-cyan-50 p-3 rounded-xl border border-cyan-100">
                    <span class="text-[10px] text-cyan-700 font-bold block uppercase">Komunitas</span>
                    <span class="text-lg font-extrabold text-cyan-900">{{ $item->total_komunitas_difasilitasi }}</span>
                </div>
                <div class="bg-indigo-50 p-3 rounded-xl border border-indigo-100">
                    <span class="text-[10px] text-indigo-700 font-bold block uppercase">Kegiatan</span>
                    <span class="text-lg font-extrabold text-indigo-900">{{ $item->total_kegiatan_kesetiakawanan }}</span>
                </div>
                <div class="bg-amber-50 p-3 rounded-xl border border-amber-100">
                    <span class="text-[10px] text-amber-700 font-bold block uppercase">TMP</span>
                    <span class="text-lg font-extrabold text-amber-900">{{ $item->total_tmp_dikelola }}</span>
                </div>
            </div>

            <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Analisis Capaian &amp; Rekomendasi Perbaikan</h3>
                
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-1">Capaian Program</span>
                    <p class="text-sm text-slate-700 bg-slate-50 p-3.5 rounded-xl border border-slate-100">{{ $item->capaian_program }}</p>
                </div>

                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-1">Pencatatan Kendala</span>
                    <p class="text-sm text-slate-700 bg-slate-50 p-3.5 rounded-xl border border-slate-100">{{ $item->kendala_program }}</p>
                </div>

                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-1">Rekomendasi Perbaikan Program</span>
                    <p class="text-sm text-slate-700 bg-slate-50 p-3.5 rounded-xl border border-slate-100">{{ $item->rekomendasi_perbaikan }}</p>
                </div>
            </div>
        </div>

        <!-- Workflow Actions -->
        <div class="space-y-6">
            <!-- Staff: Edit Analis -->
            @if(Auth::user()->isBidangPemberdayaan())
                <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Update Analisis Monev</h3>
                    <form action="{{ route('pemberdayaan.monev.analisis.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Analisis Capaian *</label>
                            <textarea name="capaian_program" rows="2" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">{{ $item->capaian_program }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Pencatatan Kendala *</label>
                            <textarea name="kendala_program" rows="2" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">{{ $item->kendala_program }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Rekomendasi *</label>
                            <textarea name="rekomendasi_perbaikan" rows="2" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">{{ $item->rekomendasi_perbaikan }}</textarea>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-purple-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-purple-700">
                            Update Laporan Monev
                        </button>
                    </form>
                </div>
            @endif

            <!-- Sekretariat: Arsip -->
            @if((Auth::user()->isSekretariat() || Auth::user()->isAdmin()) && in_array($item->status_workflow, ['draft', 'laporan_disusun']))
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-purple-50/40">
                    <h3 class="text-sm font-bold text-purple-900 mb-2">Aksi Sekretariat</h3>
                    <form action="{{ route('pemberdayaan.monev.arsip.store', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-purple-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-purple-700">
                            Arsipkan Laporan Monev
                        </button>
                    </form>
                </div>
            @endif

            <!-- Kadinas: Pengesahan -->
            @if((Auth::user()->isKadinas() || Auth::user()->isAdmin()) && $item->status_workflow === 'diarsipkan_sekretariat')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-emerald-50/40">
                    <h3 class="text-sm font-bold text-emerald-900 mb-2">Pengesahan Kepala Dinas</h3>
                    <form action="{{ route('pemberdayaan.monev.approval.store', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-emerald-700">
                            Mengesahkan Hasil Monev
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
