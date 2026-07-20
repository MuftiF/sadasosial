@extends('layouts.app')

@section('title', 'Daftar Antrean Verifikasi Petugas')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">


    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-indigo-500/10 text-indigo-400 ring-1 ring-indigo-500/20 mb-2">
                HAK AKSES INTERNAL / PETUGAS
            </span>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Antrean Verifikasi Perizinan</h1>
            <p class="text-sm text-slate-400 mt-1">
                Anda masuk sebagai 
                <strong>
                    @if($user->role === 'sekretariat') Sekretariat / Operator
                    @elseif($user->role === 'verifikator') Verifikator Administrasi
                    @elseif($user->role === 'dinsos_wilayah') Dinsos Kab/Kota (Wilayah)
                    @elseif($user->role === 'bidang_pemberdayaan') Bidang Pemberdayaan Sosial
                    @elseif($user->role === 'bidang_linjamsos') Bidang Perlindungan & Jaminan Sosial
                    @elseif($user->role === 'kadinas') Kepala Dinas / Pejabat Berwenang
                    @elseif($user->role === 'admin') Super Administrator (Melihat Semua Antrean)
                    @endif
                </strong>.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.perizinan.monitoring') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-slate-200 border border-slate-800 hover:bg-slate-800 transition">
                📊 Panel Monitoring & Masa Berlaku
            </a>
        </div>
    </div>

    @if(($user->isBidangPemberdayaan() || $user->isAdmin()) && isset($reportQueues) && count($reportQueues) > 0)
        <!-- UGB Report Queue Table -->
        <div class="glass-panel rounded-2xl overflow-hidden mb-10 border-indigo-500/20 bg-slate-950/20 glow-indigo">
            <div class="px-6 py-4 border-b border-slate-900 bg-slate-900/30 flex justify-between items-center">
                <h3 class="font-bold text-white text-base flex items-center gap-2">
                    <span>📤</span> Antrean Laporan Pelaksanaan UGB ({{ count($reportQueues) }})
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-900 text-xs font-bold text-slate-400 uppercase bg-slate-950/40">
                            <th class="px-6 py-4">Tanggal Pengiriman</th>
                            <th class="px-6 py-4">Penyelenggara Undian</th>
                            <th class="px-6 py-4">Nomor Izin UGB</th>
                            <th class="px-6 py-4">Status Laporan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-900 text-xs text-slate-350">
                        @foreach($reportQueues as $rq)
                            <tr class="hover:bg-slate-900/20 transition">
                                <td class="px-6 py-4 text-slate-400 font-medium">
                                    {{ $rq->laporan_submitted_at ? $rq->laporan_submitted_at->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white text-sm">{{ $rq->pemohon->name }}</div>
                                    @if($rq->pemohon->nama_lembaga)
                                        <div class="text-[10px] text-slate-500 mt-0.5 font-medium">{{ $rq->pemohon->nama_lembaga }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-300">
                                    {{ $rq->nomor_izin }}
                                    <div class="text-[10px] text-slate-500 mt-0.5">ID: #{{ $rq->id }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/20">
                                        BUTUH VERIFIKASI LAPORAN
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('perizinan.show', $rq->id) }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600/15 border border-emerald-500/25 px-4 py-2 text-xs font-bold text-emerald-400 hover:bg-emerald-600 hover:text-white transition">
                                        🔑 Ulas Laporan UGB
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Queue Table -->
    <div class="glass-panel rounded-2xl overflow-hidden mb-10">
        <div class="px-6 py-4 border-b border-slate-900 bg-slate-900/30 flex justify-between items-center">
            <h3 class="font-bold text-white text-base">Antrean Butuh Ulasan Anda ({{ count($queues) }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-900 text-xs font-bold text-slate-400 uppercase bg-slate-950/40">
                        <th class="px-6 py-4">Tanggal Pengajuan</th>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4">Jenis Layanan</th>
                        <th class="px-6 py-4">Tahapan Terakhir</th>
                        <th class="px-6 py-4">Status Alur</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-900">
                    @forelse($queues as $q)
                        <tr class="hover:bg-slate-900/20 transition">
                            <td class="px-6 py-4 text-xs font-medium text-slate-400">
                                {{ $q->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-white text-sm">{{ $q->pemohon->name }}</div>
                                @if($q->pemohon->nama_lembaga)
                                    <div class="text-[10px] text-slate-500 mt-0.5 font-medium">{{ $q->pemohon->nama_lembaga }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-slate-300">
                                @if($q->jenis_layanan === 'ugb') Undian Gratis Berhadiah (UGB)
                                @elseif($q->jenis_layanan === 'pub') Pengumpulan Uang/Barang (PUB)
                                @elseif($q->jenis_layanan === 'lks') Izin Operasional LKS
                                @elseif($q->jenis_layanan === 'adopsi') Rekomendasi Adopsi Anak
                                @endif
                                <div class="text-[10px] text-slate-500 mt-0.5">ID: #{{ $q->id }}</div>
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-slate-200">
                                @if($q->tahap_verifikasi === 'sekretariat') Pemeriksaan Awal
                                @elseif($q->tahap_verifikasi === 'verifikator') Verifikasi Legalitas
                                @elseif($q->tahap_verifikasi === 'dinsos_wilayah') Konfirmasi Wilayah
                                @elseif($q->tahap_verifikasi === 'bidang_teknis') Telaah Bidang Teknis
                                @elseif($q->tahap_verifikasi === 'kepala_dinas') Persetujuan Kepala Dinas
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-blue-500/10 text-blue-400 ring-1 ring-blue-500/20">
                                    MENUNGGU ULASAN
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('perizinan.show', $q->id) }}" class="inline-flex items-center justify-center rounded-lg bg-indigo-600/15 border border-indigo-500/25 px-4 py-2 text-xs font-bold text-indigo-400 hover:bg-indigo-600 hover:text-white transition">
                                    🔑 Ulas & Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-xs text-slate-400">
                                Antrean Anda saat ini kosong. Semua permohonan telah selesai diproses.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- If Super Administrator, show complete system log of all perizinans -->
    @if($user->isAdmin() && isset($allApplications))
        <div class="glass-panel rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-900 bg-slate-900/30 flex justify-between items-center">
                <h3 class="font-bold text-white text-base">Seluruh Transaksi Perizinan Sistem (Mode Admin Super)</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-900 text-xs font-bold text-slate-400 uppercase bg-slate-950/40">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Pemohon</th>
                            <th class="px-6 py-4">Jenis Layanan</th>
                            <th class="px-6 py-4">Nomor Izin</th>
                            <th class="px-6 py-4">Tahapan</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-900 text-xs text-slate-300">
                        @foreach($allApplications as $app)
                            <tr class="hover:bg-slate-900/10 transition">
                                <td class="px-6 py-4 text-slate-500 font-semibold">#{{ $app->id }}</td>
                                <td class="px-6 py-4 font-bold text-white">{{ $app->pemohon->name }}</td>
                                <td class="px-6 py-4 font-medium">{{ strtoupper($app->jenis_layanan) }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-400">{{ $app->nomor_izin ?? '-' }}</td>
                                <td class="px-6 py-4 font-medium uppercase">{{ $app->tahap_verifikasi }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold {{ $app->status === 'ditolak' ? 'bg-rose-500/10 text-rose-400 ring-1 ring-rose-500/20' : ($app->status === 'selesai' ? 'bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/20' : 'bg-blue-500/10 text-blue-400 ring-1 ring-blue-500/20') }}">
                                        {{ strtoupper($app->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('perizinan.show', $app->id) }}" class="rounded-lg bg-slate-900 px-3 py-1.5 text-xs font-bold text-slate-300 border border-slate-800 hover:bg-slate-800 transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>
@endsection
