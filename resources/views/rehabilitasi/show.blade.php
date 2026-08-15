@extends('layouts.app')

@section('title', 'Detail Kasus Rehabilitasi - ' . $item->nama_klien)

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumbs -->
    <a href="{{ route('rehabilitasi.subproses.index', $item->kategori) }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-6">
        &larr; Kembali ke Daftar Kasus
    </a>

    <!-- Header -->
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20 mb-3">
                {{ $item->kategori_label }}
            </span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $item->nama_klien }}</h1>
            <p class="text-sm text-slate-500 mt-1">ID Kasus: #{{ $item->id }} | Terdaftar sejak {{ $item->created_at->format('d F Y, H:i') }} WIB</p>
        </div>
        <div>
            <span class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-xs font-bold text-slate-200 ring-1 ring-slate-800">
                Status: {{ strtoupper(str_replace('_', ' ', $item->status_workflow)) }}
            </span>
        </div>
    </div>

    <!-- Step Visualizer / Tracker (7 Steps) -->
    <div class="glass-panel rounded-2xl p-6 mb-10 overflow-hidden shadow-sm">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-6">Alur Penyelesaian Rehabilitasi Sosial</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-7 gap-4 relative">
            @php
                $statusMap = [
                    'diajukan' => 1,
                    'verifikasi_awal' => 2,
                    'proses_asesmen' => 3,
                    'proses_rekomendasi' => 4,
                    'dirujuk' => 5,
                    'diterima_mitra' => 6,
                    'ditolak_mitra' => 6,
                    'selesai_non_rujukan' => 6,
                    'selesai' => 7
                ];
                $currentStep = $statusMap[$item->status_workflow] ?? 1;
            @endphp

            <!-- Step 1: Diajukan -->
            <div class="flex flex-col items-center text-center p-3 rounded-xl {{ $currentStep >= 1 ? 'bg-emerald-500/5 border border-emerald-500/20' : 'border border-slate-200/60' }}">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-extrabold {{ $currentStep >= 1 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-500' }}">1</span>
                <span class="text-[11px] font-bold text-slate-900 mt-2 block">Pengajuan</span>
                <span class="text-[9px] text-slate-400 mt-1 block">Kasus dilaporkan pemohon</span>
            </div>

            <!-- Step 2: Verifikasi Administrasi -->
            <div class="flex flex-col items-center text-center p-3 rounded-xl {{ $currentStep >= 2 ? 'bg-emerald-500/5 border border-emerald-500/20' : 'border border-slate-200/60' }}">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-extrabold {{ $currentStep >= 2 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-500' }}">2</span>
                <span class="text-[11px] font-bold text-slate-900 mt-2 block">Verifikasi Admin</span>
                <span class="text-[9px] text-slate-400 mt-1 block">Pengecekan berkas administrasi</span>
            </div>

            <!-- Step 3: Verifikasi Wilayah -->
            <div class="flex flex-col items-center text-center p-3 rounded-xl {{ $currentStep >= 3 ? 'bg-emerald-500/5 border border-emerald-500/20' : 'border border-slate-200/60' }}">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-extrabold {{ $currentStep >= 3 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-500' }}">3</span>
                <span class="text-[11px] font-bold text-slate-900 mt-2 block">Verifikasi Wilayah</span>
                <span class="text-[9px] text-slate-400 mt-1 block">Tinjauan kondisi sosial</span>
            </div>

            <!-- Step 4: Asesmen Kebutuhan -->
            <div class="flex flex-col items-center text-center p-3 rounded-xl {{ $currentStep >= 4 ? 'bg-emerald-500/5 border border-emerald-500/20' : 'border border-slate-200/60' }}">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-extrabold {{ $currentStep >= 4 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-500' }}">4</span>
                <span class="text-[11px] font-bold text-slate-900 mt-2 block">Asesmen Analis</span>
                <span class="text-[9px] text-slate-400 mt-1 block">Rekomendasi kebutuhan</span>
            </div>

            <!-- Step 5: Rekomendasi Rujukan -->
            <div class="flex flex-col items-center text-center p-3 rounded-xl {{ $currentStep >= 5 ? 'bg-emerald-500/5 border border-emerald-500/20' : 'border border-slate-200/60' }}">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-extrabold {{ $currentStep >= 5 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-500' }}">5</span>
                <span class="text-[11px] font-bold text-slate-900 mt-2 block">Rekomendasi</span>
                <span class="text-[9px] text-slate-400 mt-1 block">Rekomendasi atau Rujukan</span>
            </div>

            <!-- Step 6: Penerimaan UPTD -->
            <div class="flex flex-col items-center text-center p-3 rounded-xl {{ $currentStep >= 6 ? 'bg-emerald-500/5 border border-emerald-500/20' : 'border border-slate-200/60' }}">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-extrabold {{ $currentStep >= 6 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-500' }}">6</span>
                <span class="text-[11px] font-bold text-slate-900 mt-2 block">Penerimaan UPTD</span>
                <span class="text-[9px] text-slate-400 mt-1 block">Konfirmasi kapasitas mitra</span>
            </div>

            <!-- Step 7: Selesai -->
            <div class="flex flex-col items-center text-center p-3 rounded-xl {{ $currentStep >= 7 ? 'bg-emerald-500/5 border border-emerald-500/20' : 'border border-slate-200/60' }}">
                <span class="flex h-8 w-8 items-center justify-center rounded-full text-xs font-extrabold {{ $currentStep >= 7 ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-500' }}">7</span>
                <span class="text-[11px] font-bold text-slate-900 mt-2 block">Selesai</span>
                <span class="text-[9px] text-slate-400 mt-1 block">Penanganan resmi ditutup</span>
            </div>
        </div>
    </div>

    <!-- Main Content Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Details, History and Actions -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- 1. Case Details Panel -->
            <div class="glass-panel rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4">Informasi Utama Kasus</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs mb-6">
                    <div>
                        <span class="text-slate-400 font-bold uppercase text-[9px] block">Nama Klien / Penerima Manfaat</span>
                        <span class="text-slate-800 font-extrabold text-sm block mt-1">{{ $item->nama_klien }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold uppercase text-[9px] block">NIK</span>
                        <span class="text-slate-800 font-bold text-sm block mt-1">{{ $item->nik ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold uppercase text-[9px] block">Domisili</span>
                        <span class="text-slate-800 font-bold block mt-1">{{ $item->kab_kota }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold uppercase text-[9px] block">Alamat Lengkap</span>
                        <span class="text-slate-800 font-medium block mt-1">{{ $item->alamat }}</span>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-4">
                    <span class="text-slate-400 font-bold uppercase text-[9px] block mb-1">Deskripsi Kondisi Kasus &amp; Masalah</span>
                    <p class="text-xs text-slate-700 leading-relaxed font-medium bg-slate-50 p-4 rounded-xl">{{ $item->deskripsi_kasus }}</p>
                </div>

                @if($item->dokumen_pendukung)
                    <div class="border-t border-slate-100 pt-4 mt-4 flex items-center justify-between">
                        <div>
                            <span class="text-slate-400 font-bold uppercase text-[9px] block">Lampiran Bukti Pendukung</span>
                            <span class="text-xs text-slate-700 font-semibold block mt-1">Dokumen Lampiran Kasus</span>
                        </div>
                        <a href="{{ asset('storage/' . $item->dokumen_pendukung) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 hover:bg-slate-200 px-3.5 py-2 text-xs font-bold text-slate-700 transition">
                            👁️ Buka Lampiran
                        </a>
                    </div>
                @endif
            </div>

            <!-- 2. Workflow Actions (Forms appear dynamically for specific actors) -->
            @auth
                <!-- A. Action: Verifikasi Administrasi (Verifikator) -->
                @if($item->status_workflow === 'diajukan' && (Auth::user()->isVerifikator() || Auth::user()->isAdmin()))
                    <div class="glass-panel rounded-2xl p-6 border-emerald-500/20 bg-emerald-500/[0.01] shadow-md">
                        <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span>📝</span> Form Verifikasi Administrasi Awal (Verifikator)
                        </h3>
                        <form action="{{ route('rehabilitasi.verifikasi_admin', $item->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Keputusan Administrasi</label>
                                <div class="flex items-center gap-4">
                                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <input type="radio" name="status" value="setuju" checked class="text-emerald-600 focus:ring-emerald-500"> Setujui Berkas Lengkap
                                    </label>
                                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <input type="radio" name="status" value="perlu_perbaikan" class="text-rose-600 focus:ring-rose-500"> Minta Revisi / Perbaikan
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label for="catatan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Catatan Pemeriksaan</label>
                                <textarea name="catatan" id="catatan" rows="3" required class="w-full rounded-xl px-4 py-3 text-xs" placeholder="Tuliskan catatan kelengkapan berkas..."></textarea>
                            </div>
                            <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white hover:bg-emerald-500 shadow-md transition">
                                Simpan Verifikasi &amp; Teruskan
                            </button>
                        </form>
                    </div>
                @endif

                <!-- B. Action: Verifikasi Kondisi Sosial Wilayah (Dinsos Kab/Kota) -->
                @if($item->status_workflow === 'verifikasi_awal' && (Auth::user()->isDinsosWilayah() || Auth::user()->isAdmin()))
                    <div class="glass-panel rounded-2xl p-6 border-blue-500/20 bg-blue-500/[0.01] shadow-md">
                        <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span>📍</span> Peninjauan &amp; Konfirmasi Kondisi Sosial Wilayah (Dinsos Kab/Kota)
                        </h3>
                        <form action="{{ route('rehabilitasi.verifikasi_wilayah', $item->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="catatan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Hasil Peninjauan Sosial Lapangan</label>
                                <textarea name="catatan" id="catatan" rows="3" required class="w-full rounded-xl px-4 py-3 text-xs" placeholder="Tuliskan konfirmasi kondisi sosial riil klien di lapangan..."></textarea>
                            </div>
                            <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white hover:bg-emerald-500 shadow-md transition">
                                Kirim Hasil &amp; Teruskan ke Analis
                            </button>
                        </form>
                    </div>
                @endif

                <!-- C. Action: Asesmen Kebutuhan Klien (Analis Rehabilitasi) -->
                @if($item->status_workflow === 'proses_asesmen' && (Auth::user()->role === 'analis_rehabilitasi' || Auth::user()->isBidangRehabilitasi() || Auth::user()->isAdmin()))
                    <div class="glass-panel rounded-2xl p-6 border-indigo-500/20 bg-indigo-500/[0.01] shadow-md">
                        <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span>🔍</span> Asesmen Kebutuhan Rehabilitasi Klien (Analis Rehab)
                        </h3>
                        <form action="{{ route('rehabilitasi.asesmen', $item->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="analisis" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Hasil Analisis &amp; Rencana Intervensi</label>
                                <textarea name="analisis" id="analisis" rows="4" required class="w-full rounded-xl px-4 py-3 text-xs" placeholder="Contoh: Klien membutuhkan dukungan gizi jangka panjang, alat bantu jalan, serta bimbingan mental sosial..."></textarea>
                            </div>
                            @if($item->kategori === 'disabilitas')
                                <div>
                                    <label for="alat_bantu" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kebutuhan Alat Bantu Fisik</label>
                                    <input type="text" name="alat_bantu" id="alat_bantu" class="w-full rounded-xl px-4 py-3 text-xs" placeholder="Contoh: Kursi roda anak ukuran sedang">
                                </div>
                            @endif
                            <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-bold text-white hover:bg-indigo-500 shadow-md transition">
                                Simpan Hasil Asesmen &amp; Teruskan ke Kasi
                            </button>
                        </form>
                    </div>
                @endif

                <!-- D. Action: Rekomendasi Layanan / Rujukan (Kasi Rehabilitasi) -->
                @if($item->status_workflow === 'proses_rekomendasi' && (Auth::user()->role === 'kasi_rehabilitasi' || Auth::user()->isBidangRehabilitasi() || Auth::user()->isAdmin()))
                    <div class="glass-panel rounded-2xl p-6 border-purple-500/20 bg-purple-500/[0.01] shadow-md">
                        <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span>📋</span> Penetapan Rekomendasi &amp; Usulan Rujukan (Kasi Rehab)
                        </h3>
                        <form action="{{ route('rehabilitasi.rekomendasi', $item->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="rekomendasi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Poin-poin Rekomendasi Layanan</label>
                                <textarea name="rekomendasi" id="rekomendasi" rows="3" required class="w-full rounded-xl px-4 py-3 text-xs" placeholder="Detail rekomendasi tindakan rehabilitasi..."></textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Apakah Membutuhkan Rujukan UPTD / Lembaga Mitra?</label>
                                <div class="flex items-center gap-4 mb-3">
                                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <input type="radio" name="perlu_rujukan" value="1" checked onclick="document.getElementById('rujukan-select-container').style.display='block'" class="text-emerald-600 focus:ring-emerald-500"> YA, Butuh Rujukan UPTD
                                    </label>
                                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <input type="radio" name="perlu_rujukan" value="0" onclick="document.getElementById('rujukan-select-container').style.display='none'" class="text-slate-600 focus:ring-slate-500"> TIDAK (Pelayanan Non-Rujukan/Bantuan Mandiri)
                                    </label>
                                </div>
                            </div>
                            <div id="rujukan-select-container">
                                <label for="nama_uptd_lembaga" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama UPTD / Lembaga Mitra Rujukan</label>
                                <select name="nama_uptd_lembaga" id="nama_uptd_lembaga" class="w-full rounded-xl px-4 py-3 text-xs">
                                    <option value="">-- Pilih Lembaga Rujukan --</option>
                                    <option value="UPTD Pelayanan Anak Balita">UPTD Pelayanan Anak Balita</option>
                                    <option value="UPTD Rehabilitasi Sosial Lansia">UPTD Rehabilitasi Sosial Lansia</option>
                                    <option value="UPTD Pelayanan Disabilitas Fisik">UPTD Pelayanan Disabilitas Fisik</option>
                                    <option value="LKS Mitra Harapan Anak">LKS Mitra Harapan Anak</option>
                                    <option value="LKS Lansia Sejahtera">LKS Lansia Sejahtera</option>
                                    <option value="Pusat Rehab NAPZA Bahagia">Pusat Rehab NAPZA Bahagia</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full rounded-xl bg-purple-600 px-4 py-2.5 text-xs font-bold text-white hover:bg-purple-500 shadow-md transition">
                                Tetapkan Rekomendasi &amp; Teruskan
                            </button>
                        </form>
                    </div>
                @endif

                <!-- E. Action: Tanggapan Rujukan (UPTD / Lembaga Mitra) -->
                @if($item->status_workflow === 'dirujuk' && (Auth::user()->isUptdMitra() || Auth::user()->isAdmin()))
                    <div class="glass-panel rounded-2xl p-6 border-amber-500/20 bg-amber-500/[0.01] shadow-md">
                        <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span>🏨</span> Keputusan Penerimaan Rujukan Layanan (UPTD/Lembaga Mitra)
                        </h3>
                        <p class="text-[11px] text-slate-400 mb-4">Periksa kapasitas tempat tidur, kuota gizi, dan kesesuaian kasus.</p>
                        <form action="{{ route('rehabilitasi.tanggapan_rujukan', $item->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Keputusan Penerimaan Klien</label>
                                <div class="flex items-center gap-4">
                                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <input type="radio" name="status_penerimaan_uptd" value="diterima" checked onclick="document.getElementById('ditolak-fields').style.display='none'" class="text-emerald-600 focus:ring-emerald-500"> TERIMA Rujukan (Registrasi Klien)
                                    </label>
                                    <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <input type="radio" name="status_penerimaan_uptd" value="ditolak" onclick="document.getElementById('ditolak-fields').style.display='block'" class="text-rose-600 focus:ring-rose-500"> TOLAK Rujukan (Kapasitas Penuh / Kasus Tidak Sesuai)
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label for="catatan_uptd" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Catatan Penerimaan / Penolakan</label>
                                <textarea name="catatan_uptd" id="catatan_uptd" rows="3" required class="w-full rounded-xl px-4 py-3 text-xs" placeholder="Tuliskan catatan kapasitas atau tanggapan awal..."></textarea>
                            </div>
                            <div id="ditolak-fields" style="display:none;">
                                <label for="alternatif_layanan" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alternatif Rujukan Lain (Rekomendasi UPTD)</label>
                                <textarea name="alternatif_layanan" id="alternatif_layanan" rows="2" class="w-full rounded-xl px-4 py-3 text-xs" placeholder="Sebutkan panti/LKS alternatif untuk klien..."></textarea>
                            </div>
                            <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white hover:bg-emerald-500 shadow-md transition">
                                Simpan Tanggapan Rujukan
                            </button>
                        </form>
                    </div>
                @endif

                <!-- F. Action: Tambah Progres Layanan Rujukan (UPTD / Lembaga Mitra) - PB 3.7 -->
                @if($item->status_workflow === 'diterima_mitra' && (Auth::user()->isUptdMitra() || Auth::user()->isAdmin()))
                    <div class="glass-panel rounded-2xl p-6 border-indigo-500/20 bg-indigo-500/[0.01] shadow-md">
                        <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span>📈</span> Laporkan Progres Perkembangan Klien (PB 3.7 Monitoring)
                        </h3>
                        <p class="text-[11px] text-slate-400 mb-3">Tuliskan laporan mingguan atau bulanan tentang kondisi gizi, medis, mental, atau sosial klien di UPTD.</p>
                        <form action="{{ route('rehabilitasi.tambah_progress', $item->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="log" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Catatan Progres Baru</label>
                                <textarea name="log" id="log" rows="3" required class="w-full rounded-xl px-4 py-3 text-xs" placeholder="Contoh: Perkembangan gizi membaik, berat badan naik 2kg, klien aktif dalam kegiatan bimbingan..."></textarea>
                            </div>
                            <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-bold text-white hover:bg-indigo-500 shadow-md transition">
                                Tambahkan Catatan Progres &rarr;
                            </button>
                        </form>
                    </div>
                @endif

                <!-- G. Action: Evaluasi Akhir & Selesai (Kabid / Admin) -->
                @if(in_array($item->status_workflow, ['diterima_mitra', 'selesai_non_rujukan', 'ditolak_mitra']) && (Auth::user()->role === 'kabid_rehabilitasi' || Auth::user()->isBidangRehabilitasi() || Auth::user()->isAdmin()))
                    <div class="glass-panel rounded-2xl p-6 border-emerald-500/30 bg-emerald-500/[0.02] shadow-md text-center">
                        <span class="text-3xl block mb-2">✅</span>
                        <h3 class="text-base font-extrabold text-slate-900 mb-2">Penyelesaian Penanganan Kasus</h3>
                        <p class="text-xs text-slate-500 mb-6">Seluruh rangkaian layanan rehab, asesmen, dan rujukan telah selesai diverifikasi. Nyatakan kasus selesai secara resmi di sistem.</p>
                        <form action="{{ route('rehabilitasi.selesai', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 text-xs font-bold text-white hover:bg-emerald-500 shadow-md shadow-emerald-500/10 transition">
                                Nyatakan Kasus Selesai &amp; Arsipkan
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

            <!-- 3. Histori Evaluasi Berjenjang -->
            <div class="glass-panel rounded-2xl p-6 shadow-sm space-y-6">
                <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4">Riwayat Evaluasi Kasus</h3>

                <!-- Tahap 1: Verifikasi Admin -->
                <div class="flex items-start gap-4">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full text-xs font-bold {{ $item->verifikasi_admin ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-400' }}">✓</span>
                    <div>
                        <h4 class="text-xs font-extrabold text-slate-900">Pemeriksaan Berkas Administrasi</h4>
                        @if($item->verifikasi_admin)
                            <p class="text-[11px] text-slate-500 mt-1">Status: <strong>{{ strtoupper($item->verifikasi_admin['status']) }}</strong></p>
                            <p class="text-xs text-slate-700 font-medium mt-1">Catatan: "{{ $item->verifikasi_admin['catatan'] }}"</p>
                            <span class="text-[9px] text-slate-400 block mt-1">Oleh: {{ $item->verifikasi_admin['verifikator'] }} | {{ \Carbon\Carbon::parse($item->verifikasi_admin['tanggal'])->format('d M Y, H:i') }} WIB</span>
                        @else
                            <p class="text-xs text-slate-400 italic mt-1">Menunggu pemeriksaan berkas oleh Verifikator...</p>
                        @endif
                    </div>
                </div>

                <!-- Tahap 2: Verifikasi Kondisi Sosial -->
                <div class="flex items-start gap-4 border-t border-slate-100 pt-4">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full text-xs font-bold {{ $item->kondisi_social || $item->kondisi_sosial ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-400' }}">✓</span>
                    <div>
                        <h4 class="text-xs font-extrabold text-slate-900">Tinjauan Kondisi Sosial Wilayah</h4>
                        @if($item->kondisi_sosial)
                            <p class="text-xs text-slate-700 font-medium mt-1">Catatan: "{{ $item->kondisi_sosial['catatan'] }}"</p>
                            <span class="text-[9px] text-slate-400 block mt-1">Oleh: {{ $item->kondisi_sosial['petugas'] }} | {{ \Carbon\Carbon::parse($item->kondisi_sosial['tanggal'])->format('d M Y, H:i') }} WIB</span>
                        @else
                            <p class="text-xs text-slate-400 italic mt-1">Menunggu peninjauan sosial oleh Dinsos Kab/Kota...</p>
                        @endif
                    </div>
                </div>

                <!-- Tahap 3: Asesmen Analis -->
                <div class="flex items-start gap-4 border-t border-slate-100 pt-4">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full text-xs font-bold {{ $item->asesmen_kebutuhan ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-400' }}">✓</span>
                    <div>
                        <h4 class="text-xs font-extrabold text-slate-900">Asesmen Kebutuhan Klien</h4>
                        @if($item->asesmen_kebutuhan)
                            <p class="text-xs text-slate-700 font-medium mt-1">Analisis: "{{ $item->asesmen_kebutuhan['analisis'] }}"</p>
                            @if(isset($item->asesmen_kebutuhan['alat_bantu']) && $item->asesmen_kebutuhan['alat_bantu'] !== '-')
                                <p class="text-[11px] text-indigo-600 font-bold mt-1">Alat Bantu Diusulkan: {{ $item->asesmen_kebutuhan['alat_bantu'] }}</p>
                            @endif
                            <span class="text-[9px] text-slate-400 block mt-1">Oleh: {{ $item->asesmen_kebutuhan['analis'] }} | {{ \Carbon\Carbon::parse($item->asesmen_kebutuhan['tanggal'])->format('d M Y, H:i') }} WIB</span>
                        @else
                            <p class="text-xs text-slate-400 italic mt-1">Menunggu analisis kebutuhan oleh Analis Rehabilitasi...</p>
                        @endif
                    </div>
                </div>

                <!-- Tahap 4: Rekomendasi Kasi -->
                <div class="flex items-start gap-4 border-t border-slate-100 pt-4">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full text-xs font-bold {{ $item->rekomendasi_layanan ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-400' }}">✓</span>
                    <div>
                        <h4 class="text-xs font-extrabold text-slate-900">Penyusunan Rekomendasi &amp; Rujukan</h4>
                        @if($item->rekomendasi_layanan)
                            <p class="text-xs text-slate-700 font-medium mt-1">Rekomendasi: "{{ $item->rekomendasi_layanan['rekomendasi'] }}"</p>
                            <p class="text-[11px] text-slate-500 mt-1">Memerlukan Rujukan UPTD: <strong>{{ $item->rekomendasi_layanan['perlu_rujukan'] ? 'YA ('. $item->rekomendasi_layanan['nama_uptd_lembaga'] .')' : 'TIDAK' }}</strong></p>
                            <span class="text-[9px] text-slate-400 block mt-1">Oleh: {{ $item->rekomendasi_layanan['kasi'] }} | {{ \Carbon\Carbon::parse($item->rekomendasi_layanan['tanggal'])->format('d M Y, H:i') }} WIB</span>
                        @else
                            <p class="text-xs text-slate-400 italic mt-1">Menunggu penyusunan rekomendasi layanan oleh Kepala Seksi...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Rujukan & Progress Log (PB 3.7) -->
        <div class="space-y-8">
            
            <!-- Rujukan UPTD Status Card -->
            <div class="glass-panel rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4">Informasi Rujukan UPTD</h3>
                
                @if($item->perlu_rujukan)
                    <div class="space-y-4 text-xs">
                        <div>
                            <span class="text-slate-400 font-bold uppercase text-[9px] block">Lembaga Rujukan Tujuan</span>
                            <span class="text-slate-800 font-extrabold text-sm block mt-1">{{ $item->nama_uptd_lembaga }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 font-bold uppercase text-[9px] block">Status Penerimaan Rujukan</span>
                            <span class="inline-flex items-center rounded-md px-2 py-0.5 font-bold uppercase text-[9px] mt-1
                                @if($item->status_penerimaan_uptd === 'pending') bg-amber-100 text-amber-800 ring-1 ring-inset ring-amber-200
                                @elseif($item->status_penerimaan_uptd === 'diterima') bg-emerald-100 text-emerald-800 ring-1 ring-inset ring-emerald-200
                                @elseif($item->status_penerimaan_uptd === 'ditolak') bg-rose-100 text-rose-800 ring-1 ring-inset ring-rose-200
                                @endif">
                                {{ strtoupper($item->status_penerimaan_uptd) }}
                            </span>
                        </div>
                        
                        @if($item->catatan_uptd)
                            <div class="border-t border-slate-100 pt-3">
                                <span class="text-slate-400 font-bold uppercase text-[9px] block">Catatan dari UPTD</span>
                                <p class="text-slate-700 italic mt-1 font-medium">"{{ $item->catatan_uptd }}"</p>
                            </div>
                        @endif

                        @if($item->status_penerimaan_uptd === 'ditolak')
                            <div class="p-3 bg-rose-50 border border-rose-200 rounded-xl">
                                <span class="text-rose-700 font-bold uppercase text-[9px] block">Alternatif Tindak Lanjut</span>
                                <p class="text-rose-800 mt-1 font-medium">{{ $item->alternatif_layanan ?? 'Menunggu penentuan alternatif rujukan...' }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-6 text-slate-400 text-xs">
                        <span>ℹ️ Kasus ini tidak memerlukan rujukan ke UPTD / Lembaga Mitra (ditangani langsung oleh Dinsos).</span>
                    </div>
                @endif
            </div>

            <!-- Progress Log (PB 3.7 Monitoring) -->
            <div class="glass-panel rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4">Log Perkembangan Rujukan (3.7)</h3>
                
                @if($item->perlu_rujukan && $item->status_penerimaan_uptd === 'diterima')
                    <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2">
                        @forelse($item->progress_layanan ?? [] as $log)
                            <div class="p-3 bg-slate-50 border border-slate-200/60 rounded-xl text-xs">
                                <p class="text-slate-800 font-medium leading-relaxed">"{{ $log['log'] }}"</p>
                                <div class="flex justify-between items-center text-[9px] text-slate-400 mt-2 border-t border-slate-200/40 pt-1.5">
                                    <span>Oleh: {{ $log['petugas'] }}</span>
                                    <span>{{ \Carbon\Carbon::parse($log['tanggal'])->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400 text-xs italic">
                                <span>Belum ada catatan perkembangan pelayanan yang diunggah oleh UPTD.</span>
                            </div>
                        @endforelse
                    </div>
                @else
                    <div class="text-center py-6 text-slate-400 text-xs">
                        <span>Layanan rujukan belum aktif / diterima. Log perkembangan hanya tersedia ketika rujukan diterima.</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
