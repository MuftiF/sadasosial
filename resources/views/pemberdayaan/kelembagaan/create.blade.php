@extends('layouts.app')

@section('title', 'Form Pengajuan Pembinaan Kelembagaan - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-4xl sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('pemberdayaan.kelembagaan.index') }}" class="text-sm font-semibold text-emerald-600 hover:underline">&larr; Kembali ke Daftar</a>
        <h1 class="text-2xl font-bold text-slate-900 mt-2">Form Pengajuan Pembinaan Kelembagaan Sosial</h1>
        <p class="text-sm text-slate-600">Isi formulir data LKS / Organisasi Sosial untuk mengajukan pembinaan ke Bidang Pemberdayaan Sosial.</p>
    </div>

    <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('pemberdayaan.kelembagaan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Lembaga / Orsos *</label>
                    <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga', Auth::user()->nama_lembaga ?? Auth::user()->name) }}" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Jenis Lembaga *</label>
                    <select name="jenis_lembaga" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="Lembaga Kesejahteraan Sosial (LKS)">Lembaga Kesejahteraan Sosial (LKS)</option>
                        <option value="Organisasi Sosial (Orsos)">Organisasi Sosial (Orsos)</option>
                        <option value="Yayasan Sosial">Yayasan Sosial</option>
                        <option value="Lembaga Swadaya Masyarakat">Lembaga Swadaya Masyarakat</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nomor Registrasi (Opsional)</label>
                    <input type="text" name="nomor_registrasi" placeholder="No. Izin / Registrasi Dinsos" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Kabupaten / Kota *</label>
                    <input type="text" name="kab_kota" placeholder="Contoh: Kota Medan / Kab. Deli Serdang" required class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Alamat Lembaga *</label>
                <textarea name="alamat_lembaga" rows="3" required placeholder="Alamat lengkap lokasi sekretariat/kantor lembaga" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Usulan / Kebutuhan Pembinaan</label>
                <textarea name="usulan_pembinaan" rows="3" placeholder="Jelaskan kebutuhan pembinaan (misal: tata kelola administrasi, legalitas, akreditasi, manajemen program)" class="w-full rounded-xl p-3 border border-slate-300 text-sm focus:ring-2 focus:ring-emerald-500"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Dokumen Permohonan / Profil Lembaga (Opsional)</label>
                <input type="file" name="dokumen_permohonan" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm text-slate-600 bg-white">
                <span class="text-xs text-slate-400 mt-1 block">Format: PDF, DOC, DOCX, JPG, PNG (Max 5MB)</span>
            </div>

            <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('pemberdayaan.kelembagaan.index') }}" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</a>
                <button type="submit" class="rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white shadow-md hover:bg-emerald-700 transition">Kirim Pengajuan</button>
            </div>
        </form>
    </div>
</div>
@endsection
