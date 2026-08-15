@extends('layouts.app')

@section('title', 'SOP Bansos Gizi Anak Panti Swasta')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('rehabilitasi.subproses.index', 'anak') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-3">
            &larr; Kembali ke Layanan Anak
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Penyaluran Bansos Penambahan Gizi Anak</h1>
        <p class="text-sm text-slate-500 mt-1">Panduan alur mutu baku bansos penambahan gizi anak panti swasta se-Sumatera Utara (SLA: 33 Hari).</p>
    </div>

    <!-- Overview Timeline Widgets -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Visual 10 Steps Timeline -->
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-panel rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-6 flex items-center gap-2">
                    <span>📋</span> Alur Tahapan SOP Resmi (10 Langkah)
                </h3>
                
                <div class="space-y-6 relative border-l-2 border-slate-200 ml-3 pl-6">
                    <!-- Step 1 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">1</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Up Date &amp; Pengusulan LKSA Terpilih (7 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Dinsos Kab/Kota mengusulkan data LKSA terpilih yang berkasnya lengkap &amp; memenuhi syarat.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">2</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Pemberkasan Pengajuan (2 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Staf Pengolah Data memproses berkas pengajuan sesuai kelengkapan persyaratan.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">3</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Penginputan Data Penerima (2 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Staf Pengevaluasi menginput data ke daftar penerima bansos LKSA Sumatera Utara.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">4</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Verifikasi Kelayakan (1 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Pekerja Sosial &amp; Kabid Rehsos memverifikasi syarat kelembagaan panti swasta.</p>
                    </div>

                    <!-- Step 5 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">5</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Pengajuan Proposal Bansos (2 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Lembaga LKSA mengajukan proposal formal dilengkapi izin operasional, Kemenkumham, akta, domisili, dan RAB.</p>
                    </div>

                    <!-- Step 6 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">6</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Rekomendasi Dinas (1 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Dinsos Kab/Kota mengeluarkan surat rekomendasi persetujuan penerimaan bansos.</p>
                    </div>

                    <!-- Step 7 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">7</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Penyusunan Draf SK Gubernur (15 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Kepala Dinas menyusun dan mengajukan draf keputusan Gubernur Sumatera Utara.</p>
                    </div>

                    <!-- Step 8 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">8</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Penerbitan SK Gubernur (1 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Penetapan resmi daftar nama lembaga panti swasta penerima bantuan oleh Gubernur.</p>
                    </div>

                    <!-- Step 9 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">9</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Penyaluran &amp; Penyerahan BAST (1 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Penyaluran bansos didampingi Dinsos Kab/Kota serta penandatanganan Berita Acara Serah Terima.</p>
                    </div>

                    <!-- Step 10 -->
                    <div class="relative">
                        <span class="absolute -left-[35px] top-0 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-extrabold text-white">10</span>
                        <h4 class="text-xs font-extrabold text-slate-900">Arsip &amp; Pertanggungjawaban (1 Hari)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Arsip berkas BST, proposal, dan foto dokumentasi oleh Kepala Bidang Rehsos.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: SLA Details & Quick Info -->
        <div class="space-y-6">
            <div class="glass-panel rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4">Informasi SLA Mutu Baku</h3>
                <div class="space-y-3 text-xs">
                    <div class="flex justify-between">
                        <span class="text-slate-400 font-bold">Total Waktu Alur</span>
                        <span class="text-slate-900 font-extrabold text-sm">33 Hari Kerja</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400 font-bold">Kategori Sasaran</span>
                        <span class="text-slate-900 font-bold">LKSA / Panti Swasta</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400 font-bold">Jenis Bantuan</span>
                        <span class="text-slate-900 font-bold">Penambahan Gizi Anak</span>
                    </div>
                </div>
            </div>

            <div class="glass-panel rounded-2xl p-6 shadow-sm bg-slate-50/50">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Persyaratan LKSA (Step 5)</h3>
                <ul class="text-[11px] text-slate-600 space-y-2 list-disc pl-4 font-medium">
                    <li>Izin Operasional Aktif</li>
                    <li>Akta Notaris &amp; Kemenkumham</li>
                    <li>Surat Keterangan Domisili</li>
                    <li>Rencana Anggaran Biaya (RAB)</li>
                    <li>Jumlah Warga Binaan Sosial (WBS)</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Detailed Mutu Baku Table -->
    <div class="space-y-6 mt-10">
        <h3 class="text-lg font-bold text-slate-900 border-b border-slate-200 pb-2">Tabel Rincian Mutu Baku SOP</h3>
        <div class="glass-panel rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="p-4 font-bold text-slate-600 w-12">No</th>
                            <th class="p-4 font-bold text-slate-600">Kegiatan</th>
                            <th class="p-4 font-bold text-slate-600">Pelaksana</th>
                            <th class="p-4 font-bold text-slate-600">Kelengkapan</th>
                            <th class="p-4 font-bold text-slate-600 w-24">Waktu</th>
                            <th class="p-4 font-bold text-slate-600">Output</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        <tr>
                            <td class="p-4 text-slate-400">1</td>
                            <td class="p-4">Up date data LKSA dan pengusulan LKSA terpilih</td>
                            <td class="p-4">Dinsos Kab/Kota</td>
                            <td class="p-4">Berkas data</td>
                            <td class="p-4 font-bold">7 Hari</td>
                            <td class="p-4">Penerimaan berkas data lengkap</td>
                        </tr>
                        <tr>
                            <td class="p-4 text-slate-400">2</td>
                            <td class="p-4">Pengolahan data penerima bansos terpilih</td>
                            <td class="p-4">Staf Pengolah Data</td>
                            <td class="p-4">Berkas pengajuan sesuai persyaratan</td>
                            <td class="p-4 font-bold">2 Hari</td>
                            <td class="p-4">Tersedianya data penerima bansos</td>
                        </tr>
                        <tr>
                            <td class="p-4 text-slate-400">3</td>
                            <td class="p-4">Penginputan LKSA ke sistem</td>
                            <td class="p-4">Staf Pengevaluasi</td>
                            <td class="p-4">Berkas pendirian LKSA</td>
                            <td class="p-4 font-bold">2 Hari</td>
                            <td class="p-4">Daftar penerima bansos</td>
                        </tr>
                        <tr>
                            <td class="p-4 text-slate-400">4</td>
                            <td class="p-4">Verifikasi data LKSA dan kelayakan</td>
                            <td class="p-4">Pekerja Sosial &amp; Kabid Rehsos</td>
                            <td class="p-4">Berkas pendirian LKSA</td>
                            <td class="p-4 font-bold">1 Hari</td>
                            <td class="p-4">Daftar LKSA memenuhi syarat</td>
                        </tr>
                        <tr>
                            <td class="p-4 text-slate-400">5</td>
                            <td class="p-4">Pengajuan proposal bansos &amp; RAB</td>
                            <td class="p-4">LKSA</td>
                            <td class="p-4">Dokumen legalitas lembaga &amp; RAB</td>
                            <td class="p-4 font-bold">2 Hari</td>
                            <td class="p-4">Daftar usulan proposal masuk</td>
                        </tr>
                        <tr>
                            <td class="p-4 text-slate-400">6</td>
                            <td class="p-4">Penerbitan Rekomendasi penerima bansos</td>
                            <td class="p-4">Dinsos Kab/Kota</td>
                            <td class="p-4">Berkas proposal lengkap</td>
                            <td class="p-4 font-bold">1 Hari</td>
                            <td class="p-4">Rekomendasi Dinsos Kab/Kota</td>
                        </tr>
                        <tr>
                            <td class="p-4 text-slate-400">7</td>
                            <td class="p-4">Penyusunan dan pengusulan draf SK Gubernur</td>
                            <td class="p-4">Kepala Dinas</td>
                            <td class="p-4">Daftar penerima bansos disetujui</td>
                            <td class="p-4 font-bold">15 Hari</td>
                            <td class="p-4">Draf usulan SK Gubernur</td>
                        </tr>
                        <tr>
                            <td class="p-4 text-slate-400">8</td>
                            <td class="p-4">Penerbitan SK Gubernur penerima bansos</td>
                            <td class="p-4">LKSA &amp; Kepala Dinas</td>
                            <td class="p-4">Draf SK Gubernur</td>
                            <td class="p-4 font-bold">1 Hari</td>
                            <td class="p-4">SK Gubernur penerima bansos</td>
                        </tr>
                        <tr>
                            <td class="p-4 text-slate-400">9</td>
                            <td class="p-4">Penyaluran Bantuan Sosial &amp; Penandatanganan BAST</td>
                            <td class="p-4">LKSA &amp; Kepala Dinas</td>
                            <td class="p-4">BST, proposal LKSA, dokumentasi</td>
                            <td class="p-4 font-bold">1 Hari</td>
                            <td class="p-4">Bansos tersalurkan sesuai daftar</td>
                        </tr>
                        <tr>
                            <td class="p-4 text-slate-400">10</td>
                            <td class="p-4">Pengarsipan dokumen BST &amp; Dokumentasi</td>
                            <td class="p-4">Kepala Bidang Rehsos</td>
                            <td class="p-4">BST LKSA, Proposal, Foto kegiatan</td>
                            <td class="p-4 font-bold">1 Hari</td>
                            <td class="p-4">Dokumen pertanggungjawaban terarsip</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
