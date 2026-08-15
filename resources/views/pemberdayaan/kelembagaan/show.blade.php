@extends('layouts.app')

@section('title', 'Detail & Workflow Pembinaan Kelembagaan - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-5xl sm:px-6 lg:px-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('pemberdayaan.kelembagaan.index') }}" class="text-sm font-semibold text-emerald-600 hover:underline">&larr; Kembali ke Daftar</a>
            <h1 class="text-2xl font-bold text-slate-900 mt-2">{{ $item->nama_lembaga }}</h1>
            <p class="text-sm text-slate-500">ID Pengajuan: #PK-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }} | Diajukan pada: {{ $item->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div>
            <span class="inline-flex items-center rounded-full px-4 py-1.5 text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
                {{ str_replace('_', ' ', strtoupper($item->status_workflow)) }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-emerald-50 p-4 border border-emerald-200 text-emerald-800 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- Workflow Progress Bar -->
    <div class="glass-panel rounded-2xl p-6 mb-8 border border-slate-200">
        <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Status Progress Workflow</h3>
        @php
            $steps = [
                'diajukan' => '1. Pengajuan LKS',
                'rencana_pembinaan' => '2. Agenda Pembinaan',
                'dilaksanakan' => '3. Hasil Pembinaan',
                'diarsipkan_sekretariat' => '4. Pengarsipan Sekretariat',
                'disetujui_kadinas' => '5. Persetujuan Kadinas',
            ];
            $currentOrder = array_search($item->status_workflow, array_keys($steps));
            if ($currentOrder === false) $currentOrder = 0;
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-5 gap-2">
            @foreach($steps as $key => $label)
                @php
                    $stepOrder = array_search($key, array_keys($steps));
                    $isCompleted = $stepOrder <= $currentOrder && $item->status_workflow !== 'ditolak';
                @endphp
                <div class="p-3 rounded-xl text-center text-xs font-bold border {{ $isCompleted ? 'bg-emerald-500 text-white border-emerald-600' : 'bg-slate-100 text-slate-400 border-slate-200' }}">
                    {{ $label }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Main Data Panel -->
        <div class="md:col-span-2 space-y-6">
            <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Informasi Lembaga &amp; Permohonan</h3>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-xs text-slate-400 block">Jenis Lembaga</span>
                        <span class="font-semibold text-slate-800">{{ $item->jenis_lembaga }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Kabupaten / Kota</span>
                        <span class="font-semibold text-slate-800">{{ $item->kab_kota }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Nomor Registrasi</span>
                        <span class="font-semibold text-slate-800">{{ $item->nomor_registrasi ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Pemohon</span>
                        <span class="font-semibold text-slate-800">{{ $item->user->name ?? '-' }}</span>
                    </div>
                </div>

                <div>
                    <span class="text-xs text-slate-400 block mb-1">Alamat Lembaga</span>
                    <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100">{{ $item->alamat_lembaga }}</p>
                </div>

                @if($item->usulan_pembinaan)
                    <div>
                        <span class="text-xs text-slate-400 block mb-1">Usulan Kebutuhan Pembinaan</span>
                        <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100">{{ $item->usulan_pembinaan }}</p>
                    </div>
                @endif

                @if($item->dokumen_permohonan)
                    <div>
                        <span class="text-xs text-slate-400 block mb-1">Dokumen Lampiran</span>
                        <a href="{{ asset('storage/' . $item->dokumen_permohonan) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold text-emerald-600 hover:underline">
                            Lihat Dokumen Permohonan &rarr;
                        </a>
                    </div>
                @endif
            </div>

            <!-- SOP Bantuan BK3S (9 Steps Tracking Widget) -->
            <div class="glass-panel rounded-2xl p-6 border border-emerald-200 bg-emerald-50/20 space-y-4">
                <div class="flex items-center justify-between border-b border-emerald-200 pb-3">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <span>🏢</span> Tracking SOP Bantuan BK3S (9 Tahapan)
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 16 Hari Kerja</p>
                    </div>
                    <a href="{{ route('pemberdayaan.kelembagaan.sop_bk3s') }}" target="_blank" class="text-xs font-bold text-emerald-700 hover:underline">
                        Lihat Panduan Full SOP &rarr;
                    </a>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">1. Pengumpulan Data Kab/Kota</span>
                            <div class="text-[11px] text-slate-500">Dinsos Kab/Kota | SLA: 3 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">2. Rekapitulasi Data Calon Penerima</span>
                            <div class="text-[11px] text-slate-500">Pengolah Data | SLA: 2 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">3. Penginputan Data Penerima Bansos</span>
                            <div class="text-[11px] text-slate-500">Pengolah Data | SLA: 2 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">4. Verval Berkas LKS & Syarat Penerima</span>
                            <div class="text-[11px] text-slate-500">Kabid Dayasos | SLA: 2 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">5. Rekomendasi Kadinsos Prov</span>
                            <div class="text-[11px] text-slate-500">Kadinsos Prov | SLA: 2 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">6. Persiapan Dokumen Data Penerima</span>
                            <div class="text-[11px] text-slate-500">Dinsos Kab/Kota | SLA: 3 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">7. Pengiriman Berkas Lengkap ke Prov</span>
                            <div class="text-[11px] text-slate-500">Pengolah Data | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">8. Berkas Diteruskan ke BK3S</span>
                            <div class="text-[11px] text-slate-500">BK3S | SLA: 5 Menit</div>
                        </div>
                    </div>
                    <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                        <span class="font-bold text-emerald-800">9. Penyaluran Bantuan Sosial BK3S Tepat Sasaran</span>
                        <span class="text-[11px] text-emerald-700 font-semibold">Dinsos Kab/Kota & BK3S | SLA: 1 Hari</span>
                    </div>
                </div>
            </div>

            <!-- SOP Penerbitan STP (9 Steps Tracking Widget) -->
            <div class="glass-panel rounded-2xl p-6 border border-emerald-200 bg-emerald-50/20 space-y-4">
                <div class="flex items-center justify-between border-b border-emerald-200 pb-3">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <span>📋</span> Tracking SOP Penerbitan STP (9 Tahapan)
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 470 Menit (7.8 Jam)</p>
                    </div>
                    <a href="{{ route('pemberdayaan.kelembagaan.sop_stp') }}" target="_blank" class="text-xs font-bold text-emerald-700 hover:underline">
                        Lihat Panduan Full SOP &rarr;
                    </a>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">1. Registrasi Akun</span>
                            <div class="text-[11px] text-slate-500">Pemohon | SLA: 30 Menit</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">2. Permohonan &amp; Unggah Syarat</span>
                            <div class="text-[11px] text-slate-500">Pemohon | SLA: 120 Menit</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">3. Verifikasi Administrasi</span>
                            <div class="text-[11px] text-slate-500">Sekretariat | SLA: 60 Menit</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">4. Pemeriksaan Lapangan</span>
                            <div class="text-[11px] text-slate-500">Pengolah Data | SLA: 180 Menit</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">5. Penyusunan BAP &amp; Rekomendasi</span>
                            <div class="text-[11px] text-slate-500">Pengolah Data | SLA: 30 Menit</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">6. Verifikasi Draf Izin</span>
                            <div class="text-[11px] text-slate-500">Pengolah Data | SLA: 15 Menit</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">7. Persetujuan &amp; TTE Kadinas</span>
                            <div class="text-[11px] text-slate-500">Kepala Dinas | SLA: 15 Menit</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-800">8. Pencetakan STP LKS</span>
                            <div class="text-[11px] text-slate-500">Pemohon | SLA: 10 Menit</div>
                        </div>
                    </div>
                    <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                        <span class="font-bold text-emerald-800">9. Pengarsipan Elektronik</span>
                        <span class="text-[11px] text-emerald-700 font-semibold">Sekretariat | SLA: 10 Menit</span>
                    </div>
                </div>
            </div>

            <!-- Agenda & Catatan Hasil Pembinaan -->
            @if($item->agenda_pembinaan || $item->hasil_pembinaan)
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Agenda &amp; Hasil Pelaksanaan Pembinaan</h3>
                    
                    @if($item->agenda_pembinaan)
                        <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 space-y-2 text-sm">
                            <span class="text-xs font-bold text-blue-700 uppercase tracking-wider block">Agenda Pembinaan (Bidang Pemberdayaan)</span>
                            <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal_pembinaan)->format('d F Y') }}</div>
                            <div><strong>Materi:</strong> {{ $item->agenda_pembinaan['materi'] ?? '-' }}</div>
                            <div><strong>Tim Pelaksana:</strong> {{ $item->agenda_pembinaan['tim_pelaksana'] ?? '-' }}</div>
                        </div>
                    @endif

                    @if($item->hasil_pembinaan)
                        <div class="bg-emerald-50/50 p-4 rounded-xl border border-emerald-100 space-y-2 text-sm">
                            <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Hasil &amp; Catatan Evaluasi</span>
                            <div><strong>Hasil Pembinaan:</strong> {{ $item->hasil_pembinaan }}</div>
                            <div><strong>Catatan Evaluasi:</strong> {{ $item->catatan_evaluasi }}</div>
                            <div><strong>Perlu Tindak Lanjut:</strong> {{ $item->perlu_tindak_lanjut ? 'YA' : 'TIDAK' }}</div>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Action Panel for Staff & Roles -->
        <div class="space-y-6">
            <!-- 1. Bidang Pemberdayaan (Analis/Kasi) Action: Susun Agenda -->
            @if(Auth::user()->isBidangPemberdayaan() && in_array($item->status_workflow, ['diajukan', 'rencana_pembinaan']))
                <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Form Menyusun Agenda Pembinaan</h3>
                    <form action="{{ route('pemberdayaan.kelembagaan.agenda.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Pelaksanaan *</label>
                            <input type="date" name="tanggal_pembinaan" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Materi Pembinaan *</label>
                            <textarea name="materi" rows="2" required placeholder="Pokok materi pembinaan" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Tim Pelaksana / Pendamping *</label>
                            <input type="text" name="tim_pelaksana" required placeholder="Nama analis/petugas pembina" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-blue-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-blue-700">
                            Simpan Agenda Pembinaan
                        </button>
                    </form>
                </div>
            @endif

            <!-- 2. Bidang Pemberdayaan Action: Input Hasil Pembinaan -->
            @if(Auth::user()->isBidangPemberdayaan() && $item->status_workflow === 'rencana_pembinaan')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Form Catat Hasil Pembinaan</h3>
                    <form action="{{ route('pemberdayaan.kelembagaan.hasil.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Hasil Pembinaan *</label>
                            <textarea name="hasil_pembinaan" rows="3" required placeholder="Uraian hasil pembinaan" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Evaluasi *</label>
                            <textarea name="catatan_evaluasi" rows="2" required placeholder="Evaluasi rekomendasi" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Perlu Tindak Lanjut? *</label>
                            <select name="perlu_tindak_lanjut" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                                <option value="1">Ya, perlu tindak lanjut ke Sekretariat & Kadinas</option>
                                <option value="0">Tidak, proses selesai</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-emerald-700">
                            Simpan Hasil Pembinaan
                        </button>
                    </form>
                </div>
            @endif

            <!-- 3. Sekretariat Action: Mengarsipkan Dokumen -->
            @if((Auth::user()->isSekretariat() || Auth::user()->isAdmin()) && $item->status_workflow === 'dilaksanakan')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-purple-50/40">
                    <h3 class="text-sm font-bold text-purple-900 mb-2">Aksi Sekretariat</h3>
                    <p class="text-xs text-purple-700 mb-4">Arsip dokumen kegiatan sebelum diteruskan ke Kepala Dinas.</p>
                    <form action="{{ route('pemberdayaan.kelembagaan.arsip.store', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-purple-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-purple-700">
                            Arsipkan Dokumen Kegiatan
                        </button>
                    </form>
                </div>
            @endif

            <!-- 4. Kepala Dinas Action: Approval/Persetujuan -->
            @if((Auth::user()->isKadinas() || Auth::user()->isAdmin()) && $item->status_workflow === 'diarsipkan_sekretariat')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-emerald-50/40">
                    <h3 class="text-sm font-bold text-emerald-900 mb-2">Persetujuan Kepala Dinas</h3>
                    <form action="{{ route('pemberdayaan.kelembagaan.approval.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Keputusan *</label>
                            <select name="status" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                                <option value="disetujui_kadinas">Setujui Tindak Lanjut</option>
                                <option value="ditolak">Tolak / Dikembalikan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Kepala Dinas</label>
                            <textarea name="catatan_revisi" rows="2" placeholder="Catatan atau arahan tindak lanjut" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-emerald-700">
                            Simpan Keputusan Kepala Dinas
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
