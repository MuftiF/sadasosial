@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-white tracking-tight">Edit Profil</h1>
        <p class="text-sm text-slate-400 mt-1">Perbarui informasi kontak dan alamat Anda.</p>
    </div>

    <div class="glass-panel rounded-2xl p-6 sm:p-8">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Data yang tidak bisa diubah (Readonly) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 rounded-xl bg-slate-900/50 border border-slate-800">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-2">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" value="{{ $user->nik ?? '-' }}" readonly class="block w-full rounded-lg bg-slate-950 border border-slate-800 text-slate-500 px-4 py-2.5 sm:text-sm cursor-not-allowed">
                    <p class="text-[10px] text-slate-500 mt-1">NIK tidak dapat diubah setelah divalidasi.</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-2">Nomor Kartu Keluarga</label>
                    <input type="text" value="{{ $user->no_kk ?? '-' }}" readonly class="block w-full rounded-lg bg-slate-950 border border-slate-800 text-slate-500 px-4 py-2.5 sm:text-sm cursor-not-allowed">
                </div>
            </div>

            <!-- Form Edit -->
            <div>
                <label for="name" class="block text-sm font-bold text-slate-200 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="block w-full rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 sm:text-sm transition duration-200">
                @error('name')
                    <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kontak" class="block text-sm font-bold text-slate-200 mb-2">Nomor Telepon / WhatsApp</label>
                <input type="text" name="kontak" id="kontak" value="{{ old('kontak', $user->kontak) }}" class="block w-full rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 sm:text-sm transition duration-200">
                @error('kontak')
                    <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="alamat" class="block text-sm font-bold text-slate-200 mb-2">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="4" class="block w-full rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 sm:text-sm transition duration-200">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat')
                    <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex justify-end gap-4 border-t border-slate-800">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-bold text-slate-300 hover:text-white hover:bg-slate-800 transition-all duration-200">Batal</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-2.5 text-sm font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-90 hover:scale-[1.02] transition-all duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
