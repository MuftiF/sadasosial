@extends('layouts.app')

@section('title', 'SOP Monitoring Dokumen - SADA SOSIAL')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.perizinan.monitoring') }}" class="text-xs font-bold text-emerald-600 hover:underline flex items-center gap-1.5 mb-3">
            &larr; Kembali ke Halaman Monitoring
        </a>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 mb-2">
                    SOP Resmi - Monitoring &amp; Riwayat (Bidang Dayasos/Sekretariat)
                </span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">SOP Monitoring Masa Berlaku &amp; Riwayat Dokumen</h1>
                <p class="text-sm text-slate-500 mt-1">
                    Standar Operasional Prosedur peninjauan masa aktif surat keputusan perizinan, pengiriman alert pengingat kedaluwarsa, pencatatan log audit (audit trail), serta pelaporan dashboard pimpinan.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.perizinan.monitoring') }}" class="rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-md hover:bg-emerald-700 transition">
                    Lihat Monitoring Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Summary Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Total Langkah Alur Prosedur</span>
            <span class="text-2xl font-black text-slate-900 mt-1 block">8 Langkah Prosedur</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Aktor Terlibat</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">Sistem, Sekretariat, Bidang Teknis, Pemohon, Pimpinan</span>
        </div>
        <div class="glass-panel p-5 rounded-2xl border border-slate-200 bg-white">
            <span class="text-xs text-slate-400 block font-medium">Status Dokumen Dipantau</span>
            <span class="text-2xl font-black text-emerald-600 mt-1 block">Aktif, Berakhir, Kedaluwarsa, Ditolak, Dicabut, Direvisi</span>
        </div>
    </div>

    <!-- Visual Flowchart Cards (8 Steps Timeline) -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white mb-10 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-600 text-white text-sm">📊</span>
            Visual Diagram Alur Monitoring Dokumen (8 Tahapan)
        </h2>

        <div class="relative border-l-2 border-emerald-200 ml-4 sm:ml-6 space-y-6 pl-6 sm:pl-8 py-2">
            
            <!-- Step 1 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    1
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Sistem / Aplikasi
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pemantauan Masa Berlaku secara Berkala</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Aplikasi secara otomatis memindai database dokumen perizinan dan rekomendasi yang terbit secara real-time untuk memantau status keaktifannya.
                    </p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    2
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Sistem / Aplikasi
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Mengidentifikasi Status Dokumen</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Sistem mengklasifikasikan dokumen ke dalam beberapa kategori status:
                    </p>
                    <ul class="list-disc pl-5 text-xs text-slate-505 space-y-1 font-normal">
                        <li><span class="text-emerald-600 font-bold">Aktif</span>: Dokumen masih berlaku sah.</li>
                        <li><span class="text-amber-500 font-bold">Mendekati Kedaluwarsa</span>: Kurang dari 30 hari masa aktif.</li>
                        <li><span class="text-rose-500 font-bold">Kedaluwarsa / Mati</span>: Melewati tanggal batas berlaku.</li>
                        <li><span class="text-red-600 font-bold">Ditolak / Dicabut / Direvisi</span>: Dokumen tidak berlaku karena regulasi.</li>
                    </ul>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    3
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Sekretariat
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Menelaah Daftar Status Dokumen</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Petugas Sekretariat memeriksa dashboard monitoring secara harian untuk memetakan instansi/LKS yang membutuhkan atensi khusus atau pengiriman pengingat perpanjangan.
                    </p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    4
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Sekretariat
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Mengarsipkan Perubahan &amp; Riwayat Dokumen (Audit Trail)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Setiap kali ada tindakan perubahan status dokumen (seperti perpanjangan, pencabutan, atau pengiriman alert), sistem mencatat peristiwa tersebut di log audit trail secara permanen.
                    </p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    5
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Bidang Teknis (Dayasos/Linjamsos/Rehsos)
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Menelaah Dokumen yang Memerlukan Tindak Lanjut</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Petugas Bidang Teknis menganalisis apakah dokumen yang akan berakhir masa berlakunya memerlukan penanganan tindak lanjut (seperti evaluasi ulang kelayakan LKS).
                    </p>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    6
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Bidang Teknis &amp; Pemohon
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pengambilan Keputusan Tindak Lanjut</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Petugas melakukan pengambilan keputusan berbasis hasil telaah:
                    </p>
                    <div class="p-3 bg-white rounded-xl border border-slate-200 text-xs font-normal">
                        <span class="font-bold text-amber-600 uppercase tracking-wide block mb-1">Keputusan Tindak Lanjut:</span>
                        <ul class="list-none space-y-2.5">
                            <li>
                                <span class="text-emerald-600 font-bold">✔️ Perlu Tindak Lanjut (Ya):</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Pemohon menerima notifikasi status dokumen via email/sistem. Pemohon kemudian menyiapkan berkas perpanjangan/tindak lanjut yang diperlukan.</p>
                            </li>
                            <li>
                                <span class="text-slate-600 font-bold">✖️ Tidak Perlu Tindak Lanjut:</span>
                                <p class="text-[11px] text-slate-500 mt-0.5">Dokumen tetap dipantau secara pasif di dalam sistem tanpa pengiriman notifikasi/alert khusus.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Step 7 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    7
                </div>
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-emerald-300 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                            Sistem / Aplikasi
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Pembaruan Riwayat &amp; Rekap Status</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">
                        Sistem memperbarui rekapitulasi status secara dinamis pada database, dan menampilkan log perubahan secara kronologis pada tabel monitoring.
                    </p>
                </div>
            </div>

            <!-- Step 8 -->
            <div class="relative group">
                <div class="absolute -left-[37px] sm:-left-[45px] top-0 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-xs ring-4 ring-white">
                    8
                </div>
                <div class="bg-emerald-50/70 p-5 rounded-2xl border border-emerald-200 hover:border-emerald-400 transition space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md border border-emerald-200">
                            Kepala Dinas / Pimpinan
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Dashboard Pimpinan untuk Pengawasan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal font-medium">
                        Kepala Dinas atau pimpinan menerima ringkasan monitoring dokumen, grafik masa berlaku, dan log audit untuk kebutuhan pengawasan berkala dan pengambilan keputusan strategis.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Aspek Deskripsi Prosedur -->
    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-slate-200 bg-white shadow-sm overflow-hidden">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Detail Aspek Monitoring Dokumen</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 border-b border-slate-200">
                        <th class="p-3 font-bold border-r border-slate-200 w-1/4">Aspek</th>
                        <th class="p-3 font-bold border-r border-slate-200 w-1/2">Penjelasan</th>
                        <th class="p-3 font-bold">Aktor / Kontrol</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700 font-medium">
                    <tr>
                        <td class="p-3 font-bold border-r border-slate-200 bg-slate-50/50">Mulai (Start)</td>
                        <td class="p-3 border-r border-slate-200 text-slate-600 font-normal">
                            Kebutuhan pemantauan keaktifan dokumen perizinan/rekomendasi sosial teridentifikasi.
                        </td>
                        <td class="p-3 text-slate-600">Sekretariat / Bidang Teknis</td>
                    </tr>
                    <tr>
                        <td class="p-3 font-bold border-r border-slate-200 bg-slate-50/50">Aktivitas Inti</td>
                        <td class="p-3 border-r border-slate-200 text-slate-600 font-normal">
                            Dokumen terbit dipantau $\rightarrow$ Masa berlaku dihitung oleh sistem $\rightarrow$ Pengiriman alert notifikasi $\rightarrow$ Riwayat disimpan di audit trail $\rightarrow$ Laporan tersedia.
                        </td>
                        <td class="p-3 text-slate-600">Pemohon, Kepala Bidang, Kepala Dinas, Sistem</td>
                    </tr>
                    <tr>
                        <td class="p-3 font-bold border-r border-slate-200 bg-slate-50/50">Titik Keputusan (Decision Point)</td>
                        <td class="p-3 border-r border-slate-200 text-slate-600 font-normal">
                            Tahap telaah dan evaluasi kelayakan perpanjangan dokumen izin. Pelaksana tidak boleh merangkap semua peran (*Separation of Duties*).
                        </td>
                        <td class="p-3 text-slate-600">Analis / Bidang Teknis</td>
                    </tr>
                    <tr>
                        <td class="p-3 font-bold border-r border-slate-200 bg-slate-50/50">Selesai (End)</td>
                        <td class="p-3 border-r border-slate-200 text-slate-600 font-normal">
                            Daftar dokumen aktif, kedaluwarsa, dicabut, atau direvisi berhasil tersimpan dan termonitor di dashboard pimpinan secara teratur.
                        </td>
                        <td class="p-3 text-slate-600">Sistem SADA SOSIAL</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
