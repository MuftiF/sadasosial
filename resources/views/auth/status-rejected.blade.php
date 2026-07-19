@extends('layouts.app')

@section('title', 'Pendaftaran Ditolak / Perlu Perbaikan')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 flex flex-col items-center">
    
    <!-- Top Header -->
    <div class="w-full text-center mb-8">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">SADA SOSIAL</h2>
        <h3 class="text-lg font-bold text-rose-400 mt-1">Perbaikan Pendaftaran Akun</h3>
        <p class="text-sm text-slate-400 mt-2">Akun Anda memerlukan perbaikan data sebelum dapat diaktifkan.</p>
    </div>

    <!-- Alert Box: Rejection Reason -->
    <div class="w-full p-5 rounded-2xl border border-rose-500/30 bg-rose-500/5 mb-8 flex gap-4 items-start">
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-500/10 text-rose-400 text-lg">
            ⚠️
        </span>
        <div>
            <h4 class="text-sm font-bold text-rose-400">Pendaftaran Ditolak / Perlu Perbaikan</h4>
            <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                Pengajuan pendaftaran Anda ditolak oleh Verifikator Administrasi dengan alasan:
            </p>
            <div class="mt-3 p-3 rounded-lg bg-slate-950 border border-slate-800 text-xs text-slate-200 italic font-mono">
                "{{ Auth::user()->validation_note ?? 'Tidak ada catatan penolakan spesifik.' }}"
            </div>
            <p class="text-[11px] text-slate-400 mt-3">
                Silakan perbaiki data atau dokumen yang tidak sesuai pada formulir di bawah ini dan kirimkan kembali untuk peninjauan ulang.
            </p>
        </div>
    </div>

    <!-- Main Card -->
    <div class="glass-panel w-full rounded-2xl p-6 sm:p-8 glow-rose border-rose-500/10 shadow-2xl">
        <form action="{{ route('account.resubmit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Form Fields based on Account Type -->
            @if(Auth::user()->isLembaga())
                <!-- Lembaga Fields -->
                <div>
                    <h4 class="text-xs font-bold text-indigo-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-indigo-500/20 text-indigo-400 text-xs font-black">1</span>
                        Profil Lembaga & Legalitas
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="nama_lembaga" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lembaga <span class="text-rose-400">*</span></label>
                            <input id="nama_lembaga" name="nama_lembaga" type="text" required value="{{ old('nama_lembaga', Auth::user()->nama_lembaga) }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('nama_lembaga') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200">
                            @error('nama_lembaga')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="jenis_lembaga" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Jenis Lembaga <span class="text-rose-400">*</span></label>
                            <select id="jenis_lembaga" name="jenis_lembaga" required
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('jenis_lembaga') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200">
                                <option value="perusahaan" {{ old('jenis_lembaga', Auth::user()->jenis_lembaga) == 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                                <option value="lks" {{ old('jenis_lembaga', Auth::user()->jenis_lembaga) == 'lks' ? 'selected' : '' }}>Lembaga Kesejahteraan Sosial (LKS)</option>
                                <option value="instansi_pemerintah" {{ old('jenis_lembaga', Auth::user()->jenis_lembaga) == 'instansi_pemerintah' ? 'selected' : '' }}>Instansi Pemerintah</option>
                                <option value="organisasi_sosial" {{ old('jenis_lembaga', Auth::user()->jenis_lembaga) == 'organisasi_sosial' ? 'selected' : '' }}>Organisasi Sosial</option>
                            </select>
                            @error('jenis_lembaga')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="no_akta" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">No. Akta Pendirian <span class="text-rose-400">*</span></label>
                            <input id="no_akta" name="no_akta" type="text" required value="{{ old('no_akta', Auth::user()->no_akta) }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('no_akta') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200">
                            @error('no_akta')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="npwp" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">NPWP Lembaga (16 Digit) <span class="text-rose-400">*</span></label>
                            <input id="npwp" name="npwp" type="text" required value="{{ old('npwp', Auth::user()->npwp) }}"
                                maxlength="16" inputmode="numeric" pattern="\d{16}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('npwp') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200 font-mono"
                                placeholder="16 digit angka" oninput="this.value=this.value.replace(/\D/g,'')">
                            @error('npwp')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="name" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Penanggung Jawab <span class="text-rose-400">*</span></label>
                            <input id="name" name="name" type="text" required value="{{ old('name', Auth::user()->name) }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('name') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200">
                            @error('name')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="alamat_lembaga" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Lembaga <span class="text-rose-400">*</span></label>
                            <textarea id="alamat_lembaga" name="alamat_lembaga" required rows="3"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('alamat_lembaga') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200 resize-none">{{ old('alamat_lembaga', Auth::user()->alamat_lembaga) }}</textarea>
                            @error('alamat_lembaga')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 space-y-2">
                            <label for="dokumen_legalitas" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Unggah Dokumen Legalitas (PDF/JPG/PNG, Max 5MB) <span class="text-rose-400">*</span></label>
                            @if(Auth::user()->dokumen_legalitas)
                                <div class="text-xs text-slate-400 mb-2 flex items-center gap-1.5">
                                    <span>Dokumen saat ini:</span>
                                    <a href="/storage/{{ Auth::user()->dokumen_legalitas }}" target="_blank" class="text-indigo-400 hover:underline">Lihat Dokumen ↗</a>
                                </div>
                            @endif
                            <input id="dokumen_legalitas" name="dokumen_legalitas" type="file"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 file:cursor-pointer cursor-pointer rounded-xl bg-slate-950 border {{ $errors->has('dokumen_legalitas') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-2.5 focus:outline-none">
                            @error('dokumen_legalitas')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            @else
                <!-- Masyarakat Fields -->
                <div>
                    <h4 class="text-xs font-bold text-teal-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-teal-500/20 text-teal-400 text-xs font-black">1</span>
                        Data Profil Diri
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="name" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lengkap <span class="text-rose-400">*</span></label>
                            <input id="name" name="name" type="text" required value="{{ old('name', Auth::user()->name) }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('name') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Nama lengkap sesuai KTP">
                            @error('name')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="nik" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">NIK (16 Digit) <span class="text-rose-400">*</span></label>
                            <input id="nik" name="nik" type="text" required value="{{ old('nik', Auth::user()->nik) }}"
                                maxlength="16" inputmode="numeric" pattern="\d{16}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('nik') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200 font-mono"
                                placeholder="16 digit angka" oninput="this.value=this.value.replace(/\D/g,'')">
                            @error('nik')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="no_kk" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nomor Kartu Keluarga (16 Digit) <span class="text-rose-400">*</span></label>
                            <input id="no_kk" name="no_kk" type="text" required value="{{ old('no_kk', Auth::user()->no_kk) }}"
                                maxlength="16" inputmode="numeric" pattern="\d{16}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('no_kk') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200 font-mono"
                                placeholder="16 digit angka" oninput="this.value=this.value.replace(/\D/g,'')">
                            @error('no_kk')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="kontak" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nomor HP / WhatsApp <span class="text-rose-400">*</span></label>
                            <input id="kontak" name="kontak" type="text" required value="{{ old('kontak', Auth::user()->kontak) }}"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('kontak') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200">
                            @error('kontak')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="alamat" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Tempat Tinggal <span class="text-rose-400">*</span></label>
                            <textarea id="alamat" name="alamat" required rows="3"
                                class="block w-full rounded-xl bg-slate-950 border {{ $errors->has('alamat') ? 'border-rose-500' : 'border-slate-800' }} px-4 py-3 text-sm text-white focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all duration-200 resize-none">{{ old('alamat', Auth::user()->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif

            <!-- Common Action Buttons -->
            <div class="pt-6 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between gap-4">
                <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-xs font-bold text-slate-400 ring-1 ring-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                        Keluar Aplikasi
                    </button>
                </form>

                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-gradient-to-r {{ Auth::user()->isLembaga() ? 'from-indigo-500 to-violet-400' : 'from-emerald-500 to-teal-400' }} px-6 py-3 text-xs font-extrabold text-slate-950 shadow-md hover:opacity-95 hover:scale-[1.01] transition-all duration-200">
                    Kirim Perbaikan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
