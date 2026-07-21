@extends('layouts.app')

@section('title', 'Berita Acara Pemeriksaan — ' . $perizinan->nomor_izin ?? '#' . $perizinan->id)

@section('content')
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('perizinan.show', $perizinan->id) }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-4">
            &larr; Kembali ke Detail Permohonan
        </a>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Berita Acara Pemeriksaan</h1>
        <p class="text-sm text-slate-500 mt-1">
            Permohonan: <span class="font-semibold text-emerald-700">{{ $perizinan->nomor_izin ?? ('ID #' . $perizinan->id) }}</span>
            &mdash; {{ $perizinan->pemohon->name }} ({{ strtoupper($perizinan->jenis_layanan) }})
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Buat BA Baru -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-base font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 text-sm"><x-heroicon-o-pencil-square class="w-4 h-4 inline-block mr-1" /></span>
                    Buat Berita Acara Baru
                </h2>

                <form action="{{ route('admin.perizinan.berita_acara.store', $perizinan->id) }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label for="tanggal_pemeriksaan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Tanggal Pemeriksaan <span class="text-rose-500">*</span></label>
                            <input type="date" id="tanggal_pemeriksaan" name="tanggal_pemeriksaan" required
                                value="{{ old('tanggal_pemeriksaan', date('Y-m-d')) }}"
                                class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                        </div>
                        <div class="space-y-1.5">
                            <label for="jenis_pemeriksaan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Jenis Pemeriksaan <span class="text-rose-500">*</span></label>
                            <select id="jenis_pemeriksaan" name="jenis_pemeriksaan" required
                                class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                                <option value="lapangan" {{ old('jenis_pemeriksaan') === 'lapangan' ? 'selected' : '' }}>Pemeriksaan Lapangan</option>
                                <option value="dokumen" {{ old('jenis_pemeriksaan') === 'dokumen' ? 'selected' : '' }}>Pemeriksaan Dokumen</option>
                                <option value="virtual" {{ old('jenis_pemeriksaan') === 'virtual' ? 'selected' : '' }}>Pemeriksaan Virtual/Online</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="hasil_pemeriksaan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Hasil Pemeriksaan <span class="text-rose-500">*</span></label>
                        <textarea id="hasil_pemeriksaan" name="hasil_pemeriksaan" required rows="5"
                            class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none"
                            placeholder="Tuliskan narasi hasil pemeriksaan secara lengkap...">{{ old('hasil_pemeriksaan') }}</textarea>
                    </div>

                    <!-- Checklist Lapangan (untuk pemeriksaan lapangan) -->
                    <div id="checklist-section" class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wide">Checklist Instrumen Lapangan</h4>
                        @php
                        $checklistItems = [
                            'lokasi_sesuai'     => 'Lokasi sesuai dengan yang tertera dalam permohonan',
                            'fasilitas_memadai' => 'Fasilitas dan sarana kegiatan memadai',
                            'personil_cukup'    => 'Personil pengurus yang hadir mencukupi',
                            'dokumen_asli'      => 'Dokumen asli dapat ditunjukkan',
                            'tidak_pelanggaran' => 'Tidak ditemukan pelanggaran di lapangan',
                        ];
                        @endphp
                        @foreach($checklistItems as $key => $label)
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="checklist[{{ $key }}]" value="1"
                                class="h-4 w-4 rounded border-slate-300 text-emerald-600">
                            <span class="text-sm text-slate-700">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>

                    <div class="space-y-1.5">
                        <label for="rekomendasi" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Rekomendasi <span class="text-rose-500">*</span></label>
                        <select id="rekomendasi" name="rekomendasi" required
                            class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                            <option value="">-- Pilih Rekomendasi --</option>
                            <option value="terbitkan" {{ old('rekomendasi') === 'terbitkan' ? 'selected' : '' }}><x-heroicon-o-check-circle class="w-5 h-5 inline-block mr-1" /> Rekomendasikan Penerbitan Izin</option>
                            <option value="perbaikan" {{ old('rekomendasi') === 'perbaikan' ? 'selected' : '' }}><x-heroicon-o-exclamation-triangle class="w-5 h-5 inline-block mr-1" /> Perlu Perbaikan / Kelengkapan Tambahan</option>
                            <option value="tolak" {{ old('rekomendasi') === 'tolak' ? 'selected' : '' }}><x-heroicon-o-x-circle class="w-4 h-4 inline-block mr-1" /> Rekomendasi Penolakan</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label for="catatan_tambahan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Catatan Tambahan</label>
                        <textarea id="catatan_tambahan" name="catatan_tambahan" rows="3"
                            class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none"
                            placeholder="Catatan khusus, kondisi lapangan, dll...">{{ old('catatan_tambahan') }}</textarea>
                    </div>

                    <!-- Tanda Tangan Elektronik -->
                    <div class="border-t border-slate-200 pt-5">
                        <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wide mb-4">🖊️ Tanda Tangan Elektronik Petugas</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="space-y-1.5">
                                <label for="nama_penandatangan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Nama Lengkap <span class="text-rose-500">*</span></label>
                                <input type="text" id="nama_penandatangan" name="nama_penandatangan" required
                                    value="{{ old('nama_penandatangan', $user->name) }}"
                                    class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                            </div>
                            <div class="space-y-1.5">
                                <label for="nip_penandatangan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">NIP <span class="text-rose-500">*</span></label>
                                <input type="text" id="nip_penandatangan" name="nip_penandatangan" required
                                    value="{{ old('nip_penandatangan') }}"
                                    placeholder="198001012008011001"
                                    class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                            </div>
                            <div class="space-y-1.5">
                                <label for="jabatan_penandatangan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Jabatan <span class="text-rose-500">*</span></label>
                                <input type="text" id="jabatan_penandatangan" name="jabatan_penandatangan" required
                                    value="{{ old('jabatan_penandatangan') }}"
                                    placeholder="Analis Kebijakan Muda"
                                    class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-2">Tanda tangan elektronik disimpan sebagai nama + NIP + timestamp pada sistem SADA SOSIAL.</p>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                        <button type="submit" name="status" value="draft"
                            class="rounded-xl bg-slate-100 px-5 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-200 border border-slate-300 transition">
                            Simpan Draft
                        </button>
                        <button type="submit" name="status" value="final"
                            class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-2.5 text-xs font-bold text-white shadow hover:opacity-90 transition">
                            Finalisasi BA &rarr;
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Daftar BA yang Sudah Ada -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                <h3 class="text-sm font-bold text-slate-800 mb-4">Riwayat Berita Acara</h3>

                @if($beritaAcara->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-xs text-slate-400">Belum ada Berita Acara untuk permohonan ini.</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($beritaAcara as $ba)
                        <div class="p-3 rounded-xl border border-slate-200 {{ $ba->status === 'final' ? 'bg-emerald-50' : 'bg-slate-50' }}">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[10px] font-bold uppercase tracking-wide {{ $ba->status === 'final' ? 'text-emerald-700' : 'text-slate-500' }}">
                                    {{ $ba->status === 'final' ? '<x-heroicon-o-check-circle class="w-5 h-5 inline-block mr-1" /> Final' : '<x-heroicon-o-clipboard-document-list class="w-5 h-5 inline-block mr-1" /> Draft' }}
                                </span>
                                <span class="text-[10px] text-slate-400">{{ $ba->tanggal_pemeriksaan->format('d/m/Y') }}</span>
                            </div>
                            <p class="text-xs font-semibold text-slate-800">{{ $ba->jenis_pemeriksaan_label }}</p>
                            <p class="text-[10px] text-slate-500 mt-0.5">Rekomendasi: <span class="font-semibold {{ $ba->rekomendasi === 'terbitkan' ? 'text-emerald-700' : ($ba->rekomendasi === 'tolak' ? 'text-rose-600' : 'text-amber-600') }}">
                                {{ ucfirst($ba->rekomendasi) }}
                            </span></p>
                            <p class="text-[10px] text-slate-400 mt-1">Oleh: {{ $ba->petugas->name }}</p>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Sembunyikan checklist jika bukan lapangan
    const jenisPemeriksaan = document.getElementById('jenis_pemeriksaan');
    const checklistSection = document.getElementById('checklist-section');

    function toggleChecklist() {
        checklistSection.style.display = jenisPemeriksaan.value === 'lapangan' ? 'block' : 'none';
    }

    jenisPemeriksaan.addEventListener('change', toggleChecklist);
    toggleChecklist();
</script>
@endsection
@endsection
