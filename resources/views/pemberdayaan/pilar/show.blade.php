@extends('layouts.app')

@section('title', 'Detail Pembinaan Pilar Sosial - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-5xl sm:px-6 lg:px-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('pemberdayaan.pilar.index') }}" class="text-sm font-semibold text-teal-600 hover:underline">&larr; Kembali ke Daftar</a>
            <h1 class="text-2xl font-bold text-slate-900 mt-2">{{ $item->nama_pilar }}</h1>
            <p class="text-sm text-slate-500">Kategori: {{ str_replace('_', ' ', strtoupper($item->kategori_pilar)) }} | Diajukan: {{ $item->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div>
            <span class="inline-flex items-center rounded-full px-4 py-1.5 text-xs font-bold uppercase tracking-wider bg-teal-100 text-teal-800">
                {{ str_replace('_', ' ', strtoupper($item->status_workflow)) }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-teal-50 p-4 border border-teal-200 text-teal-800 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Main Info -->
        <div class="md:col-span-2 space-y-6">
            <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Informasi Pilar &amp; Usulan Pembinaan</h3>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-xs text-slate-400 block">Kategori Pilar</span>
                        <span class="font-semibold text-slate-800 uppercase">{{ $item->kategori_pilar }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Kabupaten / Kota</span>
                        <span class="font-semibold text-slate-800">{{ $item->kab_kota }}</span>
                    </div>
                </div>

                <div>
                    <span class="text-xs text-slate-400 block mb-1">Usulan Kebutuhan Pembinaan</span>
                    <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100">{{ $item->usulan_pembinaan }}</p>
                </div>
            </div>

            @if(strtolower($item->kategori_pilar) === 'tksk')
                <!-- SOP 3: Pengusulan & Pergantian TKSK (8 Steps Tracking Widget) -->
                <div class="glass-panel rounded-2xl p-6 border border-teal-200 bg-teal-50/20 space-y-4">
                    <div class="flex items-center justify-between border-b border-teal-100 pb-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>📋</span> Tracking SOP Pengusulan TKSK (8 Tahapan)
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Standard Mutu Baku SLA Total: 236 Hari Kerja</p>
                        </div>
                        <a href="{{ route('pemberdayaan.pilar.sop_tksk') }}" target="_blank" class="text-xs font-bold text-teal-700 hover:underline">
                            Lihat Panduan Full SOP &rarr;
                        </a>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-start gap-3 p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded border border-teal-200">Step 1</span>
                            <div>
                                <div class="font-bold text-slate-900">1. Surat Usulan TKSK / Pergantian Diterima</div>
                                <div class="text-slate-500">Bagian Umum | SLA: 5 Hari</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded border border-teal-200">Step 2</span>
                            <div>
                                <div class="font-bold text-slate-900">2. Pencatatan ke Buku Surat Masuk Bidang Dayasos</div>
                                <div class="text-slate-500">Administrasi Dayasos | SLA: 1 Hari</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded border border-teal-200">Step 3</span>
                            <div>
                                <div class="font-bold text-slate-900">3. Disposisi Kabid untuk Verifikasi & Validasi</div>
                                <div class="text-slate-500">Kabid Dayasos | SLA: 5 Hari</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded border border-teal-200">Step 4</span>
                            <div>
                                <div class="font-bold text-slate-900">4. Verifikasi & Validasi Berkas Usulan (Verval)</div>
                                <div class="text-slate-500">Staf Dayasos | SLA: 30 Hari</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded border border-teal-200">Step 5</span>
                            <div>
                                <div class="font-bold text-slate-900">5. Pembuatan Draft Surat Rekomendasi ke Kemensos</div>
                                <div class="text-slate-500">Staf Dayasos | SLA: 4 Hari</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded border border-teal-200">Step 6</span>
                            <div>
                                <div class="font-bold text-slate-900">6. Penandatanganan & Stempel Rekomendasi Kadinas</div>
                                <div class="text-slate-500">Kepala Dinas Sosial | SLA: 5 Hari</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded border border-teal-200">Step 7</span>
                            <div>
                                <div class="font-bold text-slate-900">7. Pengentrian Data Usulan TKSK ke Database</div>
                                <div class="text-slate-500">PIC PSKS | SLA: 3 Hari</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">Step 8</span>
                            <div>
                                <div class="font-bold text-slate-900">8. Proses Penerimaan & Turunnya SK Kemensos</div>
                                <div class="text-slate-500">Staf Dayasos & Kemensos | SLA: 183 Hari</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(in_array(strtolower($item->kategori_pilar), ['psm', 'ipsm']))
                <!-- SOP IPSM / PSM (15 Steps Tracking Widget) -->
                <div class="glass-panel rounded-2xl p-6 border border-teal-200 bg-teal-50/20 space-y-4">
                    <div class="flex items-center justify-between border-b border-teal-100 pb-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>📋</span> Tracking SOP IPSM / PSM (15 Tahapan)
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 30 Hari Kerja + 60 Mins</p>
                        </div>
                        <a href="{{ route('pemberdayaan.pilar.sop_ipsm') }}" target="_blank" class="text-xs font-bold text-teal-700 hover:underline">
                            Lihat Panduan Full SOP &rarr;
                        </a>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">1-2. Identifikasi Kebutuhan PSM</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Kesra | SLA: 1 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">3. Rencana Pembentukan PSM</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Data Dayasos | SLA: 2 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">4. Sosialisasi Desa/Kelurahan</span>
                                <div class="text-[11px] text-slate-500">Kabid Dayasos | SLA: 1 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">5. Penjaringan Calon PSM</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Kesra | SLA: 7 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">6. Verifikasi Administrasi</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Data Dayasos | SLA: 4 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">7. Seleksi & Wawancara</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Kesra | SLA: 4 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">8. Bimtek Dasar Calon PSM</span>
                                <div class="text-[11px] text-slate-500">Fungsional | SLA: 1 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">9. Penetapan SK Kadinsos</span>
                                <div class="text-[11px] text-slate-500">Kepala Dinas Sosial | SLA: 3 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">10. Pembekalan & Pelatihan Dasar</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Kesra | SLA: 2 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">11. Pendataan SIM-PSKS</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Kesra | SLA: 60 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">12. Penerbitan Surat Tugas</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Kesra | SLA: 1 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">13. Monitoring & Evaluasi</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Kesra | SLA: 3 Hari</div>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                            <span class="font-bold text-emerald-800">14-15. Pengarsipan Document & Selesai</span>
                            <span class="text-[11px] text-emerald-700 font-semibold">Arsiparis | SLA: 1 Hari</span>
                        </div>
                    </div>
                </div>
            @endif

            @if(strtolower($item->kategori_pilar) === 'karang_taruna')
                <!-- SOP Karang Taruna (14 Steps Tracking Widget) -->
                <div class="glass-panel rounded-2xl p-6 border border-teal-200 bg-teal-50/20 space-y-4">
                    <div class="flex items-center justify-between border-b border-teal-100 pb-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>📋</span> Tracking SOP Karang Taruna (14 Tahapan)
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 1 Hari + 8 Jam 5 Mins</p>
                        </div>
                        <a href="{{ route('pemberdayaan.pilar.sop_karang_taruna') }}" target="_blank" class="text-xs font-bold text-teal-700 hover:underline">
                            Lihat Panduan Full SOP &rarr;
                        </a>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">2. Mendata Susunan Pengurus</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Data Dayasos | SLA: 1 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">3. Pembuatan Undangan</span>
                                <div class="text-[11px] text-slate-500">Persuratan | SLA: 10 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">4. Verifikasi Undangan</span>
                                <div class="text-[11px] text-slate-500">Sekretaris | SLA: 5 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">5. Menandatangani Undangan</span>
                                <div class="text-[11px] text-slate-500">Kadis | SLA: 10 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">6. Penggandaan Undangan</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Data Dayasos | SLA: 20 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">7. Pengiriman Undangan</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Kesra | SLA: 1 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">8. Persiapan Sarpras</span>
                                <div class="text-[11px] text-slate-500">Staf Dayasos | SLA: 60 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">9. Kebersihan Sarpras</span>
                                <div class="text-[11px] text-slate-500">Pramu Kebersihan | SLA: 60 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">10. Melaksanakan Pembinaan</span>
                                <div class="text-[11px] text-slate-500">Fungsional | SLA: 3 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">11. Membuat Laporan Hasil</span>
                                <div class="text-[11px] text-slate-500">Fungsional | SLA: 60 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">12. Verifikasi Laporan Hasil</span>
                                <div class="text-[11px] text-slate-500">Pengelolaan Kesra | SLA: 5 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-teal-700">13-14. TTD Laporan Kadinsos</span>
                                <div class="text-[11px] text-slate-500">Sekretaris & Kadis | SLA: 10 Menit</div>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                            <span class="font-bold text-emerald-800">15. Pengarsipan Laporan Pembinaan Karang Taruna</span>
                            <span class="text-[11px] text-emerald-700 font-semibold">Arsiparis | SLA: 5 Menit</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Program Bimtek & Assessment Scorecard -->
            @if($item->program_bimtek || $item->catatan_evaluasi)
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Program Bimtek &amp; Assessment Scorecard</h3>
                    
                    @if($item->program_bimtek)
                        <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 space-y-2 text-sm">
                            <span class="text-xs font-bold text-blue-700 uppercase tracking-wider block">Pelaksanaan Bimbek / Penguatan Kapasitas</span>
                            <div><strong>Judul Bimtek:</strong> {{ $item->program_bimtek['judul'] ?? '-' }}</div>
                            <div><strong>Modul / Materi:</strong> {{ $item->program_bimtek['modul'] ?? '-' }}</div>
                            <div><strong>Narasumber:</strong> {{ $item->program_bimtek['narasumber'] ?? '-' }}</div>
                            <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal_bimtek)->format('d F Y') }}</div>
                        </div>
                    @endif

                    @if($item->catatan_evaluasi)
                        <div class="bg-teal-50/50 p-4 rounded-xl border border-teal-100 space-y-2 text-sm">
                            <span class="text-xs font-bold text-teal-700 uppercase tracking-wider block">Hasil Evaluasi Scorecard</span>
                            <div><strong>Skor Penilaian Kapasitas:</strong> <span class="font-extrabold text-teal-900">{{ $item->evaluasi_skor }} / 100</span></div>
                            <div><strong>Catatan Evaluasi:</strong> {{ $item->catatan_evaluasi }}</div>
                            <div><strong>Perlu Pembinaan Lanjutan:</strong> {{ $item->perlu_pembinaan_lanjutan ? 'YA' : 'TIDAK' }}</div>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Workflow Action Cards -->
        <div class="space-y-6">
            <!-- Staff: Konfigurasi Program Bimtek -->
            @if(Auth::user()->isBidangPemberdayaan() && in_array($item->status_workflow, ['diajukan', 'diidentifikasi']))
                <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Form Konfigurasi Bimtek</h3>
                    <form action="{{ route('pemberdayaan.pilar.bimtek.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Bimtek *</label>
                            <input type="text" name="judul_bimtek" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Modul Materi *</label>
                            <input type="text" name="modul" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Narasumber *</label>
                            <input type="text" name="narasumber" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Bimtek *</label>
                            <input type="date" name="tanggal_bimtek" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-teal-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-teal-700">
                            Simpan Program Bimtek
                        </button>
                    </form>
                </div>
            @endif

            <!-- Staff: Evaluasi Scorecard -->
            @if(Auth::user()->isBidangPemberdayaan() && $item->status_workflow === 'bimtek_dilaksanakan')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Form Assessment Scorecard</h3>
                    <form action="{{ route('pemberdayaan.pilar.evaluasi.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Skor Evaluasi (0 - 100) *</label>
                            <input type="number" name="evaluasi_skor" min="0" max="100" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Evaluasi *</label>
                            <textarea name="catatan_evaluasi" rows="3" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Perlu Pembinaan Lanjutan? *</label>
                            <select name="perlu_pembinaan_lanjutan" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                                <option value="1">Ya, teruskan ke pengesahan Kadinas</option>
                                <option value="0">Tidak, cukup</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-emerald-700">
                            Simpan Evaluasi Pilar
                        </button>
                    </form>
                </div>
            @endif

            <!-- Sekretariat: Arsip -->
            @if((Auth::user()->isSekretariat() || Auth::user()->isAdmin()) && $item->status_workflow === 'dievaluasi')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-purple-50/40">
                    <h3 class="text-sm font-bold text-purple-900 mb-2">Aksi Sekretariat</h3>
                    <form action="{{ route('pemberdayaan.pilar.arsip.store', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-purple-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-purple-700">
                            Arsipkan Dokumentasi &amp; Laporan
                        </button>
                    </form>
                </div>
            @endif

            <!-- Kepala Dinas: Pengesahan -->
            @if((Auth::user()->isKadinas() || Auth::user()->isAdmin()) && $item->status_workflow === 'diarsipkan_sekretariat')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-teal-50/40">
                    <h3 class="text-sm font-bold text-teal-900 mb-2">Pengesahan Kepala Dinas</h3>
                    <form action="{{ route('pemberdayaan.pilar.approval.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Keputusan *</label>
                            <select name="status" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                                <option value="disahkan_kadinas">Sah / Disetujui Kepala Dinas</option>
                                <option value="ditolak">Tolak / Perbaikan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Pengesahan</label>
                            <textarea name="catatan_revisi" rows="2" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-teal-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-teal-700">
                            Simpan Pengesahan
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
