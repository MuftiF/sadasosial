@extends('layouts.app')

@section('title', 'Form Usulan Pembinaan Pilar Sosial - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('pemberdayaan.pilar.index') }}" class="text-sm font-semibold text-teal-600 hover:underline">&larr; Kembali ke Daftar</a>
        <h1 class="text-2xl font-bold text-slate-900 mt-2">Form Usulan Pembinaan Pilar-Pilar Sosial</h1>
        <p class="text-sm text-slate-600">Pengajuan data PSM, TKSK, Karang Taruna, atau Relawan Sosial untuk program penguatan kapasitas.</p>
    </div>

    <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('pemberdayaan.pilar.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Kategori Pilar Sosial *</label>
                    <select name="kategori_pilar" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-teal-500">
                        <option value="psm">Pekerja Sosial Masyarakat (PSM)</option>
                        <option value="tksk">Tenaga Kesejahteraan Sosial Kecamatan (TKSK)</option>
                        <option value="karang_taruna">Karang Taruna</option>
                        <option value="relawan_sosial">Relawan Sosial / Tagana</option>
                        <option value="lainnya">Pilar Sosial Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Pilar / Organisasi *</label>
                    <input type="text" name="nama_pilar" value="{{ old('nama_pilar', Auth::user()->name) }}" required placeholder="Contoh: TKSK Kec. Medan Kota / Karang Taruna Sumut" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-teal-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Kabupaten / Kota *</label>
                <input type="text" name="kab_kota" required placeholder="Contoh: Kab. Langkat / Kota Binjai" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-teal-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Usulan / Kebutuhan Pembinaan &amp; Bimtek *</label>
                <textarea name="usulan_pembinaan" rows="4" required placeholder="Jelaskan jenis penguatan kapasitas yang dibutuhkan (misal: penanganan bencana, kewirausahaan sosial, manajemen pendataan PMKS)" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-teal-500"></textarea>
            </div>

            <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('pemberdayaan.pilar.index') }}" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</a>
                <button type="submit" class="rounded-xl bg-teal-600 px-6 py-2.5 text-sm font-bold text-white shadow-md hover:bg-teal-700 transition">Kirim Usulan Pilar</button>
            </div>
        </form>
    </div>
</div>
@endsection
