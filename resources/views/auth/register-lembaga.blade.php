@extends('layouts.app')

@section('title', 'Daftar Akun Lembaga')

@section('content')
<div class="relative min-h-[calc(100vh-8rem)] flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-12">

    <div class="w-full max-w-2xl">
        <!-- Brand Header -->
        <div class="text-center mb-8">
            <h2 class="mb-2 text-4xl font-extrabold text-white tracking-tight">SADA SOSIAL</h2>
            <h3 class="text-xl font-bold text-emerald-400 tracking-tight">Registrasi Akun Lembaga</h3>
            <p class="mt-2 text-sm text-slate-400">Daftarkan lembaga, perusahaan, atau instansi Anda untuk mengakses layanan SADA SOSIAL</p>
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

            <form action="{{ route('register.lembaga') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- ── SECTION 1: Profil Penanggung Jawab ─────────────────── -->
                <div>
                    <h4 class="text-xs font-bold text-emerald-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black">1</span>
                        Profil Penanggung Jawab
                    </h4>
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Nama Penanggung Jawab -->
                        <div class="space-y-1.5">
                            <label for="name" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Penanggung Jawab <span class="text-rose-400">*</span></label>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('name') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Nama lengkap penanggung jawab">
                            @error('name')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-800/60"></div>

                <!-- ── SECTION 2: Profil Legalitas Lembaga ───────────────── -->
                <div>
                    <h4 class="text-xs font-bold text-emerald-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black">2</span>
                        Profil Legalitas Lembaga
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- Nama Lembaga -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="nama_lembaga" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lembaga / Perusahaan <span class="text-rose-400">*</span></label>
                            <input id="nama_lembaga" name="nama_lembaga" type="text" required value="{{ old('nama_lembaga') }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('nama_lembaga') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Nama resmi sesuai akta">
                            @error('nama_lembaga')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Lembaga -->
                        <div class="space-y-1.5">
                            <label for="jenis_lembaga" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Jenis Lembaga <span class="text-rose-400">*</span></label>
                            <select id="jenis_lembaga" name="jenis_lembaga" required
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('jenis_lembaga') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200">
                                <option value="" disabled {{ old('jenis_lembaga') ? '' : 'selected' }}>-- Pilih Jenis Lembaga --</option>
                                <option value="perusahaan"          {{ old('jenis_lembaga') === 'perusahaan'          ? 'selected' : '' }}>Perusahaan</option>
                                <option value="lks"                 {{ old('jenis_lembaga') === 'lks'                 ? 'selected' : '' }}>Lembaga Kesejahteraan Sosial (LKS)</option>
                                <option value="instansi_pemerintah" {{ old('jenis_lembaga') === 'instansi_pemerintah' ? 'selected' : '' }}>Instansi Pemerintah</option>
                                <option value="organisasi_sosial"   {{ old('jenis_lembaga') === 'organisasi_sosial'   ? 'selected' : '' }}>Organisasi Sosial</option>
                            </select>
                            @error('jenis_lembaga')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor Akta Pendirian -->
                        <div class="space-y-1.5">
                            <label for="no_akta" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nomor Akta Pendirian <span class="text-rose-400">*</span></label>
                            <input id="no_akta" name="no_akta" type="text" required value="{{ old('no_akta') }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('no_akta') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Contoh: 01/AKTA/2020">
                            @error('no_akta')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NPWP -->
                        <div class="space-y-1.5">
                            <label for="npwp" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">NPWP (16 Digit) <span class="text-rose-400">*</span></label>
                            <input id="npwp" name="npwp" type="text" required value="{{ old('npwp') }}"
                                maxlength="16" inputmode="numeric" pattern="\d{16}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('npwp') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200 font-mono tracking-widest"
                                placeholder="1234567890123456"
                                oninput="this.value=this.value.replace(/\D/g,'')">
                            @error('npwp')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat Lembaga -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="alamat_lembaga" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Lembaga <span class="text-rose-400">*</span></label>
                            <textarea id="alamat_lembaga" name="alamat_lembaga" required rows="3"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('alamat_lembaga') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200 resize-none"
                                placeholder="Alamat lengkap lembaga sesuai dokumen resmi">{{ old('alamat_lembaga') }}</textarea>
                            @error('alamat_lembaga')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="border-t border-slate-800/60"></div>

                <!-- ── SECTION 3: Unggah Dokumen Legalitas ───────────────── -->
                <div>
                    <h4 class="text-xs font-bold text-emerald-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black">3</span>
                        Dokumen Legalitas
                    </h4>

                    <div class="space-y-1.5">
                        <label for="dokumen_legalitas" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">
                            Unggah Dokumen <span class="text-rose-400">*</span>
                            <span class="ml-1 text-slate-500 normal-case font-normal">(Akta pendirian, NPWP, SK, dll.)</span>
                        </label>

                        <!-- Upload drop zone -->
                        <label for="dokumen_legalitas"
                            class="flex flex-col items-center justify-center w-full h-32 rounded-xl border-2 border-dashed {{ $errors->has('dokumen_legalitas') ? 'border-rose-500 bg-rose-500/5' : 'border-slate-700 bg-slate-950 hover:border-emerald-500/50 hover:bg-emerald-500/5' }} cursor-pointer transition-all duration-200 group">
                            <div class="flex flex-col items-center justify-center text-center px-4">
                                <svg class="w-8 h-8 text-slate-500 group-hover:text-emerald-400 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-xs text-slate-400 group-hover:text-slate-300 transition-colors">
                                    <span class="font-bold text-emerald-400">Klik untuk unggah</span> atau seret & lepas
                                </p>
                                <p class="text-xs text-slate-600 mt-1">PDF, JPG, PNG — Maks. 5MB</p>
                            </div>
                            <input id="dokumen_legalitas" name="dokumen_legalitas" type="file"
                                accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                                onchange="updateFileName(this)">
                        </label>

                        <!-- File name preview -->
                        <p id="file-name-preview" class="text-xs text-emerald-400 font-medium hidden mt-1">
                            ✓ <span id="file-name-text"></span>
                        </p>

                        @error('dokumen_legalitas')
                            <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="border-t border-slate-800/60"></div>

                <!-- ── SECTION 4: Informasi Akun ─────────────────────────── -->
                <div>
                    <h4 class="text-xs font-bold text-emerald-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 text-xs font-black">4</span>
                        Informasi Akun
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- Email -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Email <span class="text-rose-400">*</span></label>
                            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('email') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200"
                                placeholder="email@lembaga.com">
                            @error('email')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="space-y-1.5">
                            <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Kata Sandi <span class="text-rose-400">*</span></label>
                            <input id="password" name="password" type="password" required
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('password') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Minimal 8 karakter">
                            @error('password')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-1.5">
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Konfirmasi Kata Sandi <span class="text-rose-400">*</span></label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200"
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
                            Saya menyetujui <span class="text-emerald-400 font-semibold">Syarat &amp; Ketentuan</span> serta
                            <span class="text-emerald-400 font-semibold">Kebijakan Privasi</span> SADA SOSIAL.
                            Data yang saya masukkan adalah benar dan dapat dipertanggungjawabkan.
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
                            Setelah mendaftar, akun Anda akan dalam status <span class="font-semibold">Menunggu Verifikasi</span>.
                            Admin akan memverifikasi kelengkapan dan keaslian dokumen legalitas Anda sebelum akun diaktifkan.
                        </p>
                    </div>
                </div>

                <!-- ── Submit Button ─────────────────────────────────────── -->
                <button type="submit" id="submit-btn"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-emerald-500/20 hover:opacity-95 hover:scale-[1.01] transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Daftar &amp; Ajukan Verifikasi
                </button>

            </form>
        </div>

        <!-- Already have an account? -->
        <p class="mt-6 text-center text-sm text-slate-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-emerald-400 hover:text-emerald-300 transition-colors">Masuk di sini</a>
            <span class="mx-2 text-slate-700">·</span>
            Daftar sebagai masyarakat?
            <a href="{{ route('register.masyarakat') }}" class="font-semibold text-teal-400 hover:text-teal-300 transition-colors">Klik di sini</a>
        </p>
    </div>
</div>

<script>
    function updateFileName(input) {
        const preview = document.getElementById('file-name-preview');
        const nameText = document.getElementById('file-name-text');
        if (input.files && input.files[0]) {
            nameText.textContent = input.files[0].name;
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    }
</script>
@endsection
