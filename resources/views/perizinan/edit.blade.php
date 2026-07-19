@extends('layouts.app')

@section('title', 'Perbaiki Dokumen Permohonan')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('perizinan.show', $perizinan->id) }}" class="text-xs font-bold text-emerald-400 hover:underline flex items-center gap-1.5 mb-4">
            &larr; Kembali ke Detail Pengajuan
        </a>
        <h1 class="text-3xl font-extrabold text-white tracking-tight">Perbaikan Data Pengajuan</h1>
        <p class="text-sm text-slate-400 mt-1">
            Ubah data dan dokumen yang tidak sesuai berdasarkan catatan petugas di bawah ini.
        </p>
    </div>

    <!-- Officer Remark Alert -->
    @if($perizinan->catatan_perbaikan)
        <div class="mb-8 p-5 rounded-2xl border border-amber-500/20 bg-amber-500/5">
            <h4 class="text-sm font-bold text-amber-400 flex items-center gap-1.5">
                <span>⚠️</span> Catatan Perbaikan Petugas:
            </h4>
            <p class="text-xs text-slate-200 mt-2 italic bg-slate-950 p-4 rounded-xl border border-slate-900 leading-relaxed">
                "{{ $perizinan->catatan_perbaikan }}"
            </p>
        </div>
    @endif

    <!-- Form Container -->
    <div class="glass-panel rounded-3xl p-8 glow-amber border-amber-500/10">
        <form action="{{ route('perizinan.update', $perizinan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <input type="hidden" name="jenis_layanan" value="{{ $jenis }}">

            @php
                $data = $perizinan->data_tambahan ?? [];
            @endphp

            @if($jenis === 'ugb')
                <!-- ================== UGB FIELDS ================== -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_penyelenggara" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Penyelenggara / Perusahaan</label>
                            <input type="text" id="nama_penyelenggara" name="nama_penyelenggara" required value="{{ old('nama_penyelenggara', $data['nama_penyelenggara'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="nama_undian" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Acara / Program Undian</label>
                            <input type="text" id="nama_undian" name="nama_undian" required value="{{ old('nama_undian', $data['nama_undian'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="total_hadiah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Total Nilai Hadiah (Rupiah)</label>
                            <input type="number" id="total_hadiah" name="total_hadiah" required value="{{ old('total_hadiah', $data['total_hadiah'] ?? '') }}" min="0"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="waktu_pelaksanaan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Waktu Pelaksanaan / Penarikan Undian</label>
                            <input type="text" id="waktu_pelaksanaan" name="waktu_pelaksanaan" required value="{{ old('waktu_pelaksanaan', $data['waktu_pelaksanaan'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="deskripsi_kegiatan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Mekanisme & Deskripsi Undian</label>
                        <textarea id="deskripsi_kegiatan" name="deskripsi_kegiatan" required rows="4"
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">{{ old('deskripsi_kegiatan', $data['deskripsi_kegiatan'] ?? '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 border-t border-slate-900 pt-6">
                        <div class="space-y-1.5">
                            <label for="dokumen_proposal" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Proposal Kegiatan (PDF - *opsional bila tidak diubah)</label>
                            <input type="file" id="dokumen_proposal" name="dokumen_proposal"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                            @if(isset($data['dokumen_proposal']))
                                <span class="text-[10px] text-emerald-400 block mt-1">✓ Berkas proposal sudah terunggah sebelumnya</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_hadiah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Daftar Rincian Hadiah (PDF/Docx - *opsional)</label>
                            <input type="file" id="dokumen_hadiah" name="dokumen_hadiah"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                            @if(isset($data['dokumen_hadiah']))
                                <span class="text-[10px] text-emerald-400 block mt-1">✓ Berkas rincian hadiah sudah terunggah sebelumnya</span>
                            @endif
                        </div>
                    </div>
                </div>

            @elseif($jenis === 'pub')
                <!-- ================== PUB FIELDS ================== -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_penyelenggara" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lembaga Pemohon</label>
                            <input type="text" id="nama_penyelenggara" name="nama_penyelenggara" required value="{{ old('nama_penyelenggara', $data['nama_penyelenggara'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="tujuan_pengumpulan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Tujuan Pengumpulan Sumbangan</label>
                            <input type="text" id="tujuan_pengumpulan" name="tujuan_pengumpulan" required value="{{ old('tujuan_pengumpulan', $data['tujuan_pengumpulan'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="metode_pengumpulan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Metode Pengumpulan</label>
                            <input type="text" id="metode_pengumpulan" name="metode_pengumpulan" required value="{{ old('metode_pengumpulan', $data['metode_pengumpulan'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="target_dana" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Target Nominal Pengumpulan (Rupiah)</label>
                            <input type="number" id="target_dana" name="target_dana" required value="{{ old('target_dana', $data['target_dana'] ?? '') }}" min="0"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="wilayah_pengumpulan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Sasaran Wilayah Pengumpulan</label>
                            <input type="text" id="wilayah_pengumpulan" name="wilayah_pengumpulan" required value="{{ old('wilayah_pengumpulan', $data['wilayah_pengumpulan'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="waktu_pelaksanaan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Jangka Waktu Pengumpulan</label>
                            <input type="text" id="waktu_pelaksanaan" name="waktu_pelaksanaan" required value="{{ old('waktu_pelaksanaan', $data['waktu_pelaksanaan'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 border-t border-slate-900 pt-6">
                        <div class="space-y-1.5">
                            <label for="dokumen_proposal" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Proposal Program PUB (PDF - *opsional)</label>
                            <input type="file" id="dokumen_proposal" name="dokumen_proposal"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                            @if(isset($data['dokumen_proposal']))
                                <span class="text-[10px] text-emerald-400 block mt-1">✓ Berkas proposal sudah terunggah sebelumnya</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_rekening" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Buku Tabungan / Rekening (PDF/Gambar - *opsional)</label>
                            <input type="file" id="dokumen_rekening" name="dokumen_rekening"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                            @if(isset($data['dokumen_rekening']))
                                <span class="text-[10px] text-emerald-400 block mt-1">✓ Berkas rekening sudah terunggah sebelumnya</span>
                            @endif
                        </div>
                    </div>
                </div>

            @elseif($jenis === 'lks')
                <!-- ================== LKS FIELDS ================== -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_lks" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lembaga Kesejahteraan Sosial (LKS)</label>
                            <input type="text" id="nama_lks" name="nama_lks" required value="{{ old('nama_lks', $data['nama_lks'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="jenis_pelayanan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Jenis Pelayanan / Fokus Rehabilitasi</label>
                            <input type="text" id="jenis_pelayanan" name="jenis_pelayanan" required value="{{ old('jenis_pelayanan', $data['jenis_pelayanan'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_pimpinan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Pimpinan / Ketua LKS</label>
                            <input type="text" id="nama_pimpinan" name="nama_pimpinan" required value="{{ old('nama_pimpinan', $data['nama_pimpinan'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="jumlah_binaan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Jumlah Warga Binaan</label>
                            <input type="number" id="jumlah_binaan" name="jumlah_binaan" required value="{{ old('jumlah_binaan', $data['jumlah_binaan'] ?? '') }}" min="0"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="alamat_lks" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Lengkap Kantor / Panti LKS</label>
                        <textarea id="alamat_lks" name="alamat_lks" required rows="3"
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">{{ old('alamat_lks', $data['alamat_lks'] ?? '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 border-t border-slate-900 pt-6">
                        <div class="space-y-1.5">
                            <label for="dokumen_akta" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Akta Notaris & AD/ART LKS (PDF - *opsional)</label>
                            <input type="file" id="dokumen_akta" name="dokumen_akta"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                            @if(isset($data['dokumen_akta']))
                                <span class="text-[10px] text-emerald-400 block mt-1">✓ Berkas akta LKS sudah terunggah sebelumnya</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_domisili" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Surat Domisili Kelurahan LKS (PDF/Gambar - *opsional)</label>
                            <input type="file" id="dokumen_domisili" name="dokumen_domisili"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                            @if(isset($data['dokumen_domisili']))
                                <span class="text-[10px] text-emerald-400 block mt-1">✓ Berkas domisili LKS sudah terunggah sebelumnya</span>
                            @endif
                        </div>
                    </div>
                </div>

            @elseif($jenis === 'adopsi')
                <!-- ================== ADOPSI FIELDS ================== -->
                <div class="space-y-6">
                    <div class="border-b border-slate-900 pb-3">
                        <h3 class="text-sm font-bold text-amber-500 uppercase tracking-wider">Data Calon Orang Tua Angkat (COTA)</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_ayah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lengkap Calon Ayah</label>
                            <input type="text" id="nama_ayah" name="nama_ayah" required value="{{ old('nama_ayah', $data['nama_ayah'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="nik_ayah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">NIK Calon Ayah</label>
                            <input type="text" id="nik_ayah" name="nik_ayah" required value="{{ old('nik_ayah', $data['nik_ayah'] ?? '') }}" maxlength="16" minlength="16"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_ibu" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lengkap Calon Ibu</label>
                            <input type="text" id="nama_ibu" name="nama_ibu" required value="{{ old('nama_ibu', $data['nama_ibu'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="nik_ibu" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">NIK Calon Ibu</label>
                            <input type="text" id="nik_ibu" name="nik_ibu" required value="{{ old('nik_ibu', $data['nik_ibu'] ?? '') }}" maxlength="16" minlength="16"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="lama_menikah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Lama Pernikahan</label>
                            <input type="text" id="lama_menikah" name="lama_menikah" required value="{{ old('lama_menikah', $data['lama_menikah'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="space-y-1.5">
                            <label for="penghasilan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Total Penghasilan Bulanan</label>
                            <input type="number" id="penghasilan" name="penghasilan" required value="{{ old('penghasilan', $data['penghasilan'] ?? '') }}" min="0"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="alamat_cota" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Tinggal COTA</label>
                        <textarea id="alamat_cota" name="alamat_cota" required rows="2"
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">{{ old('alamat_cota', $data['alamat_cota'] ?? '') }}</textarea>
                    </div>

                    <div class="border-b border-slate-900 pb-3 pt-4">
                        <h3 class="text-sm font-bold text-amber-500 uppercase tracking-wider">Data Anak & Alasan Adopsi</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_anak" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Anak yang Diangkat</label>
                            <input type="text" id="nama_anak" name="nama_anak" required value="{{ old('nama_anak', $data['nama_anak'] ?? '') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="alasan_adopsi" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alasan Mengajukan Pengangkatan Anak</label>
                        <textarea id="alasan_adopsi" name="alasan_adopsi" required rows="3"
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">{{ old('alasan_adopsi', $data['alasan_adopsi'] ?? '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 border-t border-slate-900 pt-6">
                        <div class="space-y-1.5">
                            <label for="dokumen_nikah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Akta Pernikahan Orang Tua (PDF/Gambar - *opsional)</label>
                            <input type="file" id="dokumen_nikah" name="dokumen_nikah"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                            @if(isset($data['dokumen_nikah']))
                                <span class="text-[10px] text-emerald-400 block mt-1">✓ Berkas akta nikah sudah terunggah sebelumnya</span>
                            @endif
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_sehat" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Surat Sehat Jasmani & Rohani (PDF - *opsional)</label>
                            <input type="file" id="dokumen_sehat" name="dokumen_sehat"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                            @if(isset($data['dokumen_sehat']))
                                <span class="text-[10px] text-emerald-400 block mt-1">✓ Berkas surat sehat sudah terunggah sebelumnya</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Action buttons -->
            <div class="flex justify-end gap-3 pt-6 border-t border-slate-900 mt-8">
                <a href="{{ route('perizinan.show', $perizinan->id) }}" class="rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-slate-300 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                    Batal
                </a>
                <button type="submit" name="action" value="draft" class="rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-slate-200 hover:bg-slate-800 border border-slate-800 transition">
                    Simpan Draft
                </button>
                <button type="submit" name="action" value="submit" class="rounded-xl bg-gradient-to-r from-amber-500 to-orange-400 px-6 py-2.5 text-xs font-bold text-slate-950 shadow-md hover:opacity-90 transition">
                    Kirim Perbaikan &rarr;
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
