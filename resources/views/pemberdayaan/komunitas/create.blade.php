@extends('layouts.app')

@section('title', 'Form Usulan Fasilitasi Kelompok Rentan - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('pemberdayaan.komunitas.index') }}" class="text-sm font-semibold text-cyan-600 hover:underline">&larr; Kembali ke Daftar</a>
        <h1 class="text-2xl font-bold text-slate-900 mt-2">Form Usulan Fasilitasi Pemberdayaan Kelompok Rentan</h1>
        <p class="text-sm text-slate-600">Pengajuan kebutuhan fasilitasi/bantuan untuk komunitas dan kelompok rentan di wilayah Sumatera Utara.</p>
    </div>

    <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('pemberdayaan.komunitas.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Komunitas / Kelompok *</label>
                    <input type="text" name="nama_komunitas" required placeholder="Contoh: Komunitas Disabilitas Mandiri Sumut" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-cyan-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Jenis Kelompok Rentan *</label>
                    <select name="jenis_kelompok" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-cyan-500">
                        <option value="lansia">Kelompok Lansia</option>
                        <option value="disabilitas">Penyandang Disabilitas</option>
                        <option value="gepeng">Gelandangan &amp; Pengemis (Gepeng)</option>
                        <option value="masyarakat_adat">Komunitas Adat Terpencil</option>
                        <option value="masyarakat_rentan">Kelompok Rentan Lainnya</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Kabupaten / Kota *</label>
                    <input type="text" name="kab_kota" required placeholder="Contoh: Kab. Nias / Kota Pematangsiantar" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-cyan-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Alamat Domisili / Komunitas *</label>
                    <input type="text" name="alamat" required placeholder="Alamat lengkap lokasi kelompok" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-cyan-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Usulan Kebutuhan Pemberdayaan / Fasilitasi *</label>
                <textarea name="usulan_kebutuhan" rows="4" required placeholder="Rincikan bentuk fasilitasi yang diusulkan (misal: bantuan alat bantu disabilitas, pelatihan tata boga/kerajinan, modal usaha kelompok)" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-cyan-500"></textarea>
            </div>

            <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('pemberdayaan.komunitas.index') }}" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</a>
                <button type="submit" class="rounded-xl bg-cyan-600 px-6 py-2.5 text-sm font-bold text-white shadow-md hover:bg-cyan-700 transition">Kirim Usulan Fasilitasi</button>
            </div>
        </form>
    </div>
</div>
@endsection
