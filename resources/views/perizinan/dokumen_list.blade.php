@extends('layouts.app')

@section('title', 'Dokumen Persyaratan — ' . $perizinan->nomor_izin ?? ('ID #'.$perizinan->id))

@section('content')
<div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('perizinan.show', $perizinan->id) }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-4">
            &larr; Kembali ke Detail Permohonan
        </a>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Kelengkapan Dokumen Persyaratan</h1>
        <p class="text-sm text-slate-500 mt-1">
            Permohonan: <span class="font-semibold text-emerald-700">{{ $perizinan->nomor_izin ?? ('ID #' . $perizinan->id) }}</span>
            &mdash; {{ $perizinan->pemohon->name }} ({{ strtoupper($perizinan->jenis_layanan) }})
        </p>
    </div>

    <!-- Upload Form (Hanya untuk pemohon atau jika belum lengkap/ditolak) -->
    @if(Auth::id() === $perizinan->pemohon_id || Auth::user()->isStaff())
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-8">
        <h2 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
            <span class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 text-xs"><x-heroicon-o-arrow-up-tray class="w-5 h-5 inline-block mr-1" /></span>
            Upload Dokumen Baru / Perbaikan
        </h2>
        <form action="{{ route('perizinan.dokumen.upload', $perizinan->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-4 items-end">
            @csrf
            <div class="w-full sm:w-1/3">
                <label for="jenis_dokumen" class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1.5">Jenis Dokumen</label>
                <select name="jenis_dokumen" id="jenis_dokumen" required
                    class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                    <option value="">-- Pilih --</option>
                    @foreach($namaLabels as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full sm:w-1/3">
                <label for="file_dokumen" class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-1.5">File PDF (Maks 10MB)</label>
                <input type="file" name="file_dokumen" id="file_dokumen" required accept=".pdf"
                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
            </div>
            <div class="w-full sm:w-auto">
                <button type="submit"
                    class="w-full rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-2.5 text-sm font-bold text-white shadow hover:opacity-90 transition">
                    Upload
                </button>
            </div>
        </form>
    </div>
    @endif

    <!-- Tabel Dokumen -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Dokumen</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">File</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Status / Verifikasi</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Diunggah Oleh</th>
                    @if(Auth::user()->isStaff())
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wide">Aksi Staff</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($dokumens as $doc)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-5 py-4">
                        <p class="font-bold text-slate-800">{{ $doc->nama_dokumen }}</p>
                        <p class="text-[10px] text-slate-500 mt-0.5">{{ $doc->jenis_dokumen }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-emerald-700">
                            <x-heroicon-o-document-text class="w-4 h-4 inline-block mr-1" /> Lihat PDF
                        </a>
                    </td>
                    <td class="px-5 py-4">
                        @if($doc->status === 'verified')
                            <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-[10px] font-bold text-emerald-700"><x-heroicon-o-check-circle class="w-5 h-5 inline-block mr-1" /> Terverifikasi</span>
                        @elseif($doc->status === 'rejected')
                            <span class="inline-flex items-center rounded-full bg-rose-100 px-2.5 py-0.5 text-[10px] font-bold text-rose-700"><x-heroicon-o-x-circle class="w-4 h-4 inline-block mr-1" /> Ditolak</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-[10px] font-bold text-amber-700"><x-heroicon-o-clock class="w-5 h-5 inline-block mr-1" /> Menunggu Verifikasi</span>
                        @endif

                        @if($doc->catatan)
                            <p class="text-[10px] text-rose-600 mt-1 italic">"{{ $doc->catatan }}"</p>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-xs">
                        <p class="text-slate-800 font-semibold">{{ $doc->uploader->name ?? '-' }}</p>
                        <p class="text-[10px] text-slate-500">{{ $doc->created_at->format('d/m/Y H:i') }}</p>
                    </td>
                    @if(Auth::user()->isStaff())
                    <td class="px-5 py-4">
                        <form action="{{ route('dokumen.review', $doc->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input type="text" name="catatan" placeholder="Catatan (opsional)" class="rounded-lg border border-slate-300 px-2 py-1 text-[10px] w-32 focus:border-emerald-500">
                            <button type="submit" name="status" value="verified" title="Verifikasi" class="text-emerald-600 hover:text-emerald-800 text-lg"><x-heroicon-o-check-circle class="w-5 h-5 inline-block mr-1" /></button>
                            <button type="submit" name="status" value="rejected" title="Tolak" class="text-rose-600 hover:text-rose-800 text-lg"><x-heroicon-o-x-circle class="w-4 h-4 inline-block mr-1" /></button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ Auth::user()->isStaff() ? '5' : '4' }}" class="px-5 py-12 text-center text-slate-400 text-sm">
                        Belum ada dokumen yang diunggah secara terpisah.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
