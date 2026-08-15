@extends('layouts.app')

@section('title', 'Buat Laporan Monev Pemberdayaan - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('pemberdayaan.monev.index') }}" class="text-sm font-semibold text-purple-600 hover:underline">&larr; Kembali ke Daftar</a>
        <h1 class="text-2xl font-bold text-slate-900 mt-2">Form Buat Laporan Monitoring &amp; Evaluasi (Monev)</h1>
        <p class="text-sm text-slate-600">Pelaporan data kegiatan, analisis capaian, pencatatan kendala, dan rekomendasi perbaikan.</p>
    </div>

    <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('pemberdayaan.monev.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Periode Evaluasi *</label>
                    <select name="periode_evaluasi" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-purple-500">
                        <option value="Triwulan I">Triwulan I</option>
                        <option value="Triwulan II">Triwulan II</option>
                        <option value="Triwulan III">Triwulan III</option>
                        <option value="Triwulan IV">Triwulan IV</option>
                        <option value="Semester I">Semester I</option>
                        <option value="Semester II">Semester II</option>
                        <option value="Tahunan">Tahunan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tahun *</label>
                    <input type="number" name="tahun" value="{{ date('Y') }}" min="2020" max="2099" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Wilayah Evaluation *</label>
                    <input type="text" name="kab_kota" value="Seluruh Sumatera Utara" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            <!-- Auto-Calculated Indicator Stats -->
            <div class="p-4 rounded-xl bg-purple-50/60 border border-purple-100 space-y-4">
                <span class="text-xs font-bold text-purple-900 uppercase tracking-wider block">Statistik Capaian Program (Auto Pre-filled)</span>
                
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">LKS Dibina</label>
                        <input type="number" name="total_lks_dibina" value="{{ $autoStats['lks'] }}" required class="w-full rounded-lg p-2 border border-slate-300 text-sm text-center">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Pilar Dibina</label>
                        <input type="number" name="total_pilar_dibina" value="{{ $autoStats['pilar'] }}" required class="w-full rounded-lg p-2 border border-slate-300 text-sm text-center">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Komunitas</label>
                        <input type="number" name="total_komunitas_difasilitasi" value="{{ $autoStats['komunitas'] }}" required class="w-full rounded-lg p-2 border border-slate-300 text-sm text-center">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Kegiatan</label>
                        <input type="number" name="total_kegiatan_kesetiakawanan" value="{{ $autoStats['kegiatan'] }}" required class="w-full rounded-lg p-2 border border-slate-300 text-sm text-center">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">TMP Dikelola</label>
                        <input type="number" name="total_tmp_dikelola" value="{{ $autoStats['tmp'] }}" required class="w-full rounded-lg p-2 border border-slate-300 text-sm text-center">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Analisis Capaian Program *</label>
                <textarea name="capaian_program" rows="3" required placeholder="Uraian analisis ketercapaian target indikator pemberdayaan sosial" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Pencatatan Kendala &amp; Masalah *</label>
                <textarea name="kendala_program" rows="3" required placeholder="Identifikasi hambatan operasional, anggaran, atau kewilayahan" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Rekomendasi Perbaikan Program *</label>
                <textarea name="rekomendasi_perbaikan" rows="3" required placeholder="Rekomendasi tindakan perbaikan untuk periode mendatang" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('pemberdayaan.monev.index') }}" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</a>
                <button type="submit" class="rounded-xl bg-purple-600 px-6 py-2.5 text-sm font-bold text-white shadow-md hover:bg-purple-700 transition">Simpan Laporan Monev</button>
            </div>
        </form>
    </div>
</div>
@endsection
