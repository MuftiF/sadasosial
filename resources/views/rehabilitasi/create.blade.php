@extends('layouts.app')

@section('title', 'Daftarkan Kasus Baru - ' . ucfirst($kategori))

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumbs -->
    <a href="{{ route('rehabilitasi.subproses.index', $kategori) }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-6">
        &larr; Kembali ke Daftar Kasus
    </a>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Daftarkan Kasus Baru</h1>
        <p class="text-sm text-slate-500 mt-1">
            Program: 
            <strong>
                @if($kategori === 'anak') 3.1 Rehabilitasi Sosial Anak
                @elseif($kategori === 'lansia') 3.2 Rehabilitasi Lanjut Usia (Lansia)
                @elseif($kategori === 'disabilitas') 3.3 Penyandang Disabilitas (Alat Bantu)
                @elseif($kategori === 'tuna_sosial') 3.4 Penanganan Tuna Sosial &amp; Warga Rentan
                @elseif($kategori === 'kekerasan') 3.5 Penanganan Korban Kekerasan &amp; TPPO
                @elseif($kategori === 'napza') 3.6 Penanganan Korban NAPZA &amp; ODHA
                @endif
            </strong>
        </p>
    </div>

    <!-- Form -->
    <div class="glass-panel rounded-2xl p-8 shadow-sm">
        <form action="{{ route('rehabilitasi.store', $kategori) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama Klien -->
            <div>
                <label for="nama_klien" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap Klien / Penerima Manfaat</label>
                <input type="text" name="nama_klien" id="nama_klien" required value="{{ old('nama_klien') }}"
                    class="w-full rounded-xl px-4 py-3 text-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                @error('nama_klien') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- NIK -->
            <div>
                <label for="nik" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor Induk Kependudukan (NIK)</label>
                <input type="text" name="nik" id="nik" required maxlength="16" minlength="16" value="{{ old('nik') }}"
                    class="w-full rounded-xl px-4 py-3 text-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                    placeholder="16 digit NIK">
                @error('nik') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kabupaten / Kota -->
            <div>
                <label for="kab_kota" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kabupaten / Kota Domisili</label>
                <select name="kab_kota" id="kab_kota" required
                    class="w-full rounded-xl px-4 py-3 text-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                    <option value="">-- Pilih Kabupaten / Kota --</option>
                    <option value="Kota Medan" {{ old('kab_kota') === 'Kota Medan' ? 'selected' : '' }}>Kota Medan</option>
                    <option value="Kota Binjai" {{ old('kab_kota') === 'Kota Binjai' ? 'selected' : '' }}>Kota Binjai</option>
                    <option value="Kabupaten Deli Serdang" {{ old('kab_kota') === 'Kabupaten Deli Serdang' ? 'selected' : '' }}>Kabupaten Deli Serdang</option>
                    <option value="Kabupaten Langkat" {{ old('kab_kota') === 'Kabupaten Langkat' ? 'selected' : '' }}>Kabupaten Langkat</option>
                    <option value="Kota Pematangsiantar" {{ old('kab_kota') === 'Kota Pematangsiantar' ? 'selected' : '' }}>Kota Pematangsiantar</option>
                    <option value="Kabupaten Simalungun" {{ old('kab_kota') === 'Kabupaten Simalungun' ? 'selected' : '' }}>Kabupaten Simalungun</option>
                    <option value="Kabupaten Karo" {{ old('kab_kota') === 'Kabupaten Karo' ? 'selected' : '' }}>Kabupaten Karo</option>
                    <option value="Kabupaten Asahan" {{ old('kab_kota') === 'Kabupaten Asahan' ? 'selected' : '' }}>Kabupaten Asahan</option>
                    <option value="Kota Tebing Tinggi" {{ old('kab_kota') === 'Kota Tebing Tinggi' ? 'selected' : '' }}>Kota Tebing Tinggi</option>
                </select>
                @error('kab_kota') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Alamat Lengkap -->
            <div>
                <label for="alamat" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3" required
                    class="w-full rounded-xl px-4 py-3 text-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200">{{ old('alamat') }}</textarea>
                @error('alamat') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Deskripsi Kasus -->
            <div>
                <label for="deskripsi_kasus" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Kasus &amp; Kebutuhan Layanan</label>
                <p class="text-[11px] text-slate-400 mb-2">Jelaskan secara mendetail kondisi awal klien dan jenis layanan atau fasilitas bantuan yang diusulkan.</p>
                <textarea name="deskripsi_kasus" id="deskripsi_kasus" rows="5" required
                    class="w-full rounded-xl px-4 py-3 text-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                    placeholder="Contoh: Anak terlantar yatim piatu membutuhkan fasilitas gizi panti, atau lansia sebatang kara membutuhkan sembako rutin..."></textarea>
                @error('deskripsi_kasus') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Dokumen Pendukung -->
            <div>
                <label for="dokumen_pendukung" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Dokumen / Foto Bukti Pendukung (Opsional)</label>
                <input type="file" name="dokumen_pendukung" id="dokumen_pendukung"
                    class="w-full rounded-xl px-4 py-3 text-sm border-slate-300 focus:border-emerald-500">
                <p class="text-[10px] text-slate-400 mt-1">Mendukung file format: PDF, JPG, PNG, DOC (Maks. 5MB)</p>
                @error('dokumen_pendukung') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Action buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('rehabilitasi.subproses.index', $kategori) }}" 
                    class="rounded-xl px-4 py-2.5 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                    Batalkan
                </a>
                <button type="submit" 
                    class="rounded-xl bg-emerald-600 px-6 py-2.5 text-xs font-bold text-white hover:bg-emerald-500 shadow-md shadow-emerald-500/10 transition">
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
