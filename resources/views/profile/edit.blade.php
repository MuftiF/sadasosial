@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-white tracking-tight">Edit Profil</h1>
        <p class="text-sm text-slate-400 mt-1">Perbarui informasi kontak dan profil Anda.</p>
    </div>

    <!-- Alert: Pending Change Request -->
    @if($pendingRequest)
        <div class="mb-8 p-5 rounded-2xl border border-amber-500/30 bg-amber-500/5 flex gap-4 items-start">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-500/10 text-amber-400 text-lg">
                ⏳
            </span>
            <div>
                <h4 class="text-sm font-bold text-amber-400">Pengajuan Perubahan Profil Sedang Ditinjau</h4>
                <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                    Anda telah mengajukan perubahan data berikut dan saat ini sedang menunggu persetujuan dari Verifikator Administrasi:
                </p>
                
                <div class="mt-3 overflow-x-auto rounded-xl border border-slate-800 bg-slate-950/60 p-4">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-slate-800 text-slate-500 font-bold uppercase tracking-wider">
                                <th class="pb-2">Field/Data</th>
                                <th class="pb-2">Nilai Baru</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/40 text-slate-300">
                            @foreach($pendingRequest->requested_changes as $key => $value)
                                <tr>
                                    <td class="py-2 font-semibold text-slate-400 uppercase tracking-wide text-[10px]">
                                        {{ str_replace('_', ' ', $key) }}
                                    </td>
                                    <td class="py-2">
                                        @if($key === 'dokumen_legalitas')
                                            <a href="/storage/{{ $value }}" target="_blank" class="text-emerald-400 hover:underline font-medium">Lihat Dokumen Baru ↗</a>
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text-[10px] text-slate-500 mt-3">
                    Anda tidak dapat melakukan perubahan profil baru hingga pengajuan ini disetujui atau ditolak.
                </p>
            </div>
        </div>
    @endif

    <div class="glass-panel rounded-2xl p-6 sm:p-8">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Field Group -->
            <div class="space-y-6 {{ $pendingRequest ? 'opacity-60 pointer-events-none select-none' : '' }}">
                
                @if($user->isLembaga())
                    <!-- For Lembaga: Show editable fields that require review -->
                    <div>
                        <h4 class="text-xs font-bold text-indigo-400 uppercase tracking-widest mb-4">Profil Lembaga</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 rounded-xl bg-slate-900/30 border border-slate-800/60">
                            <div>
                                <label for="nama_lembaga" class="block text-xs font-bold text-slate-300 uppercase tracking-wide mb-2">Nama Lembaga</label>
                                <input type="text" name="nama_lembaga" id="nama_lembaga" value="{{ old('nama_lembaga', $user->nama_lembaga) }}" class="block w-full rounded-lg bg-slate-950 border border-slate-800 text-white px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none">
                                @error('nama_lembaga') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="jenis_lembaga" class="block text-xs font-bold text-slate-300 uppercase tracking-wide mb-2">Jenis Lembaga</label>
                                <select name="jenis_lembaga" id="jenis_lembaga" class="block w-full rounded-lg bg-slate-950 border border-slate-800 text-white px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none">
                                    <option value="perusahaan" {{ old('jenis_lembaga', $user->jenis_lembaga) == 'perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                                    <option value="lks" {{ old('jenis_lembaga', $user->jenis_lembaga) == 'lks' ? 'selected' : '' }}>Lembaga Kesejahteraan Sosial (LKS)</option>
                                    <option value="instansi_pemerintah" {{ old('jenis_lembaga', $user->jenis_lembaga) == 'instansi_pemerintah' ? 'selected' : '' }}>Instansi Pemerintah</option>
                                    <option value="organisasi_sosial" {{ old('jenis_lembaga', $user->jenis_lembaga) == 'organisasi_sosial' ? 'selected' : '' }}>Organisasi Sosial</option>
                                </select>
                                @error('jenis_lembaga') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="no_akta" class="block text-xs font-bold text-slate-300 uppercase tracking-wide mb-2">Nomor Akta Pendirian</label>
                                <input type="text" name="no_akta" id="no_akta" value="{{ old('no_akta', $user->no_akta) }}" class="block w-full rounded-lg bg-slate-950 border border-slate-800 text-white px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none">
                                @error('no_akta') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="npwp" class="block text-xs font-bold text-slate-300 uppercase tracking-wide mb-2">NPWP</label>
                                <input type="text" name="npwp" id="npwp" value="{{ old('npwp', $user->npwp) }}" maxlength="16" class="block w-full rounded-lg bg-slate-950 border border-slate-800 text-white px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none font-mono">
                                @error('npwp') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="alamat_lembaga" class="block text-xs font-bold text-slate-300 uppercase tracking-wide mb-2">Alamat Lembaga</label>
                                <textarea name="alamat_lembaga" id="alamat_lembaga" class="block w-full rounded-lg bg-slate-950 border border-slate-800 text-white px-4 py-2.5 text-sm focus:border-indigo-500 focus:outline-none resize-none" rows="2">{{ old('alamat_lembaga', $user->alamat_lembaga) }}</textarea>
                                @error('alamat_lembaga') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="dokumen_legalitas" class="block text-xs font-bold text-slate-300 uppercase tracking-wide mb-2">Unggah Dokumen Legalitas Baru (Opsional)</label>
                                @if($user->dokumen_legalitas)
                                    <p class="text-xs text-slate-500 mb-2">File saat ini: <a href="/storage/{{ $user->dokumen_legalitas }}" target="_blank" class="text-indigo-400 hover:underline">Lihat Dokumen ↗</a></p>
                                @endif
                                <input type="file" name="dokumen_legalitas" id="dokumen_legalitas" class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700 rounded-lg bg-slate-950 border border-slate-800 px-4 py-2 focus:outline-none">
                                @error('dokumen_legalitas') <p class="mt-1 text-xs text-rose-400">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                @else
                    <!-- For Masyarakat: Keep NIK and KK read-only -->
                    <div>
                        <h4 class="text-xs font-bold text-teal-400 uppercase tracking-widest mb-4">Identitas Dasar (Read-only)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 rounded-xl bg-slate-900/30 border border-slate-800/60">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">NIK (Nomor Induk Kependudukan)</label>
                                <input type="text" value="{{ $user->nik ?? '-' }}" readonly class="block w-full rounded-lg bg-slate-950 border border-slate-900 text-slate-500 px-4 py-2.5 text-sm cursor-not-allowed font-mono">
                                <p class="text-[10px] text-slate-500 mt-1">NIK tidak dapat diubah secara mandiri.</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Nomor Kartu Keluarga</label>
                                <input type="text" value="{{ $user->no_kk ?? '-' }}" readonly class="block w-full rounded-lg bg-slate-950 border border-slate-900 text-slate-500 px-4 py-2.5 text-sm cursor-not-allowed font-mono">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Contact & Name Fields (Editable for both) -->
                <div>
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Informasi Kontak</h4>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-bold text-slate-200 mb-2">Nama {{ $user->isLembaga() ? 'Penanggung Jawab' : 'Lengkap' }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="block w-full rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 text-sm transition duration-200">
                            @error('name')
                                <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kontak" class="block text-sm font-bold text-slate-200 mb-2">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="kontak" id="kontak" value="{{ old('kontak', $user->kontak) }}" class="block w-full rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 text-sm transition duration-200">
                            @error('kontak')
                                <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-bold text-slate-200 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="4" class="block w-full rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-3 text-sm transition duration-200">{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat')
                                <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-4 flex justify-end gap-4 border-t border-slate-800">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-bold text-slate-300 hover:text-white hover:bg-slate-800 transition-all duration-200">Batal</a>
                <button type="submit" {{ $pendingRequest ? 'disabled' : '' }} class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-2.5 text-sm font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-90 hover:scale-[1.02] transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                    Ajukan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
