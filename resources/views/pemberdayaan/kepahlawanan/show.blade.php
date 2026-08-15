@extends('layouts.app')

@section('title', 'Detail Pengelolaan Kepahlawanan / TMP - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-5xl sm:px-6 lg:px-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('pemberdayaan.kepahlawanan.index') }}" class="text-sm font-semibold text-amber-600 hover:underline">&larr; Kembali ke Daftar</a>
            <h1 class="text-2xl font-bold text-slate-900 mt-2">{{ $item->nama_tmp_atau_pahlawan }}</h1>
            <p class="text-sm text-slate-500">Jenis Agenda: {{ str_replace('_', ' ', strtoupper($item->jenis_agenda)) }} | Kab/Kota: {{ $item->kab_kota }}</p>
        </div>
        <div>
            <span class="inline-flex items-center rounded-full px-4 py-1.5 text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-800">
                {{ str_replace('_', ' ', strtoupper($item->status_workflow)) }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-amber-50 p-4 border border-amber-200 text-amber-800 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Main Info -->
        <div class="md:col-span-2 space-y-6">
            <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Detail Usulan Agenda Kepahlawanan / TMP</h3>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-xs text-slate-400 block">Pengaju / Pelaksana</span>
                        <span class="font-semibold text-slate-800">{{ $item->user->name ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Lokasi TMP</span>
                        <span class="font-semibold text-slate-800">{{ $item->lokasi_tmp ?? '-' }}</span>
                    </div>
                </div>

                <div>
                    <span class="text-xs text-slate-400 block mb-1">Usulan Kegiatan / Pemeliharaan</span>
                    <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100">{{ $item->usulan_kegiatan }}</p>
                </div>
            </div>

            <!-- SOP Perawatan TMP (14 Steps Tracking Widget) -->
            <div class="glass-panel rounded-2xl p-6 border border-amber-200 bg-amber-50/20 space-y-4">
                <div class="flex items-center justify-between border-b border-amber-200 pb-3">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <span>🏛️</span> Tracking SOP Perawatan Taman Makam Pahlawan (14 Tahapan)
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 10 - 12 Hari Kerja</p>
                    </div>
                    <a href="{{ route('pemberdayaan.kepahlawanan.sop_perawatan_tmp') }}" target="_blank" class="text-xs font-bold text-amber-700 hover:underline">
                        Lihat Panduan Full SOP &rarr;
                    </a>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">1. Penyusunan Jadwal Pemeliharaan</span>
                            <div class="text-[11px] text-slate-500">Koordinator TMP | SLA: 30 Menit</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">2. Distribusi Area Kerja Lapangan</span>
                            <div class="text-[11px] text-slate-500">Koordinator TMP | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">3. Pembersihan Makam, Nisan & Rumput</span>
                            <div class="text-[11px] text-slate-500">Petugas TMP | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">4. Cek Jalan, Drainase, Lampu & Pagar</span>
                            <div class="text-[11px] text-slate-500">Petugas TMP | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">5-6. Deteksi & Logbook Harian</span>
                            <div class="text-[11px] text-slate-500">Petugas TMP | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">7. Klasifikasi Kerusakan Ringan/Berat</span>
                            <div class="text-[11px] text-slate-500">Koordinator TMP | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">8. Perbaikan Langsung Kerusakan Ringan</span>
                            <div class="text-[11px] text-slate-500">Petugas TMP | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">9. Laporan Kerusakan Berat ke Dinsos</span>
                            <div class="text-[11px] text-slate-500">Koordinator TMP | SLA: 30 Menit</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">10. Inspeksi Fasilitas oleh Dinsos Prov</span>
                            <div class="text-[11px] text-slate-500">Bidang Dayasos | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">11. Pengajuan Usul Kebutuhan Anggaran</span>
                            <div class="text-[11px] text-slate-500">Bidang Dayasos | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">12. Perbaikan oleh Tim Teknis/Kontraktor</span>
                            <div class="text-[11px] text-slate-500">Tim Teknis / Kontraktor | SLA: 1 Hari</div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-amber-800">13. Penyusunan Laporan Mingguan/Bulanan</span>
                            <div class="text-[11px] text-slate-500">Koordinator TMP | SLA: 1 Hari</div>
                        </div>
                    </div>
                    <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                        <span class="font-bold text-emerald-800">14. Penyelesaian Periode Pemeliharaan TMP Selesai & Terarsip</span>
                        <span class="text-[11px] text-emerald-700 font-semibold">Bidang Dayasos | SLA: 1 Hari</span>
                    </div>
                </div>
            </div>

            @if(strtolower($item->jenis_agenda) === 'usulan_pahlawan')
                <!-- SOP Pengusulan Gelar CPN (10 Steps Tracking Widget) -->
                <div class="glass-panel rounded-2xl p-6 border border-amber-200 bg-amber-50/20 space-y-4">
                    <div class="flex items-center justify-between border-b border-amber-200 pb-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>🎖️</span> Tracking SOP Pengusulan Gelar CPN (10 Tahapan)
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 5 - 8 Hari Kerja</p>
                        </div>
                        <a href="{{ route('pemberdayaan.kepahlawanan.sop_cpn') }}" target="_blank" class="text-xs font-bold text-amber-700 hover:underline">
                            Lihat Panduan Full SOP &rarr;
                        </a>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">1. Penerimaan Usulan CPN Kab/Kota</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 30 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">2. Mempelajari Dokumen Syarat</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 8 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">3. Rancangan Seminar TP2GD</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 2 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">4. Sidang / Seminar Akademis TP2GD</span>
                                <div class="text-[11px] text-slate-500">TP2GD | SLA: 4 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">5. Laporan Hasil Seminar TP2GD</span>
                                <div class="text-[11px] text-slate-500">TP2GD | SLA: 3 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">6. Draf Rekomendasi Gubernur</span>
                                <div class="text-[11px] text-slate-500">Analis Kebijakan | SLA: 2 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">7. Rekomendasi Gubernur Resmi</span>
                                <div class="text-[11px] text-slate-500">Gubernur | SLA: 1 - 3 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">8. Surat Pengantar usulan Kemensos</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 1 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">9. Pengiriman Usulan CPN ke Kemensos</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 8 Jam</div>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                            <span class="font-bold text-emerald-800">10. Pengarsipan Dokumen CPN Manual & Digital</span>
                            <span class="text-[11px] text-emerald-700 font-semibold">Ketua Tim K2KS | SLA: 5 Jam</span>
                        </div>
                    </div>
                </div>
            @endif

            @if(in_array(strtolower($item->jenis_agenda), ['sidang_tp2gd', 'tp2gd']))
                <!-- SOP Sidang TP2GD (13 Steps Tracking Widget) -->
                <div class="glass-panel rounded-2xl p-6 border border-amber-200 bg-amber-50/20 space-y-4">
                    <div class="flex items-center justify-between border-b border-amber-200 pb-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>⚖️</span> Tracking SOP Sidang TP2GD (13 Tahapan)
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 7 - 10 Hari Kerja</p>
                        </div>
                        <a href="{{ route('pemberdayaan.kepahlawanan.sop_sidang_tp2gd') }}" target="_blank" class="text-xs font-bold text-amber-700 hover:underline">
                            Lihat Panduan Full SOP &rarr;
                        </a>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">1-2. Penelaahan DPA & ROK Sidang</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 2 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">3. Konsultasi KPA / Kabid</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS & Kabid | SLA: 2 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">4. Draf Keputusan Gubernur TP2GD</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 3 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">5. TTD Keputusan Gubernur TP2GD</span>
                                <div class="text-[11px] text-slate-500">Gubernur Sumut | SLA: 1 - 3 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">6. Draf SK Kadinsos Moderator</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 3 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">7. TTD SK Kadinsos Moderator</span>
                                <div class="text-[11px] text-slate-500">Kadinsos Prov | SLA: 1 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">8. Rapat Persiapan Sidang</span>
                                <div class="text-[11px] text-slate-500">Kabid Dayasos | SLA: 3 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">9. Surat Menyurat Persiapan</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 8 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">10. Distribusi Berkas CPN ke TP2GD</span>
                                <div class="text-[11px] text-slate-500">K2KS & TP2GD | SLA: 8 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">11. Pelaksanaan Sidang TP2GD</span>
                                <div class="text-[11px] text-slate-500">TP2GD | SLA: 4 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">12. Berita Acara & Notulen Sidang</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 3 Jam</div>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                            <span class="font-bold text-emerald-800">13. Pengarsipan Dokumen Sidang TP2GD Manual & Digital</span>
                            <span class="text-[11px] text-emerald-700 font-semibold">Ketua Tim K2KS | SLA: 5 Jam</span>
                        </div>
                    </div>
                </div>
            @endif

            @if(in_array(strtolower($item->jenis_agenda), ['perintis_kemerdekaan', 'perintis']))
                <!-- SOP Pengusulan Calon Perintis Kemerdekaan (8 Steps Tracking Widget) -->
                <div class="glass-panel rounded-2xl p-6 border border-amber-200 bg-amber-50/20 space-y-4">
                    <div class="flex items-center justify-between border-b border-amber-200 pb-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>📜</span> Tracking SOP Calon Perintis Kemerdekaan (8 Tahapan)
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 4 - 7 Hari Kerja</p>
                        </div>
                        <a href="{{ route('pemberdayaan.kepahlawanan.sop_perintis_kemerdekaan') }}" target="_blank" class="text-xs font-bold text-amber-700 hover:underline">
                            Lihat Panduan Full SOP &rarr;
                        </a>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">1. Penerimaan Usulan Kab/Kota</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 30 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">2. Mempelajari & Kajian Berkas</span>
                                <div class="text-[11px] text-slate-500">Analis Kebijakan Ahli Muda | SLA: 8 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">3. Surat Permohonan Rekomendasi</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 2 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">4. Draf Rekomendasi Gubernur</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 4 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">5. Rekomendasi Gubernur Resmi TTD</span>
                                <div class="text-[11px] text-slate-500">Gubernur Sumut | SLA: 1 - 3 Hari</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">6. Surat Pengantar Usulan Kemensos</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 1 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">7. Pengiriman Usulan ke Kemensos RI</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 8 Jam</div>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                            <span class="font-bold text-emerald-800">8. Pengarsipan Dokumen Perintis Kemerdekaan Manual & Digital</span>
                            <span class="text-[11px] text-emerald-700 font-semibold">Ketua Tim K2KS | SLA: 5 Jam</span>
                        </div>
                    </div>
                </div>
            @endif

            @if(in_array(strtolower($item->jenis_agenda), ['janda_perintis', 'duda_perintis', 'limpahan_perintis']))
                <!-- SOP Pengusulan Janda / Duda Perintis Kemerdekaan (6 Steps Tracking Widget) -->
                <div class="glass-panel rounded-2xl p-6 border border-amber-200 bg-amber-50/20 space-y-4">
                    <div class="flex items-center justify-between border-b border-amber-200 pb-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>📇</span> Tracking SOP Janda / Duda Perintis (6 Tahapan)
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 3 - 6 Hari Kerja</p>
                        </div>
                        <a href="{{ route('pemberdayaan.kepahlawanan.sop_janda_perintis') }}" target="_blank" class="text-xs font-bold text-amber-700 hover:underline">
                            Lihat Panduan Full SOP &rarr;
                        </a>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">1. Penerimaan Usulan Kab/Kota & Surat Kematian</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 30 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">2. Mempelajari & Kajian Dokumen</span>
                                <div class="text-[11px] text-slate-500">Analis Kebijakan Ahli Muda | SLA: 8 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">3. Draf Rekomendasi Kadinsos</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 2 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">4. TTD Rekomendasi Kadinsos Prov</span>
                                <div class="text-[11px] text-slate-500">Kadinsos Prov Sumut | SLA: 2 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">5. Pengiriman Usulan ke Kemensos RI</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 1 - 3 Hari</div>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                            <span class="font-bold text-emerald-800">6. Pengarsipan Dokumen Janda/Duda Perintis Manual & Digital</span>
                            <span class="text-[11px] text-emerald-700 font-semibold">Ketua Tim K2KS | SLA: 5 Jam</span>
                        </div>
                    </div>
                </div>
            @endif

            @if(in_array(strtolower($item->jenis_agenda), ['pemutakhiran_pkjpk', 'pemutakhiran_data', 'verval_pkjpk']))
                <!-- SOP Pemutakhiran Data PKJPK (5 Steps Tracking Widget) -->
                <div class="glass-panel rounded-2xl p-6 border border-amber-200 bg-amber-50/20 space-y-4">
                    <div class="flex items-center justify-between border-b border-amber-200 pb-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>🔄</span> Tracking SOP Pemutakhiran Data PKJPK (5 Tahapan)
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Mutu Baku SLA Total: 1 Bulan + 2 Hari Kerja</p>
                        </div>
                        <a href="{{ route('pemberdayaan.kepahlawanan.sop_pemutakhiran_pkjpk') }}" target="_blank" class="text-xs font-bold text-amber-700 hover:underline">
                            Lihat Panduan Full SOP &rarr;
                        </a>
                    </div>

                    <div class="space-y-2 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">1. Surat Permohonan Pemutakhiran Kab/Kota</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 30 Menit</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">2. Menyusun Instrumen Verval Data</span>
                                <div class="text-[11px] text-slate-500">Ketua Tim K2KS | SLA: 3 Jam</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">3. Pelaksanaan Verval Lapangan / Berkas</span>
                                <div class="text-[11px] text-slate-500">Pengolah Data | SLA: 1 Bulan</div>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                                <span class="font-bold text-amber-800">4. Input Data & Rekap Laporan Verval</span>
                                <div class="text-[11px] text-slate-500">Pengadministrasi Umum | SLA: 8 Jam</div>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                            <span class="font-bold text-emerald-800">5. Pengarsipan Laporan Hasil Verval PKJPK Manual & Digital</span>
                            <span class="text-[11px] text-emerald-700 font-semibold">Pengadministrasi Umum | SLA: 5 Jam</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Agenda Ditetapkan & Laporan -->
            @if($item->agenda_ditentukan || $item->laporan_hasil)
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Agenda &amp; Laporan Pelaksanaan</h3>
                    
                    @if($item->agenda_ditentukan)
                        <div class="bg-amber-50/50 p-4 rounded-xl border border-amber-100 space-y-2 text-sm">
                            <span class="text-xs font-bold text-amber-800 uppercase tracking-wider block">Agenda Ditetapkan Bidang Pemberdayaan</span>
                            <div><strong>Tanggal Pelaksanaan:</strong> {{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->format('d F Y') }}</div>
                            <div><strong>Rincian Agenda:</strong> {{ $item->agenda_ditentukan }}</div>
                        </div>
                    @endif

                    @if($item->laporan_hasil)
                        <div class="bg-emerald-50/50 p-4 rounded-xl border border-emerald-100 space-y-2 text-sm">
                            <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider block">Laporan Hasil Pelaksanaan / Pemeliharaan</span>
                            <div>{{ $item->laporan_hasil }}</div>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Workflow Action Panel -->
        <div class="space-y-6">
            <!-- Staff: Menyusun Agenda -->
            @if(Auth::user()->isBidangPemberdayaan() && in_array($item->status_workflow, ['diajukan', 'agenda_disusun']))
                <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Form Menyusun Agenda Kegiatan</h3>
                    <form action="{{ route('pemberdayaan.kepahlawanan.agenda.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Pelaksanaan *</label>
                            <input type="date" name="tanggal_pelaksanaan" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Rincian Agenda *</label>
                            <textarea name="agenda_ditentukan" rows="3" required placeholder="Agenda & koordinasi pihak terkait" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-amber-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-amber-700">
                            Tetapkan Agenda
                        </button>
                    </form>
                </div>
            @endif

            <!-- Staff: Laporan Dokumentasi -->
            @if(Auth::user()->isBidangPemberdayaan() && $item->status_workflow === 'agenda_disusun')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Form Input Laporan Pelaksanaan</h3>
                    <form action="{{ route('pemberdayaan.kepahlawanan.laporan.store', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Laporan Hasil *</label>
                            <textarea name="laporan_hasil" rows="3" required placeholder="Uraian hasil pelaksanaan kegiatan/pemeliharaan" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Foto Dokumentasi (Opsional)</label>
                            <input type="file" name="foto_dokumentasi" class="w-full text-xs text-slate-600">
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-emerald-700">
                            Simpan Laporan Hasil
                        </button>
                    </form>
                </div>
            @endif

            <!-- Sekretariat: Arsip -->
            @if((Auth::user()->isSekretariat() || Auth::user()->isAdmin()) && $item->status_workflow === 'laporan_disusun')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-purple-50/40">
                    <h3 class="text-sm font-bold text-purple-900 mb-2">Aksi Sekretariat</h3>
                    <form action="{{ route('pemberdayaan.kepahlawanan.arsip.store', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-purple-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-purple-700">
                            Arsipkan Laporan Kegiatan
                        </button>
                    </form>
                </div>
            @endif

            <!-- Kadinas: Pengesahan -->
            @if((Auth::user()->isKadinas() || Auth::user()->isAdmin()) && $item->status_workflow === 'diarsipkan_sekretariat')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-amber-50/40">
                    <h3 class="text-sm font-bold text-amber-900 mb-2">Pengesahan Kepala Dinas</h3>
                    <form action="{{ route('pemberdayaan.kepahlawanan.approval.store', $item->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Keputusan *</label>
                            <select name="status" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                                <option value="disahkan_kadinas">Sah / Disetujui Kepala Dinas</option>
                                <option value="ditolak">Tolak / Dikembalikan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Pengesahan</label>
                            <textarea name="catatan_revisi" rows="2" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-amber-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-amber-700">
                            Simpan Pengesahan Kadinas
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
