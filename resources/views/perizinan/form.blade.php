@extends('layouts.app')

@section('title', 'Formulir Pengajuan Perizinan')

@section('content')
<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('perizinan.create') }}" class="text-xs font-bold text-emerald-400 hover:underline flex items-center gap-1.5 mb-4">
            &larr; Pilih Layanan Lain
        </a>
        <h1 class="text-3xl font-extrabold text-white tracking-tight">
            Formulir Pengajuan 
            @if($jenis === 'ugb') UGB
            @elseif($jenis === 'pub') PUB
            @elseif($jenis === 'lks') LKS
            @elseif($jenis === 'adopsi') Adopsi Anak
            @endif
        </h1>
        <p class="text-sm text-slate-400 mt-1">
            Lengkapi data di bawah untuk mengajukan perizinan/rekomendasi sosial.
        </p>
    </div>

    <!-- Form Container -->
    <div class="glass-panel rounded-3xl p-8 glow-emerald">
        <form action="{{ route('perizinan.store', $jenis) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <input type="hidden" name="jenis_layanan" value="{{ $jenis }}">

            @if($jenis === 'ugb')
                <!-- ================== UGB FIELDS ================== -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_penyelenggara" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Penyelenggara / Perusahaan</label>
                            <input type="text" id="nama_penyelenggara" name="nama_penyelenggara" required value="{{ old('nama_penyelenggara') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="PT. Promosi Indonesia">
                        </div>
                        <div class="space-y-1.5">
                            <label for="nama_undian" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Acara / Program Undian</label>
                            <input type="text" id="nama_undian" name="nama_undian" required value="{{ old('nama_undian') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Undian Berkah Belanja 2026">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="total_hadiah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Total Nilai Hadiah (Rupiah)</label>
                            <input type="number" id="total_hadiah" name="total_hadiah" required value="{{ old('total_hadiah') }}" min="0"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="50000000">
                        </div>
                        <div class="space-y-1.5">
                            <label for="waktu_pelaksanaan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Waktu Pelaksanaan / Penarikan Undian</label>
                            <input type="text" id="waktu_pelaksanaan" name="waktu_pelaksanaan" required value="{{ old('waktu_pelaksanaan') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="15 Agustus 2026 di Medan">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="deskripsi_kegiatan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Mekanisme & Deskripsi Undian</label>
                        <textarea id="deskripsi_kegiatan" name="deskripsi_kegiatan" required rows="4"
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                            placeholder="Jelaskan mekanisme peserta mendapatkan kupon dan tata cara penarikan undian..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 border-t border-slate-900 pt-6">
                        <div class="space-y-1.5">
                            <label for="dokumen_proposal" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Proposal Kegiatan (PDF)</label>
                            <input type="file" id="dokumen_proposal" name="dokumen_proposal"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_hadiah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Daftar Rincian Hadiah (PDF/Docx)</label>
                            <input type="file" id="dokumen_hadiah" name="dokumen_hadiah"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                    </div>
                </div>

            @elseif($jenis === 'pub')
                <!-- ================== PUB FIELDS ================== -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_penyelenggara" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lembaga Pemohon</label>
                            <input type="text" id="nama_penyelenggara" name="nama_penyelenggara" required value="{{ old('nama_penyelenggara') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Yayasan Peduli Sesama">
                        </div>
                        <div class="space-y-1.5">
                            <label for="tujuan_pengumpulan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Tujuan Pengumpulan Sumbangan</label>
                            <input type="text" id="tujuan_pengumpulan" name="tujuan_pengumpulan" required value="{{ old('tujuan_pengumpulan') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Bantuan Korban Gempa & Beasiswa Anak Yatim">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="metode_pengumpulan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Metode Pengumpulan</label>
                            <input type="text" id="metode_pengumpulan" name="metode_pengumpulan" required value="{{ old('metode_pengumpulan') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Kotak Amal, Rekening Bank, Crowdfunding Online">
                        </div>
                        <div class="space-y-1.5">
                            <label for="target_dana" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Target Nominal Pengumpulan (Rupiah)</label>
                            <input type="number" id="target_dana" name="target_dana" required value="{{ old('target_dana') }}" min="0"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="100000000">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="wilayah_pengumpulan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Sasaran Wilayah Pengumpulan</label>
                            <input type="text" id="wilayah_pengumpulan" name="wilayah_pengumpulan" required value="{{ old('wilayah_pengumpulan') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Provinsi Sumatera Utara">
                        </div>
                        <div class="space-y-1.5">
                            <label for="waktu_pelaksanaan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Jangka Waktu Pengumpulan</label>
                            <input type="text" id="waktu_pelaksanaan" name="waktu_pelaksanaan" required value="{{ old('waktu_pelaksanaan') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="3 Bulan (1 Agustus - 31 Oktober 2026)">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 border-t border-slate-900 pt-6">
                        <div class="space-y-1.5">
                            <label for="dokumen_proposal" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Proposal Program PUB (PDF)</label>
                            <input type="file" id="dokumen_proposal" name="dokumen_proposal"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_rekening" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Buku Tabungan / Rekening Lembaga (PDF/Gambar)</label>
                            <input type="file" id="dokumen_rekening" name="dokumen_rekening"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                    </div>
                </div>

            @elseif($jenis === 'lks')
                <!-- ================== LKS FIELDS ================== -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_lks" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lembaga Kesejahteraan Sosial (LKS)</label>
                            <input type="text" id="nama_lks" name="nama_lks" required value="{{ old('nama_lks') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="LKS Kasih Ibu">
                        </div>
                        <div class="space-y-1.5">
                            <label for="jenis_pelayanan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Jenis Pelayanan / Fokus Rehabilitasi</label>
                            <input type="text" id="jenis_pelayanan" name="jenis_pelayanan" required value="{{ old('jenis_pelayanan') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Asuhan Anak Yatim / Rehabilitasi Disabilitas / Lanjut Usia">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_pimpinan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Pimpinan / Ketua LKS</label>
                            <input type="text" id="nama_pimpinan" name="nama_pimpinan" required value="{{ old('nama_pimpinan') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Dr. H. Sulaiman">
                        </div>
                        <div class="space-y-1.5">
                            <label for="jumlah_binaan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Jumlah Warga Binaan / Penerima Manfaat</label>
                            <input type="number" id="jumlah_binaan" name="jumlah_binaan" required value="{{ old('jumlah_binaan') }}" min="0"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="45">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="alamat_lks" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Lengkap Kantor / Panti LKS</label>
                        <textarea id="alamat_lks" name="alamat_lks" required rows="3"
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                            placeholder="Jl. Sisingamangaraja No. 120, Kota Medan"></textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 border-t border-slate-900 pt-6">
                        <div class="space-y-1.5">
                            <label for="dokumen_akta" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Akta Notaris & AD/ART LKS (PDF)</label>
                            <input type="file" id="dokumen_akta" name="dokumen_akta"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_domisili" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Surat Domisili Kelurahan LKS (PDF/Gambar)</label>
                            <input type="file" id="dokumen_domisili" name="dokumen_domisili"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                    </div>
                </div>

            @elseif($jenis === 'adopsi')
                <!-- ================== ADOPSI FIELDS ================== -->
                <div class="space-y-6">
                    <div class="border-b border-slate-900 pb-3">
                        <h3 class="text-sm font-bold text-emerald-400 uppercase tracking-wider">Data Calon Orang Tua Angkat (COTA)</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_ayah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lengkap Calon Ayah</label>
                            <input type="text" id="nama_ayah" name="nama_ayah" required value="{{ old('nama_ayah') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Susilo Bambang">
                        </div>
                        <div class="space-y-1.5">
                            <label for="nik_ayah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">NIK Calon Ayah</label>
                            <input type="text" id="nik_ayah" name="nik_ayah" required value="{{ old('nik_ayah') }}" maxlength="16" minlength="16"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="127102xxxxxxxxxx">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_ibu" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Lengkap Calon Ibu</label>
                            <input type="text" id="nama_ibu" name="nama_ibu" required value="{{ old('nama_ibu') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Dewi Sartika">
                        </div>
                        <div class="space-y-1.5">
                            <label for="nik_ibu" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">NIK Calon Ibu</label>
                            <input type="text" id="nik_ibu" name="nik_ibu" required value="{{ old('nik_ibu') }}" maxlength="16" minlength="16"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="127102xxxxxxxxxx">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="lama_menikah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Lama Pernikahan</label>
                            <input type="text" id="lama_menikah" name="lama_menikah" required value="{{ old('lama_menikah') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="6 Tahun (Sejak 2020)">
                        </div>
                        <div class="space-y-1.5">
                            <label for="penghasilan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Total Penghasilan Bulanan (Rupiah)</label>
                            <input type="number" id="penghasilan" name="penghasilan" required value="{{ old('penghasilan') }}" min="0"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="15000000">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="alamat_cota" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alamat Tinggal COTA</label>
                        <textarea id="alamat_cota" name="alamat_cota" required rows="2"
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                            placeholder="Jl. Merdeka No. 45, Kota Binjai"></textarea>
                    </div>

                    <div class="border-b border-slate-900 pb-3 pt-4">
                        <h3 class="text-sm font-bold text-emerald-400 uppercase tracking-wider">Data Anak & Alasan Adopsi</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_anak" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nama Anak yang Diangkat (Bila sudah ada)</label>
                            <input type="text" id="nama_anak" name="nama_anak" required value="{{ old('nama_anak') }}"
                                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                                placeholder="Ananda Fathan / Belum Ditentukan">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="alasan_adopsi" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Alasan Mengajukan Pengangkatan Anak</label>
                        <textarea id="alasan_adopsi" name="alasan_adopsi" required rows="3"
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-500"
                            placeholder="Tuliskan latar belakang dan komitmen pengangkatan anak..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 border-t border-slate-900 pt-6">
                        <div class="space-y-1.5">
                            <label for="dokumen_nikah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Akta Pernikahan Orang Tua (PDF/Gambar)</label>
                            <input type="file" id="dokumen_nikah" name="dokumen_nikah"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_sehat" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Surat Sehat Jasmani & Rohani (PDF)</label>
                            <input type="file" id="dokumen_sehat" name="dokumen_sehat"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                    </div>
                </div>
            @endif

            <!-- Custom Switch: Trigger Wilayah check simulation -->
            <div class="flex items-center gap-3 bg-slate-950/60 p-4 rounded-2xl border border-slate-800 mt-6">
                <input type="checkbox" id="konfirmasi_wilayah" name="konfirmasi_wilayah" value="1" checked
                    class="h-4 w-4 rounded border-slate-800 text-emerald-500 bg-slate-950 focus:ring-emerald-500">
                <div>
                    <label for="konfirmasi_wilayah" class="text-xs font-bold text-white block">Libatkan Uji Kelayakan Wilayah (Dinsos Kab/Kota)</label>
                    <p class="text-[10px] text-slate-400 mt-0.5">Bila diaktifkan, setelah verifikasi berkas valid, permohonan harus disurvei/diverifikasi oleh petugas Dinsos Kab/Kota sebelum ke bidang teknis.</p>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex justify-end gap-3 pt-6 border-t border-slate-900 mt-8">
                <a href="{{ route('perizinan.create') }}" class="rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-slate-300 ring-1 ring-slate-800 hover:bg-slate-800 transition">
                    Batal
                </a>
                <button type="submit" name="action" value="draft" class="rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-slate-200 hover:bg-slate-800 border border-slate-800 transition">
                    Simpan Draft
                </button>
                <button type="submit" name="action" value="submit" class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-2.5 text-xs font-bold text-slate-950 shadow-md hover:opacity-90 transition">
                    Kirim Pengajuan &rarr;
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
