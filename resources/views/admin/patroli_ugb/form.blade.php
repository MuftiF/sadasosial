@extends('layouts.app')

@section('title', isset($patroli) ? 'Update Patroli UGB' : 'Rencana Patroli UGB Baru')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.patroli_ugb.index') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-4">
            &larr; Kembali ke Daftar Patroli
        </a>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
            {{ isset($patroli) ? 'Update Patroli UGB #' . $patroli->id : 'Rencana Patroli UGB Baru' }}
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            {{ isset($patroli) ? 'Update ke fase: ' . ($patroli->status === 'rencana' ? 'Pelaksanaan' : 'Laporan Selesai') : 'Buat rencana patroli dan isi data tim.' }}
        </p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-7">

        @if(!isset($patroli))
        {{-- ======= FORM RENCANA BARU ======= --}}
        <form action="{{ route('admin.patroli_ugb.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Rencana Patroli -->
            <div class="border-b border-slate-200 pb-2">
                <h3 class="text-sm font-bold text-emerald-700 uppercase tracking-wider"><x-heroicon-o-clipboard-document-list class="w-5 h-5 inline-block mr-1" /> Rencana Patroli</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label for="tanggal_rencana" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Tanggal Rencana Patroli <span class="text-rose-500">*</span></label>
                    <input type="date" id="tanggal_rencana" name="tanggal_rencana" required
                        value="{{ old('tanggal_rencana') }}"
                        class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                </div>
                <div class="space-y-1.5">
                    <label for="lokasi" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Lokasi Patroli <span class="text-rose-500">*</span></label>
                    <input type="text" id="lokasi" name="lokasi" required
                        value="{{ old('lokasi') }}"
                        placeholder="Jl. Sudirman No. 45, Medan Kota"
                        class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                </div>
            </div>

            <!-- Pembagian Tugas -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Tim Patroli / Pembagian Tugas</label>
                    <button type="button" onclick="tambahAnggota()" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">+ Tambah Anggota</button>
                </div>
                <div id="anggota-container" class="space-y-3">
                    <div class="grid grid-cols-3 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <input type="text" name="pembagian_tugas[0][nama]" placeholder="Nama Anggota"
                            class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none">
                        <input type="text" name="pembagian_tugas[0][jabatan]" placeholder="Jabatan/Pangkat"
                            class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none">
                        <input type="text" name="pembagian_tugas[0][tugas]" placeholder="Peran/Tugas"
                            class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Temuan Pelanggaran (Opsional) -->
            <div class="border-t border-slate-200 pt-5">
                <h3 class="text-sm font-bold text-amber-700 uppercase tracking-wider mb-4"><x-heroicon-o-exclamation-triangle class="w-5 h-5 inline-block mr-1" /> Temuan Pelanggaran (Opsional)</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label for="nama_penyelenggara_temuan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Nama Penyelenggara</label>
                        <input type="text" id="nama_penyelenggara_temuan" name="nama_penyelenggara_temuan"
                            value="{{ old('nama_penyelenggara_temuan') }}"
                            placeholder="PT. Maju Bersama"
                            class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label for="jenis_pelanggaran" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Jenis Pelanggaran</label>
                        <select id="jenis_pelanggaran" name="jenis_pelanggaran"
                            class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                            <option value="">-- Tidak Ada / Pilih --</option>
                            @foreach($jenisOptions as $key => $label)
                                <option value="{{ $key }}" {{ old('jenis_pelanggaran') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label for="tanggal_temuan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Tanggal Temuan</label>
                        <input type="date" id="tanggal_temuan" name="tanggal_temuan"
                            value="{{ old('tanggal_temuan') }}"
                            class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label for="bukti_foto_temuan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Bukti Foto Temuan</label>
                        <input type="file" id="bukti_foto_temuan" name="bukti_foto_temuan" accept=".jpg,.jpeg,.png,.pdf"
                            class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                <a href="{{ route('admin.patroli_ugb.index') }}"
                    class="rounded-xl bg-slate-100 px-5 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-200 border border-slate-200 transition">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-2.5 text-xs font-bold text-white shadow hover:opacity-90 transition">
                    Buat Rencana Patroli &rarr;
                </button>
            </div>
        </form>

        @else
        {{-- ======= FORM UPDATE PATROLI ======= --}}
        <form action="{{ route('admin.patroli_ugb.update', $patroli->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            @php $nextFase = $patroli->status === 'rencana' ? 'pelaksanaan' : 'selesai'; @endphp
            <input type="hidden" name="fase" value="{{ $nextFase }}">

            <!-- Info permohonan -->
            <div class="p-4 rounded-xl bg-blue-50 border border-blue-200">
                <p class="text-xs text-blue-700 font-semibold">Rencana: {{ $patroli->tanggal_rencana->format('d M Y') }} &mdash; {{ $patroli->lokasi }}</p>
                <p class="text-[11px] text-blue-500 mt-0.5">Update ke fase: <strong>{{ strtoupper($nextFase) }}</strong></p>
            </div>

            @if($nextFase === 'pelaksanaan')
            <!-- Pelaksanaan Patroli -->
            <div class="border-b border-slate-200 pb-2">
                <h3 class="text-sm font-bold text-amber-700 uppercase tracking-wider"><x-heroicon-o-truck class="w-5 h-5 inline-block mr-1" /> Pelaksanaan Patroli</h3>
            </div>

            <div class="space-y-1.5">
                <label for="tanggal_pelaksanaan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Tanggal Pelaksanaan Aktual</label>
                <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan"
                    value="{{ old('tanggal_pelaksanaan', date('Y-m-d')) }}"
                    class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-3">Checklist Kondisi Lapangan</label>
                @php
                $checklistKondisi = [
                    'lokasi_aman'       => 'Lokasi patroli aman dan kondusif',
                    'ada_aktivitas_ugb' => 'Terdapat aktivitas UGB yang dipantau',
                    'izin_ditunjukkan'  => 'Pihak penyelenggara dapat menunjukkan izin',
                    'tidak_menyimpang'  => 'Pelaksanaan tidak menyimpang dari izin',
                    'masyarakat_aman'   => 'Tidak ada keresahan dari masyarakat sekitar',
                ];
                @endphp
                <div class="space-y-2 p-4 bg-slate-50 rounded-xl border border-slate-200">
                    @foreach($checklistKondisi as $key => $label)
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="checklist_kondisi[{{ $key }}]" value="1"
                            class="h-4 w-4 rounded border-slate-300 text-emerald-600">
                        <span class="text-sm text-slate-700">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="catatan_pembinaan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Catatan Pembinaan</label>
                <textarea id="catatan_pembinaan" name="catatan_pembinaan" rows="4"
                    class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none"
                    placeholder="Tuliskan pembinaan yang diberikan kepada penyelenggara...">{{ old('catatan_pembinaan') }}</textarea>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Upload Foto Dokumentasi</label>
                <input type="file" name="foto_dokumentasi[]" multiple accept=".jpg,.jpeg,.png"
                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                <p class="text-[10px] text-slate-400">Bisa upload beberapa foto sekaligus (jpg, jpeg, png)</p>
            </div>

            @elseif($nextFase === 'selesai')
            <!-- Laporan Hasil Patroli -->
            <div class="border-b border-slate-200 pb-2">
                <h3 class="text-sm font-bold text-emerald-700 uppercase tracking-wider"><x-heroicon-o-chart-bar class="w-5 h-5 inline-block mr-1" /> Laporan Hasil Patroli</h3>
            </div>

            <div class="space-y-1.5">
                <label for="ringkasan_temuan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Ringkasan Temuan</label>
                <textarea id="ringkasan_temuan" name="ringkasan_temuan" rows="4"
                    class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none"
                    placeholder="Tuliskan ringkasan temuan selama pelaksanaan patroli...">{{ old('ringkasan_temuan') }}</textarea>
            </div>

            <div class="space-y-1.5">
                <label for="tindakan_diambil" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Tindakan yang Diambil</label>
                <textarea id="tindakan_diambil" name="tindakan_diambil" rows="3"
                    class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none"
                    placeholder="Peringatan tertulis, penyegelan sementara, koordinasi instansi lain, dll...">{{ old('tindakan_diambil') }}</textarea>
            </div>

            <div class="space-y-1.5">
                <label for="rekomendasi" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Rekomendasi Tindak Lanjut</label>
                <textarea id="rekomendasi" name="rekomendasi" rows="3"
                    class="block w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-emerald-500 focus:outline-none"
                    placeholder="Rekomendasi untuk dinas terkait, penegakan hukum, atau pemantauan lanjutan...">{{ old('rekomendasi') }}</textarea>
            </div>
            @endif

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                <a href="{{ route('admin.patroli_ugb.index') }}"
                    class="rounded-xl bg-slate-100 px-5 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-200 border border-slate-200 transition">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-2.5 text-xs font-bold text-white shadow hover:opacity-90 transition">
                    Simpan ke {{ strtoupper($nextFase) }} &rarr;
                </button>
            </div>
        </form>
        @endif
    </div>
</div>

@section('scripts')
<script>
let anggotaCount = 1;
function tambahAnggota() {
    const container = document.getElementById('anggota-container');
    const div = document.createElement('div');
    div.className = 'grid grid-cols-3 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200';
    div.innerHTML = `
        <input type="text" name="pembagian_tugas[${anggotaCount}][nama]" placeholder="Nama Anggota"
            class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none">
        <input type="text" name="pembagian_tugas[${anggotaCount}][jabatan]" placeholder="Jabatan/Pangkat"
            class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none">
        <input type="text" name="pembagian_tugas[${anggotaCount}][tugas]" placeholder="Peran/Tugas"
            class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-xs text-slate-900 focus:border-emerald-500 focus:outline-none">
    `;
    container.appendChild(div);
    anggotaCount++;
}
</script>
@endsection
@endsection
