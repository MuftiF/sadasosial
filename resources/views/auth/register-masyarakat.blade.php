@extends('layouts.app')

@section('title', 'Daftar Akun Masyarakat')

@section('content')
<div class="relative min-h-[calc(100vh-8rem)] flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-12">

    <div class="w-full max-w-2xl">
        <!-- Brand Header -->
        <div class="text-center mb-8">
            <h2 class="mb-2 text-4xl font-extrabold text-white tracking-tight">SADA SOSIAL</h2>
            <h3 class="text-xl font-bold text-teal-400 tracking-tight">Registrasi Akun Masyarakat</h3>
            <p class="mt-2 text-sm text-slate-400">Daftarkan diri Anda untuk mengakses layanan SADA SOSIAL</p>
        </div>

        <!-- Success / Error Flash Messages -->
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-400 font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3">
                <p class="text-sm font-bold text-rose-400 mb-2">Terdapat kesalahan pada formulir:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-xs text-rose-300">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Registration Card -->
        <div class="glass-panel rounded-2xl p-8 glow-emerald shadow-2xl">

            <form action="{{ route('register.masyarakat') }}" method="POST" class="space-y-6">
                @csrf

                <!-- ── SECTION 1: Profil Masyarakat ─────────────────── -->
                <div>
                    <h4 class="text-xs font-bold text-teal-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-teal-500/20 text-teal-400 text-xs font-black">1</span>
                        Data Profil Diri
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nama Lengkap -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="name" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lengkap <span class="text-rose-400">*</span></label>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('name') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Nama lengkap sesuai KTP">
                            @error('name')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <div class="space-y-1.5">
                            <label for="nik" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">NIK (16 Digit) <span class="text-rose-400">*</span></label>
                            <input id="nik" name="nik" type="text" required value="{{ old('nik') }}"
                                maxlength="16" inputmode="numeric" pattern="\d{16}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('nik') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200 font-mono tracking-widest"
                                placeholder="320xxxxxxxxxxxxx"
                                oninput="this.value=this.value.replace(/\D/g,'')">
                            @error('nik')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No KK -->
                        <div class="space-y-1.5">
                            <label for="no_kk" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nomor Kartu Keluarga (16 Digit) <span class="text-rose-400">*</span></label>
                            <input id="no_kk" name="no_kk" type="text" required value="{{ old('no_kk') }}"
                                maxlength="16" inputmode="numeric" pattern="\d{16}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('no_kk') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200 font-mono tracking-widest"
                                placeholder="320xxxxxxxxxxxxx"
                                oninput="this.value=this.value.replace(/\D/g,'')">
                            @error('no_kk')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kontak -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="kontak" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nomor HP / WhatsApp <span class="text-rose-400">*</span></label>
                            <input id="kontak" name="kontak" type="text" required value="{{ old('kontak') }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('kontak') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Contoh: 08xxxxxxxxxx">
                            @error('kontak')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="alamat" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Tempat Tinggal <span class="text-rose-400">*</span></label>
                            <textarea id="alamat" name="alamat" required rows="3"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('alamat') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200 resize-none"
                                placeholder="Alamat lengkap sesuai KTP">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-800/60"></div>

                <!-- ── SECTION 2: Informasi Akun ─────────────────────────── -->
                <div>
                    <h4 class="text-xs font-bold text-teal-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-teal-500/20 text-teal-400 text-xs font-black">2</span>
                        Informasi Akun
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- Email -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Email <span class="text-rose-400">*</span></label>
                            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('email') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200"
                                placeholder="nama@email.com">
                            @error('email')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="space-y-1.5">
                            <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Kata Sandi <span class="text-rose-400">*</span></label>
                            <input id="password" name="password" type="password" required
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('password') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Minimal 8 karakter">
                            @error('password')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-1.5">
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Konfirmasi Kata Sandi <span class="text-rose-400">*</span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Ulangi kata sandi">
                        </div>

                    </div>
                </div>

                <div class="border-t border-slate-800/60"></div>

                <!-- ── Syarat & Ketentuan ─────────────────────────────────── -->
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <input id="terms" name="terms" type="checkbox" value="1" {{ old('terms') ? 'checked' : '' }}
                            class="mt-0.5 h-4 w-4 rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-500/20 focus:ring-offset-0 focus:outline-none flex-shrink-0">
                        <label for="terms" class="text-xs text-slate-400 leading-relaxed cursor-pointer select-none">
                            Saya menyetujui <span class="text-teal-400 font-semibold">Syarat &amp; Ketentuan</span> serta
                            <span class="text-teal-400 font-semibold">Kebijakan Privasi</span> SADA SOSIAL.
                            Data yang saya masukkan adalah benar dan dapat dipertanggungjawabkan sesuai NIK &amp; KK saya.
                        </label>
                    </div>
                    @error('terms')
                        <p class="text-xs text-rose-400 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ── Info Notice ────────────────────────────────────────── -->
                <div class="rounded-xl border border-amber-500/20 bg-amber-500/5 px-4 py-3">
                    <div class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-amber-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-xs text-amber-300/80 leading-relaxed">
                            <span class="font-bold text-amber-400">Perhatian:</span>
                            Setelah mendaftar, akun Anda akan berada dalam status <span class="font-semibold">Menunggu Verifikasi</span>.
                            Petugas verifikator kami akan memeriksa keaslian identitas NIK dan Nomor KK Anda sebelum akun diaktifkan.
                        </p>
                    </div>
                </div>

                <!-- ── Submit Button ─────────────────────────────────────── -->
                <button type="submit" id="submit-btn"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-teal-500 to-emerald-400 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-teal-500/20 hover:opacity-95 hover:scale-[1.01] transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Daftar &amp; Ajukan Verifikasi Akun
                </button>

            </form>
        </div>

        <!-- Already have an account? -->
        <p class="mt-6 text-center text-sm text-slate-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-teal-400 hover:text-teal-300 transition-colors">Masuk di sini</a>
            <span class="mx-2 text-slate-700">·</span>
            Daftar sebagai Lembaga / Instansi?
            <a href="{{ route('register.lembaga') }}" class="font-semibold text-emerald-400 hover:text-emerald-300 transition-colors">Klik di sini</a>
        </p>
    </div>
</div>
@endsection
