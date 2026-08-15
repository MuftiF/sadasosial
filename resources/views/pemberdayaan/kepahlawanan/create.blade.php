@extends('layouts.app')

@section('title', 'Form Usulan Agenda Kepahlawanan / TMP - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('pemberdayaan.kepahlawanan.index') }}" class="text-sm font-semibold text-amber-600 hover:underline">&larr; Kembali ke Daftar</a>
        <h1 class="text-2xl font-bold text-slate-900 mt-2">Form Usulan Agenda Kepahlawanan / Taman Makam Pahlawan</h1>
        <p class="text-sm text-slate-600">Pengajuan kegiatan nilai kepahlawanan, peringatan hari pahlawan, usulan pahlawan nasional/daerah, atau pemeliharaan sarana TMP.</p>
    </div>

    <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('pemberdayaan.kepahlawanan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Jenis Agenda / Usulan *</label>
                    <select name="jenis_agenda" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-amber-500">
                        <option value="pemeliharaan_tmp">Pemeliharaan &amp; Sarpras TMP</option>
                        <option value="hari_pahlawan">Peringatan Hari Pahlawan / Ziarah Nasional</option>
                        <option value="usulan_gelar">Usulan Gelar Pahlawan Nasional / Daerah</option>
                        <option value="ziarah_wisata">Ziarah &amp; Wisata Edukasi Kepahlawanan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama TMP / Objek Pahlawan *</label>
                    <input type="text" name="nama_tmp_atau_pahlawan" required placeholder="Contoh: TMP Bukit Barisan Medan / Pahlawan Kiras Bangun" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Kabupaten / Kota *</label>
                    <input type="text" name="kab_kota" required placeholder="Contoh: Kota Medan / Kab. Karo" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Lokasi / Alamat TMP (Opsional)</label>
                    <input type="text" name="lokasi_tmp" placeholder="Jl. Sisingamangaraja No. xx" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Deskripsi Usulan Kegiatan / Kebutuhan Pemeliharaan *</label>
                <textarea name="usulan_kegiatan" rows="4" required placeholder="Jelaskan kebutuhan pemeliharaan makam / usulan acara kepahlawanan" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-amber-500"></textarea>
            </div>

            <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('pemberdayaan.kepahlawanan.index') }}" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</a>
                <button type="submit" class="rounded-xl bg-amber-600 px-6 py-2.5 text-sm font-bold text-white shadow-md hover:bg-amber-700 transition">Kirim Usulan Agenda</button>
            </div>
        </form>
    </div>
</div>
@endsection
