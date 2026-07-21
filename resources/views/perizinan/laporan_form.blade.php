@extends('layouts.app')

@section('title', 'Kirim Laporan Pelaksanaan UGB')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('perizinan.show', $perizinan->id) }}" class="text-xs font-bold text-emerald-400 hover:underline flex items-center gap-1.5 mb-4">
            &larr; Kembali ke Detail Pengajuan
        </a>
        <h1 class="text-3xl font-extrabold text-white tracking-tight">
            Laporan Pelaksanaan UGB
        </h1>
        <p class="text-sm text-slate-400 mt-1">
            Silakan unggah dokumen laporan, daftar pemenang, serta berkas dokumentasi pengundian sesuai dengan SOP Pelaksanaan UGB.
        </p>
    </div>

    <!-- Form Container -->
    <div class="glass-panel rounded-3xl p-8 glow-emerald">
        <form action="{{ route('perizinan.laporan.submit', $perizinan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Banner status jika dalam perbaikan -->
            @if($perizinan->laporan_status === 'perlu_perbaikan')
                <div class="p-4 rounded-2xl border border-amber-500/20 bg-amber-500/5 flex items-start gap-3">
                    <span class="text-lg"><x-heroicon-o-exclamation-triangle class="w-5 h-5 inline-block mr-1" /></span>
                    <div>
                        <h4 class="text-sm font-bold text-amber-400">Butuh Perbaikan Laporan</h4>
                        <p class="text-xs text-slate-300 mt-1">
                            Laporan sebelumnya dikembalikan oleh petugas untuk diperbaiki.
                        </p>
                        @if($perizinan->laporan_catatan)
                            <div class="mt-2 p-3 rounded-xl bg-slate-950 border border-slate-900">
                                <p class="text-xs text-slate-400"><strong class="text-slate-300">Catatan Petugas:</strong> {{ $perizinan->laporan_catatan }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Dokumen Laporan Pelaksanaan -->
            <div class="space-y-1.5">
                <label for="dokumen_laporan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">
                    Dokumen Laporan Pelaksanaan UGB <span class="text-rose-500">*</span>
                </label>
                <input type="file" id="dokumen_laporan" name="dokumen_laporan"
                    class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-emerald-500">
                <p class="text-[10px] text-slate-500">Format file: PDF atau DOCX. Maksimal ukuran 5MB.</p>
                @if(isset($laporanData['dokumen_laporan']))
                    <div class="flex items-center gap-1.5 mt-1.5">
                        <span class="text-xs text-slate-400">Berkas saat ini:</span>
                        <a href="{{ Storage::url($laporanData['dokumen_laporan']) }}" target="_blank" class="text-xs text-emerald-400 hover:underline">Lihat Berkas &rarr;</a>
                        <input type="hidden" name="existing_dokumen_laporan" value="1">
                    </div>
                @endif
                @error('dokumen_laporan')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Daftar Pemenang Undian -->
            <div class="space-y-1.5">
                <label for="daftar_pemenang" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">
                    Daftar Pemenang Undian <span class="text-rose-500">*</span>
                </label>
                <input type="file" id="daftar_pemenang" name="daftar_pemenang"
                    class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-emerald-500">
                <p class="text-[10px] text-slate-500">Format file: PDF, XLSX, atau XLS. Maksimal ukuran 5MB.</p>
                @if(isset($laporanData['daftar_pemenang']))
                    <div class="flex items-center gap-1.5 mt-1.5">
                        <span class="text-xs text-slate-400">Berkas saat ini:</span>
                        <a href="{{ Storage::url($laporanData['daftar_pemenang']) }}" target="_blank" class="text-xs text-emerald-400 hover:underline">Lihat Berkas &rarr;</a>
                        <input type="hidden" name="existing_daftar_pemenang" value="1">
                    </div>
                @endif
                @error('daftar_pemenang')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dokumentasi Kegiatan -->
            <div class="space-y-1.5">
                <label for="dokumentasi_kegiatan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">
                    Dokumentasi Kegiatan (Foto Saksi, Notaris, Penyegelan) <span class="text-rose-500">*</span>
                </label>
                <input type="file" id="dokumentasi_kegiatan" name="dokumentasi_kegiatan"
                    class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-emerald-500">
                <p class="text-[10px] text-slate-500">Format file: ZIP, PDF, atau Gambar. Maksimal ukuran 5MB.</p>
                @if(isset($laporanData['dokumentasi_kegiatan']))
                    <div class="flex items-center gap-1.5 mt-1.5">
                        <span class="text-xs text-slate-400">Berkas saat ini:</span>
                        <a href="{{ Storage::url($laporanData['dokumentasi_kegiatan']) }}" target="_blank" class="text-xs text-emerald-400 hover:underline">Lihat Berkas &rarr;</a>
                        <input type="hidden" name="existing_dokumentasi_kegiatan" value="1">
                    </div>
                @endif
                @error('dokumentasi_kegiatan')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan Pelaksanaan -->
            <div class="space-y-1.5">
                <label for="catatan_pelaksanaan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">
                    Catatan Ringkas Pelaksanaan Kegiatan <span class="text-rose-500">*</span>
                </label>
                <textarea id="catatan_pelaksanaan" name="catatan_pelaksanaan" required rows="4"
                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                    placeholder="Tuliskan tanggal, lokasi, jumlah peserta, notaris/saksi yang hadir, dan jalannya pengundian...">{{ old('catatan_pelaksanaan', $laporanData['catatan_pelaksanaan'] ?? '') }}</textarea>
                @error('catatan_pelaksanaan')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex gap-4">
                <a href="{{ route('perizinan.show', $perizinan->id) }}" class="w-1/2 text-center rounded-xl bg-slate-900 py-3 text-xs font-bold text-slate-300 border border-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                    Batal
                </a>
                <button type="submit" class="w-1/2 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 py-3 text-xs font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-90 hover:scale-[1.01] transition-all duration-200">
                    Kirim Laporan Pelaksanaan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
