@extends('layouts.app')

@section('title', 'Detail Permohonan Perizinan')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">

    <!-- Header & Back Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('perizinan.index') }}" class="text-xs font-bold text-emerald-400 hover:underline flex items-center gap-1.5 mb-2">
                &larr; Kembali ke Dashboard
            </a>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Detail Permohonan #{{ $perizinan->id }}</h1>
            <p class="text-xs text-slate-400 mt-0.5">Pantau alur verifikasi secara real-time dan ulasan petugas dinas sosial.</p>
        </div>
        <div class="flex items-center gap-3">
            @if($perizinan->status === 'selesai')
                <a href="{{ route('perizinan.download_pdf', $perizinan->id) }}" target="_blank" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2.5 text-xs font-bold text-slate-950 shadow-md hover:opacity-90 transition duration-200">
                    📥 Cetak Rekomendasi / Izin
                </a>
            @endif
            @if(($perizinan->pemohon_id === $user->id) && ($perizinan->perlu_perbaikan || $perizinan->status === 'draft'))
                <a href="{{ route('perizinan.edit', $perizinan->id) }}" class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-4 py-2.5 text-xs font-bold text-slate-950 hover:bg-amber-400 transition duration-200">
                    ✏️ Perbaiki & Lengkapi Data
                </a>
            @endif
        </div>
    </div>

    <!-- Alert for Revision/Repair -->
    @if($perizinan->perlu_perbaikan)
        <div class="mb-8 p-4 rounded-2xl border border-amber-500/20 bg-amber-500/5 flex items-start gap-3">
            <span class="text-lg">⚠️</span>
            <div>
                <h4 class="text-sm font-bold text-amber-400">Butuh Perbaikan Dokumen / Informasi</h4>
                <p class="text-xs text-slate-300 mt-1">
                    Permohonan dikembalikan oleh petugas untuk diperbaiki. Silakan klik tombol <strong>"Perbaiki & Lengkapi Data"</strong> di atas.
                </p>
                <div class="mt-2.5 p-3 rounded-xl bg-slate-950 border border-slate-900">
                    <p class="text-xs text-slate-400"><strong class="text-slate-300">Catatan Petugas:</strong> {{ $perizinan->catatan_perbaikan }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- ================== LEFT PANEL: APPLICATION DETAILS ================== -->
        <div class="lg:col-span-7 space-y-6">
            <div class="glass-panel rounded-3xl p-6">
                <div class="border-b border-slate-900 pb-4 mb-6 flex justify-between items-center">
                    <h3 class="font-extrabold text-white text-base">Rincian Formulir Pengajuan</h3>
                    <span class="inline-flex items-center rounded-full bg-slate-950 px-2.5 py-0.5 text-[10px] font-bold text-slate-400 ring-1 ring-slate-800">
                        {{ strtoupper($perizinan->jenis_layanan) }}
                    </span>
                </div>

                <!-- Shared fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div>
                        <span class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Nama Pemohon</span>
                        <p class="text-sm font-bold text-slate-200 mt-0.5">{{ $perizinan->pemohon->name }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Jenis Layanan</span>
                        <p class="text-sm font-bold text-slate-200 mt-0.5">{{ $jenisLabels[$perizinan->jenis_layanan] }}</p>
                    </div>
                    @if($perizinan->nomor_izin)
                        <div>
                            <span class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Nomor Dokumen Resmi</span>
                            <p class="text-sm font-bold text-emerald-400 mt-0.5">{{ $perizinan->nomor_izin }}</p>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-500 uppercase tracking-wide font-bold">Tanggal Masa Berlaku</span>
                            <p class="text-xs font-semibold text-slate-200 mt-0.5">
                                {{ $perizinan->tanggal_terbit->format('d M Y') }} s.d. 
                                @if($perizinan->jenis_layanan === 'adopsi')
                                    Selamanya (Permanen)
                                @else
                                    {{ $perizinan->tanggal_kadaluarsa->format('d M Y') }}
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Conditional fields based on service type -->
                <div class="border-t border-slate-900 pt-6 space-y-4">
                    @php
                        $data = $perizinan->data_tambahan ?? [];
                    @endphp

                    @if($perizinan->jenis_layanan === 'ugb')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Penyelenggara</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_penyelenggara'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Acara Undian</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_undian'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Total Nilai Hadiah</span>
                                <span class="text-xs font-bold text-emerald-400">Rp {{ number_format($data['total_hadiah'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Waktu Pelaksanaan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['waktu_pelaksanaan'] ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            <span class="text-[10px] text-slate-500 block">Deskripsi & Mekanisme</span>
                            <p class="text-xs text-slate-300 mt-1 leading-relaxed bg-slate-950 p-3 rounded-xl border border-slate-900">{{ $data['deskripsi_kegiatan'] ?? '-' }}</p>
                        </div>

                    @elseif($perizinan->jenis_layanan === 'pub')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Lembaga Pemohon</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_penyelenggara'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Tujuan Pengumpulan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['tujuan_pengumpulan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Metode Pengumpulan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['metode_pengumpulan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Target Dana Sumbangan</span>
                                <span class="text-xs font-bold text-emerald-400">Rp {{ number_format($data['target_dana'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Wilayah Pengumpulan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['wilayah_pengumpulan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Jangka Waktu Pengumpulan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['waktu_pelaksanaan'] ?? '-' }}</span>
                            </div>
                        </div>

                    @elseif($perizinan->jenis_layanan === 'lks')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama LKS</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_lks'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Fokus Rehabilitasi / Layanan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['jenis_pelayanan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Pimpinan / Ketua</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_pimpinan'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Jumlah Warga Binaan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['jumlah_binaan'] ?? 0 }} Jiwa</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            <span class="text-[10px] text-slate-500 block">Alamat Kantor / Panti LKS</span>
                            <p class="text-xs text-slate-300 mt-1 leading-relaxed bg-slate-950 p-3 rounded-xl border border-slate-900">{{ $data['alamat_lks'] ?? '-' }}</p>
                        </div>

                    @elseif($perizinan->jenis_layanan === 'adopsi')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Calon Ayah</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_ayah'] ?? '-' }} (NIK: {{ $data['nik_ayah'] ?? '-' }})</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Calon Ibu</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_ibu'] ?? '-' }} (NIK: {{ $data['nik_ibu'] ?? '-' }})</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Lama Pernikahan</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['lama_menikah'] ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Penghasilan Bulanan COTA</span>
                                <span class="text-xs font-bold text-emerald-400">Rp {{ number_format($data['penghasilan'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Nama Anak yang Diangkat</span>
                                <span class="text-xs font-semibold text-slate-200">{{ $data['nama_anak'] ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            <span class="text-[10px] text-slate-500 block">Alamat Tinggal COTA</span>
                            <p class="text-xs text-slate-300 mt-1 bg-slate-950 p-3 rounded-xl border border-slate-900">{{ $data['alamat_cota'] ?? '-' }}</p>
                        </div>
                        <div class="pt-2">
                            <span class="text-[10px] text-slate-500 block">Alasan Pengangkatan Anak</span>
                            <p class="text-xs text-slate-300 mt-1 leading-relaxed bg-slate-950 p-3 rounded-xl border border-slate-900">{{ $data['alasan_adopsi'] ?? '-' }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Uploaded Documents card -->
            <div class="glass-panel rounded-3xl p-6">
                <h3 class="font-extrabold text-white text-base border-b border-slate-900 pb-4 mb-4">Berkas Pendukung</h3>
                <div class="space-y-3">
                    @php
                        $docs = [];
                        if($perizinan->jenis_layanan === 'ugb') {
                            $docs = ['Proposal Kegiatan' => 'dokumen_proposal', 'Daftar Hadiah' => 'dokumen_hadiah'];
                        } elseif($perizinan->jenis_layanan === 'pub') {
                            $docs = ['Proposal Program PUB' => 'dokumen_proposal', 'Buku Tabungan Lembaga' => 'dokumen_rekening'];
                        } elseif($perizinan->jenis_layanan === 'lks') {
                            $docs = ['Akta Notaris & AD/ART' => 'dokumen_akta', 'Surat Domisili Kelurahan' => 'dokumen_domisili'];
                        } elseif($perizinan->jenis_layanan === 'adopsi') {
                            $docs = ['Akta Nikah COTA' => 'dokumen_nikah', 'Surat Keterangan Sehat' => 'dokumen_sehat'];
                        }
                    @endphp

                    @foreach($docs as $label => $key)
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-950/40 border border-slate-900">
                            <div class="flex items-center gap-3">
                                <span class="text-xl">📁</span>
                                <div>
                                    <h5 class="text-xs font-bold text-slate-300">{{ $label }}</h5>
                                    <p class="text-[10px] text-slate-500 mt-0.5">format: PDF/Docx</p>
                                </div>
                            </div>
                            @if(isset($data[$key]))
                                <a href="{{ Storage::url($data[$key]) }}" target="_blank" class="text-xs font-bold text-emerald-400 hover:underline">
                                    Lihat Berkas &rarr;
                                </a>
                            @else
                                <span class="text-[10px] text-slate-600 italic">Belum diunggah / Menggunakan Mock</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ================== RIGHT PANEL: TRACKING TIMELINE & REVIEW ACTION ================== -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Real-time vertical tracking timeline -->
            <div class="glass-panel rounded-3xl p-6">
                <h3 class="font-extrabold text-white text-base border-b border-slate-900 pb-4 mb-6">Status Pelacakan Alur</h3>
                
                <div class="relative pl-6 border-l border-slate-800 space-y-6">
                    @php
                        $histories = $perizinan->history_status ?? [];
                    @endphp

                    @foreach($histories as $idx => $h)
                        <div class="relative">
                            <!-- Timeline Dot -->
                            <span class="absolute -left-[31px] top-1 flex h-4.5 w-4.5 items-center justify-center rounded-full bg-emerald-500 text-[10px] ring-4 ring-slate-950">
                                ✓
                            </span>
                            <div>
                                <div class="flex items-center justify-between gap-2">
                                    <h4 class="text-xs font-bold text-white">{{ $h['tahap'] }} - {{ $h['status'] }}</h4>
                                    <span class="text-[9px] text-slate-500 font-semibold uppercase">{{ \Carbon\Carbon::parse($h['waktu'])->format('d M H:i') }}</span>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-0.5">Oleh: <strong>{{ $h['oleh'] }}</strong> ({{ $h['role'] }})</p>
                                @if(isset($h['catatan']))
                                    <p class="text-[11px] text-slate-300 bg-slate-950/60 p-2.5 rounded-xl border border-slate-900/60 mt-2 leading-relaxed">
                                        {{ $h['catatan'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <!-- In Progress Step if still active -->
                    @if($perizinan->status === 'diperiksa')
                        <div class="relative">
                            <span class="absolute -left-[31px] top-1 flex h-4.5 w-4.5 animate-pulse items-center justify-center rounded-full bg-blue-500 text-[10px] ring-4 ring-slate-950">
                                ⏳
                            </span>
                            <div>
                                <h4 class="text-xs font-bold text-blue-400">
                                    Sedang Ditinjau: 
                                    @if($perizinan->tahap_verifikasi === 'sekretariat')
                                        Kelengkapan Awal (Sekretariat)
                                    @elseif($perizinan->tahap_verifikasi === 'verifikator')
                                        Legalitas Administrasi (Verifikator)
                                    @elseif($perizinan->tahap_verifikasi === 'dinsos_wilayah')
                                        Konfirmasi Wilayah (Dinsos Kab/Kota)
                                    @elseif($perizinan->tahap_verifikasi === 'bidang_teknis')
                                        Substansi Kegiatan (Bidang Teknis)
                                    @elseif($perizinan->tahap_verifikasi === 'kepala_dinas')
                                        Persetujuan Akhir (Kepala Dinas)
                                    @endif
                                </h4>
                                <p class="text-[10px] text-slate-500 mt-0.5">Status antrean berjalan. Menunggu verifikasi dari petugas terkait.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- OFFICER ACTION PANEL -->
            @if($perizinan->status === 'diperiksa' && !$perizinan->perlu_perbaikan)
                @php
                    $isRoleMatch = false;
                    if($user->isSekretariat() && $perizinan->tahap_verifikasi === 'sekretariat') { $isRoleMatch = true; }
                    elseif($user->isVerifikator() && $perizinan->tahap_verifikasi === 'verifikator') { $isRoleMatch = true; }
                    elseif($user->isDinsosWilayah() && $perizinan->tahap_verifikasi === 'dinsos_wilayah') { $isRoleMatch = true; }
                    elseif($user->isBidangPemberdayaan() && $perizinan->tahap_verifikasi === 'bidang_teknis' && in_array($perizinan->jenis_layanan, ['ugb', 'pub', 'lks'])) { $isRoleMatch = true; }
                    elseif($user->isBidangLinjamsos() && $perizinan->tahap_verifikasi === 'bidang_teknis' && $perizinan->jenis_layanan === 'adopsi') { $isRoleMatch = true; }
                    elseif($user->isKadinas() && $perizinan->tahap_verifikasi === 'kepala_dinas') { $isRoleMatch = true; }
                    elseif($user->isAdmin()) { $isRoleMatch = true; } // Admin bypass
                @endphp

                @if($isRoleMatch)
                    <div class="glass-panel rounded-3xl p-6 border-indigo-500/20 bg-indigo-500/5 glow-indigo">
                        <h3 class="font-extrabold text-white text-base border-b border-indigo-500/10 pb-4 mb-4 flex items-center gap-2">
                            <span>🔑</span> Panel Keputusan Petugas
                        </h3>
                        <p class="text-[11px] text-slate-400 mb-4">Ulas dokumen di sebelah kiri, lalu pilih tindakan keputusan di bawah ini.</p>

                        <form action="{{ route('admin.perizinan.process', $perizinan->id) }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <!-- Decision options -->
                            <div class="space-y-1.5">
                                <label for="action" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Tindakan Ulasan</label>
                                <select id="action" name="action" required onchange="toggleFormFields(this.value)"
                                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-indigo-500">
                                    <option value="approve">
                                        @if($perizinan->tahap_verifikasi === 'sekretariat') Lengkap (Teruskan ke Verifikator)
                                        @elseif($perizinan->tahap_verifikasi === 'verifikator') Valid (Teruskan ke Bidang/Wilayah)
                                        @elseif($perizinan->tahap_verifikasi === 'dinsos_wilayah') Rekomendasi Layak (Teruskan ke Bidang)
                                        @elseif($perizinan->tahap_verifikasi === 'bidang_teknis') Kirim Draft Rekomendasi ke Kadinas
                                        @elseif($perizinan->tahap_verifikasi === 'kepala_dinas') Sah & Setujui Permohonan (Terbit Dokumen)
                                        @endif
                                    </option>
                                    <option value="perbaikan">Kembalikan untuk Perbaikan Dokumen</option>
                                    @if(in_array($perizinan->tahap_verifikasi, ['bidang_teknis', 'kepala_dinas']))
                                        <option value="reject">Tolak Permohonan (Permanen)</option>
                                    @endif
                                </select>
                            </div>

                            <!-- Bidang Teknis Input for Recommendation draft number -->
                            @if($perizinan->tahap_verifikasi === 'bidang_teknis')
                                <div id="nomor_rekomendasi_field" class="space-y-1.5">
                                    <label for="nomor_surat_rekomendasi" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Nomor Surat Draft Rekomendasi</label>
                                    <input type="text" id="nomor_surat_rekomendasi" name="nomor_surat_rekomendasi" value="REK-{{ strtoupper($perizinan->jenis_layanan) }}-{{ date('Y') }}-{{ rand(100,999) }}"
                                        class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500">
                                </div>
                            @endif

                            <!-- Display recommendation draft if Kepala Dinas is reviewing -->
                            @if($perizinan->tahap_verifikasi === 'kepala_dinas')
                                <div class="p-3.5 rounded-2xl bg-slate-950 border border-slate-900 space-y-2">
                                    <h4 class="text-xs font-bold text-indigo-400">Rekomendasi dari Bidang Teknis:</h4>
                                    <p class="text-[11px] text-slate-300 font-semibold">Nomor Draft: {{ $data['draft_nomor_rekomendasi'] ?? '-' }}</p>
                                    <p class="text-[11px] text-slate-400 italic">"{{ $data['draft_catatan_bidang'] ?? '-' }}"</p>
                                </div>
                            @endif

                            <div class="space-y-1.5">
                                <label for="catatan" class="block text-xs font-bold text-slate-300 uppercase tracking-wide">Catatan Pertimbangan / Alasan Perbaikan</label>
                                <textarea id="catatan" name="catatan" required rows="3"
                                    class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500"
                                    placeholder="Tuliskan catatan ulasan kelayakan berkas, atau alasan pengembalian dokumen..."></textarea>
                            </div>

                            <button type="submit" class="w-full rounded-xl bg-indigo-600 py-3 text-xs font-bold text-white shadow-md hover:bg-indigo-500 transition duration-200">
                                Kirim Keputusan Verifikasi
                            </button>
                        </form>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleFormFields(action) {
        const nomField = document.getElementById('nomor_rekomendasi_field');
        if (nomField) {
            if (action === 'approve') {
                nomField.style.display = 'block';
                nomField.querySelector('input').setAttribute('required', 'required');
            } else {
                nomField.style.display = 'none';
                nomField.querySelector('input').removeAttribute('required');
            }
        }
    }
</script>
@endsection
