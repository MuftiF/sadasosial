@extends('layouts.app')

@section('title', 'Dashboard Bidang Pemberdayaan')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">



    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-emerald-500/10 text-emerald-600 ring-1 ring-emerald-500/20 mb-2">
                PETUGAS / BIDANG PEMBERDAYAAN SOSIAL
            </span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Antrean Bidang Pemberdayaan</h1>
            <p class="text-sm text-slate-500 mt-1">Mengurus telaah substansi perizinan UGB, PUB, LKS, serta memverifikasi laporan pelaksanaan UGB.</p>
        </div>
    </div>

    <!-- UGB Report Queue Table -->
    @if(isset($reportQueues) && count($reportQueues) > 0)
        <div class="glass-panel rounded-2xl overflow-hidden mb-10 border-indigo-500/20 bg-slate-950/20 glow-indigo">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-base flex items-center gap-2">
                    <span>📤</span> Antrean Laporan Pelaksanaan UGB ({{ count($reportQueues) }})
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs font-bold text-slate-500 uppercase bg-slate-50">
                            <th class="px-6 py-4">Tanggal Pengiriman</th>
                            <th class="px-6 py-4">Penyelenggara Undian</th>
                            <th class="px-6 py-4">Nomor Izin UGB</th>
                            <th class="px-6 py-4">Status Laporan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                        @foreach($reportQueues as $rq)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-slate-500 font-medium">
                                    {{ $rq->laporan_submitted_at ? $rq->laporan_submitted_at->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 text-sm">{{ $rq->pemohon->name }}</div>
                                    @if($rq->pemohon->nama_lembaga)
                                        <div class="text-[10px] text-slate-500 mt-0.5 font-medium">{{ $rq->pemohon->nama_lembaga }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ $rq->nomor_izin }}
                                    <div class="text-[10px] text-slate-400 mt-0.5">ID: #{{ $rq->id }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-blue-500/10 text-blue-600 ring-1 ring-blue-500/20">
                                        BUTUH VERIFIKASI LAPORAN
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('perizinan.show', $rq->id) }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600/15 border border-emerald-500/25 px-4 py-2 text-xs font-bold text-emerald-600 hover:bg-emerald-600 hover:text-white transition">
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
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-base">Antrean Telaah Teknis UGB, PUB &amp; LKS ({{ count($queues) }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 text-xs font-bold text-slate-500 uppercase bg-slate-50">
                        <th class="px-6 py-4">Tanggal Pengajuan</th>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4">Jenis Layanan</th>
                        <th class="px-6 py-4">Status Alur</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($queues as $q)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-xs font-medium text-slate-500">
                                {{ $q->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900 text-sm">{{ $q->pemohon->name }}</div>
                                @if($q->pemohon->nama_lembaga)
                                    <div class="text-[10px] text-slate-500 mt-0.5 font-medium">{{ $q->pemohon->nama_lembaga }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-slate-700">
                                @if($q->jenis_layanan === 'ugb') Undian Gratis Berhadiah (UGB)
                                @elseif($q->jenis_layanan === 'pub') Pengumpulan Uang/Barang (PUB)
                                @elseif($q->jenis_layanan === 'lks') Izin Operasional LKS
                                @endif
                                <div class="text-[10px] text-slate-400 mt-0.5">ID: #{{ $q->id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-blue-500/10 text-blue-600 ring-1 ring-blue-500/20">
                                    MENUNGGU REKOMENDASI TEKNIS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('perizinan.show', $q->id) }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600/15 border border-emerald-500/25 px-4 py-2 text-xs font-bold text-emerald-600 hover:bg-emerald-600 hover:text-white transition">
                                    🔑 Ulas &amp; Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-xs text-slate-400">
                                Antrean kosong. Semua rekomendasi teknis Bidang Pemberdayaan telah selesai diproses.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
