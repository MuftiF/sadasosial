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
                    <!-- Info Banner SOP -->
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-start justify-between gap-4">
                        <div class="flex gap-3">
                            <span class="text-lg"><x-heroicon-o-clipboard-document-list class="w-5 h-5 inline-block mr-1" /></span>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900">Panduan Prosedur Pelaksanaan UGB</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">Pastikan Anda memahami tahapan penyegelan alat & saksi yang diwajibkan setelah izin terbit.</p>
                            </div>
                        </div>
                        <a href="{{ route('perizinan.sop.ugb') }}" target="_blank" class="shrink-0 px-3 py-1.5 text-[10px] font-bold text-emerald-650 bg-white hover:bg-slate-50 rounded-xl border border-emerald-200/60 transition duration-200">
                            Lihat Alur SOP &rarr;
                        </a>
                    </div>

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
                            <label for="dokumen_proposal" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Proposal Kegiatan (PDF) <span class="text-rose-500">*</span></label>
                            <input type="file" id="dokumen_proposal" name="dokumen_proposal" required
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_hadiah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Daftar Rincian Hadiah (PDF/Docx) <span class="text-rose-500">*</span></label>
                            <input type="file" id="dokumen_hadiah" name="dokumen_hadiah" required
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                    </div>
                </div>

            @elseif($jenis === 'pub')
                <!-- ================== PUB FIELDS ================== -->
                <div class="space-y-6">
                    <!-- Info Banner SOP PUB -->
                    <div class="p-4 rounded-2xl bg-blue-50 border border-blue-200 flex items-start gap-3">
                        <span class="text-lg"><x-heroicon-o-clipboard-document-list class="w-5 h-5 inline-block mr-1" /></span>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">SOP Penerbitan Izin & Rekomendasi PUB (9 Langkah)</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Siapkan semua 8 dokumen persyaratan berikut dalam format PDF sebelum mengajukan. Kelengkapan dokumen akan diperiksa oleh Sekretariat.</p>
                        </div>
                    </div>

                    <!-- Data Pemohon -->
                    <div class="border-b border-slate-200 pb-2">
                        <h3 class="text-sm font-bold text-emerald-600 uppercase tracking-wider">Data Pemohon</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="nama_penyelenggara" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Nama Lembaga Pemohon <span class="text-rose-500">*</span></label>
                            <input type="text" id="nama_penyelenggara" name="nama_penyelenggara" required value="{{ old('nama_penyelenggara') }}"
                                class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-emerald-500"
                                placeholder="Yayasan Peduli Sesama">
                        </div>
                        <div class="space-y-1.5">
                            <label for="tujuan_pengumpulan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Tujuan Pengumpulan Sumbangan <span class="text-rose-500">*</span></label>
                            <input type="text" id="tujuan_pengumpulan" name="tujuan_pengumpulan" required value="{{ old('tujuan_pengumpulan') }}"
                                class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-emerald-500"
                                placeholder="Bantuan Korban Gempa & Beasiswa Anak Yatim">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="metode_pengumpulan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Metode Pengumpulan <span class="text-rose-500">*</span></label>
                            <input type="text" id="metode_pengumpulan" name="metode_pengumpulan" required value="{{ old('metode_pengumpulan') }}"
                                class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-emerald-500"
                                placeholder="Kotak Amal, Rekening Bank, Crowdfunding Online">
                        </div>
                        <div class="space-y-1.5">
                            <label for="target_dana" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Target Nominal Pengumpulan (Rupiah) <span class="text-rose-500">*</span></label>
                            <input type="number" id="target_dana" name="target_dana" required value="{{ old('target_dana') }}" min="0"
                                class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-emerald-500"
                                placeholder="100000000">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-1.5">
                            <label for="wilayah_pengumpulan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Sasaran Wilayah Pengumpulan <span class="text-rose-500">*</span></label>
                            <input type="text" id="wilayah_pengumpulan" name="wilayah_pengumpulan" required value="{{ old('wilayah_pengumpulan') }}"
                                class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-emerald-500"
                                placeholder="Provinsi Sumatera Utara">
                        </div>
                        <div class="space-y-1.5">
                            <label for="waktu_pelaksanaan" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Jangka Waktu Pengumpulan <span class="text-rose-500">*</span></label>
                            <input type="text" id="waktu_pelaksanaan" name="waktu_pelaksanaan" required value="{{ old('waktu_pelaksanaan') }}"
                                class="block w-full rounded-xl bg-white border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-emerald-500"
                                placeholder="3 Bulan (1 Agustus - 31 Oktober 2026)">
                        </div>
                    </div>

                    <!-- Dokumen Persyaratan PUB (8 dokumen sesuai SOP) -->
                    <div class="border-b border-slate-200 pb-2 pt-2">
                        <h3 class="text-sm font-bold text-emerald-600 uppercase tracking-wider">Dokumen Persyaratan PUB</h3>
                        <p class="text-[11px] text-slate-500 mt-1">Semua dokumen wajib dalam format PDF. Pastikan scan jelas dan terbaca.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <!-- Dokumen 1 -->
                        <div class="space-y-1.5 p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">1</span>
                                <label for="akta_notaris" class="block text-xs font-bold text-slate-700">Akta Notaris <span class="text-rose-500">*</span></label>
                            </div>
                            <input type="file" id="akta_notaris" name="akta_notaris" required accept=".pdf"
                                class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-[10px] text-slate-400">Akta pendirian yayasan/lembaga</p>
                        </div>

                        <!-- Dokumen 2 -->
                        <div class="space-y-1.5 p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">2</span>
                                <label for="sk_kemenkumham" class="block text-xs font-bold text-slate-700">SK Kemenkumham <span class="text-rose-500">*</span></label>
                            </div>
                            <input type="file" id="sk_kemenkumham" name="sk_kemenkumham" required accept=".pdf"
                                class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-[10px] text-slate-400">SK pengesahan dari Kemenkumham</p>
                        </div>

                        <!-- Dokumen 3 -->
                        <div class="space-y-1.5 p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">3</span>
                                <label for="surat_domisili" class="block text-xs font-bold text-slate-700">Scan Surat Domisili Yayasan <span class="text-rose-500">*</span></label>
                            </div>
                            <input type="file" id="surat_domisili" name="surat_domisili" required accept=".pdf"
                                class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-[10px] text-slate-400">Surat keterangan domisili dari kelurahan</p>
                        </div>

                        <!-- Dokumen 4 -->
                        <div class="space-y-1.5 p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">4</span>
                                <label for="stp_stpu" class="block text-xs font-bold text-slate-700">Scan STP/STPU <span class="text-rose-500">*</span></label>
                            </div>
                            <input type="file" id="stp_stpu" name="stp_stpu" required accept=".pdf"
                                class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-[10px] text-slate-400">Surat Tanda Pendaftaran / STPU yang masih berlaku</p>
                        </div>

                        <!-- Dokumen 5 -->
                        <div class="space-y-1.5 p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">5</span>
                                <label for="surat_ket_baik_pengurus" class="block text-xs font-bold text-slate-700">Surat Ket. Baik Pengurus dari Kepolisian <span class="text-rose-500">*</span></label>
                            </div>
                            <input type="file" id="surat_ket_baik_pengurus" name="surat_ket_baik_pengurus" required accept=".pdf"
                                class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-[10px] text-slate-400">Dari Polres setempat untuk seluruh pengurus</p>
                        </div>

                        <!-- Dokumen 6 -->
                        <div class="space-y-1.5 p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">6</span>
                                <label for="pernyataan_keabsahan" class="block text-xs font-bold text-slate-700">Surat Pernyataan Keabsahan Dokumen bermaterai <span class="text-rose-500">*</span></label>
                            </div>
                            <input type="file" id="pernyataan_keabsahan" name="pernyataan_keabsahan" required accept=".pdf"
                                class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-[10px] text-slate-400">Wajib ditandatangani di atas materai Rp10.000</p>
                        </div>

                        <!-- Dokumen 7 -->
                        <div class="space-y-1.5 p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">7</span>
                                <label for="pernyataan_anti_radikal" class="block text-xs font-bold text-slate-700">Surat Pernyataan Anti-Radikalisme bermaterai <span class="text-rose-500">*</span></label>
                            </div>
                            <input type="file" id="pernyataan_anti_radikal" name="pernyataan_anti_radikal" required accept=".pdf"
                                class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-[10px] text-slate-400">Pernyataan kegiatan tidak untuk radikalisme/terorisme</p>
                        </div>

                        <!-- Dokumen 8 -->
                        <div class="space-y-1.5 p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold">8</span>
                                <label for="rekomendasi_dinsos_kab" class="block text-xs font-bold text-slate-700">Rekomendasi Dinas Sosial Kab/Kota <span class="text-rose-500">*</span></label>
                            </div>
                            <input type="file" id="rekomendasi_dinsos_kab" name="rekomendasi_dinsos_kab" required accept=".pdf"
                                class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-[10px] text-slate-400">Surat rekomendasi dari Dinsos Kabupaten/Kota domisili</p>
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
                            <label for="dokumen_akta" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Akta Notaris & AD/ART LKS (PDF) <span class="text-rose-500">*</span></label>
                            <input type="file" id="dokumen_akta" name="dokumen_akta" required
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_domisili" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Surat Domisili Kelurahan LKS (PDF/Gambar) <span class="text-rose-500">*</span></label>
                            <input type="file" id="dokumen_domisili" name="dokumen_domisili" required
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
                            <label for="dokumen_nikah" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Akta Pernikahan Orang Tua (PDF/Gambar) <span class="text-rose-500">*</span></label>
                            <input type="file" id="dokumen_nikah" name="dokumen_nikah" required
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-slate-200 hover:file:bg-slate-800 cursor-pointer">
                        </div>
                        <div class="space-y-1.5">
                            <label for="dokumen_sehat" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Surat Sehat Jasmani & Rohani (PDF) <span class="text-rose-500">*</span></label>
                            <input type="file" id="dokumen_sehat" name="dokumen_sehat" required
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
