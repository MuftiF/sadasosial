@extends('layouts.app')

@section('title', 'Buat Rencana Kegiatan Kesetiakawanan - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('pemberdayaan.kesetiakawanan.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">&larr; Kembali ke Daftar</a>
        <h1 class="text-2xl font-bold text-slate-900 mt-2">Form Menyusun Rencana Kegiatan Kesetiakawanan / Penyuluhan</h1>
        <p class="text-sm text-slate-600">Disusun oleh Operator / Analis Bidang Pemberdayaan Sosial.</p>
    </div>

    <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('pemberdayaan.kesetiakawanan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Jenis Kegiatan *</label>
                    <select name="jenis_kegiatan" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500">
                        <option value="kesetiakawanan_sosial">Kesetiakawanan Sosial (HKSN)</option>
                        <option value="restorasi_sosial">Restorasi Sosial</option>
                        <option value="penyuluhan_sosial">Penyuluhan Sosial Masyarakat</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Judul Kegiatan *</label>
                    <input type="text" name="judul_kegiatan" required placeholder="Contoh: Penyuluhan Restorasi Nilai Sosbud" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tema Kegiatan (Opsional)</label>
                    <input type="text" name="tema" placeholder="Tema/sub-tema acara" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Target Kuota Peserta *</label>
                    <input type="number" name="target_peserta" min="1" required placeholder="Contoh: 100" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Tanggal Pelaksanaan *</label>
                    <input type="date" name="tanggal_pelaksanaan" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Lokasi Tempat *</label>
                    <input type="text" name="lokasi" required placeholder="Nama Gedung / Aula" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Kabupaten / Kota *</label>
                    <input type="text" name="kab_kota" required placeholder="Kab/Kota di Sumut" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Narasumber / Mitra (Opsional)</label>
                    <input type="text" name="narasumber" placeholder="Nama narasumber/akademisi/praktisi" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Deskripsi Singkat Acara</label>
                    <textarea name="deskripsi_kegiatan" rows="2" placeholder="Uraian agenda acara" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('pemberdayaan.kesetiakawanan.index') }}" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</a>
                <button type="submit" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-bold text-white shadow-md hover:bg-indigo-700 transition">Simpan Rencana Kegiatan</button>
            </div>
        </form>
    </div>
</div>
@endsection
