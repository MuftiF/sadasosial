@extends('layouts.app')

@section('title', 'Monitoring Masa Berlaku & Riwayat Dokumen')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">

    <!-- Header Section -->
    <div class="mb-10">
        <a href="{{ route('perizinan.index') }}" class="text-xs font-bold text-emerald-400 hover:underline flex items-center gap-1.5 mb-4">
            &larr; Kembali ke Dashboard Antrean
        </a>
        <h1 class="text-3xl font-extrabold text-white tracking-tight">Monitoring & Masa Berlaku Dokumen</h1>
        <p class="text-sm text-slate-400 mt-1">Pantau seluruh surat keputusan perizinan/rekomendasi sosial aktif, kedaluwarsa, serta riwayat audittrail.</p>
    </div>

    <!-- Statistics Panel -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="glass-panel rounded-2xl p-6 glow-emerald">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Dokumen Aktif & Sah</span>
                <span class="text-emerald-400 text-sm">🟢</span>
            </div>
            <h3 class="text-2xl font-black text-white">{{ $stats['total_active'] }}</h3>
            <p class="text-[10px] text-slate-500 mt-1">Dapat diverifikasi secara online</p>
        </div>
        <div class="glass-panel rounded-2xl p-6 glow-amber">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Akan Berakhir (30 Hari)</span>
                <span class="text-amber-400 text-sm">⚠️</span>
            </div>
            <h3 class="text-2xl font-black text-white">{{ $stats['total_expiring'] }}</h3>
            <p class="text-[10px] text-amber-500 font-semibold mt-1">Perlu pemberitahuan perpanjangan</p>
        </div>
        <div class="glass-panel rounded-2xl p-6 glow-rose">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kedaluwarsa / Mati</span>
                <span class="text-rose-400 text-sm">🔴</span>
            </div>
            <h3 class="text-2xl font-black text-white">{{ $stats['total_expired'] }}</h3>
            <p class="text-[10px] text-slate-500 mt-1">Tindakan perpanjangan/tutup izin</p>
        </div>
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Dokumen Terbit</span>
                <span class="text-slate-400 text-sm">📂</span>
            </div>
            <h3 class="text-2xl font-black text-white">{{ $stats['all_count'] }}</h3>
            <p class="text-[10px] text-slate-500 mt-1">Tercatat di basis data digital</p>
        </div>
    </div>

    <!-- Search Box -->
    <div class="glass-panel rounded-2xl p-4 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form action="" method="GET" class="w-full md:w-1/2 flex items-center gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-emerald-500"
                placeholder="Cari Nomor Izin, Nama Lembaga, atau Pemohon...">
            <button type="submit" class="rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-slate-200 border border-slate-800 hover:bg-slate-800 transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Tables for different status categories -->
    <div class="glass-panel rounded-2xl overflow-hidden mb-12">
        <div class="border-b border-slate-900 bg-slate-900/30 px-6 py-4 flex flex-wrap gap-4 items-center justify-between">
            <h3 class="font-bold text-white text-base">Monitoring Dokumen Perizinan</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-900 text-xs font-bold text-slate-400 uppercase bg-slate-950/40">
                        <th class="px-6 py-4">Nomor Izin</th>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4">Layanan</th>
                        <th class="px-6 py-4">Terbit</th>
                        <th class="px-6 py-4">Kadaluarsa</th>
                        <th class="px-6 py-4">Masa Aktif</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-900">
                    @php
                        $allList = array_merge(
                            array_map(fn($item) => array_merge($item, ['state' => 'active']), $active),
                            array_map(fn($item) => array_merge($item, ['state' => 'expiring']), $expiring),
                            array_map(fn($item) => array_merge($item, ['state' => 'expired']), $expired)
                        );
                    @endphp

                    @forelse($allList as $row)
                        @php
                            $lic = $row['license'];
                            $daysLeft = $row['days_left'];
                            $state = $row['state'];
                        @endphp
                        <tr class="hover:bg-slate-900/20 transition">
                            <td class="px-6 py-4 text-xs font-bold text-white">
                                {{ $lic->nomor_izin }}
                                <div class="text-[10px] text-slate-500 font-medium mt-0.5">Token: {{ substr($lic->qr_code_token, 0, 8) }}...</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-200 text-xs">{{ $lic->pemohon->name }}</div>
                                @if($lic->pemohon->nama_lembaga)
                                    <div class="text-[10px] text-slate-500 mt-0.5 font-medium">{{ $lic->pemohon->nama_lembaga }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-slate-300">
                                @if($lic->jenis_layanan === 'ugb') Undian Berhadiah (UGB)
                                @elseif($lic->jenis_layanan === 'pub') Pengumpulan Sumbangan (PUB)
                                @elseif($lic->jenis_layanan === 'lks') Izin Operasional LKS
                                @elseif($lic->jenis_layanan === 'adopsi') Adopsi Anak
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs font-medium text-slate-400">
                                {{ $lic->tanggal_terbit->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-xs font-medium text-slate-400">
                                @if($lic->jenis_layanan === 'adopsi')
                                    -
                                @else
                                    {{ $lic->tanggal_kadaluarsa->format('d M Y') }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($lic->jenis_layanan === 'adopsi')
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-purple-500/10 text-purple-400 ring-1 ring-purple-500/20">
                                        PERMANEN
                                    </span>
                                @elseif($state === 'expired')
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-rose-500/10 text-rose-400 ring-1 ring-rose-500/20">
                                        MATI ({{ abs($daysLeft) }} Hari)
                                    </span>
                                @elseif($state === 'expiring')
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-amber-500/10 text-amber-400 ring-1 ring-amber-500/20">
                                        {{ $daysLeft }} HARI LAGI
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/20">
                                        AKTIF ({{ $daysLeft }} Hari)
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('perizinan.show', $lic->id) }}" class="rounded-lg bg-slate-900 px-2.5 py-1.5 text-[10px] font-bold text-slate-300 border border-slate-800 hover:bg-slate-800 transition">
                                        Detail
                                    </a>
                                    <a href="{{ route('perizinan.download_pdf', $lic->id) }}" target="_blank" class="rounded-lg bg-slate-900 px-2.5 py-1.5 text-[10px] font-bold text-slate-300 border border-slate-800 hover:bg-slate-800 transition">
                                        Cetak
                                    </a>
                                    @if($state === 'expiring' || $state === 'expired')
                                        <form action="{{ route('admin.perizinan.send_alert', $lic->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="rounded-lg bg-amber-500/10 px-2.5 py-1.5 text-[10px] font-bold text-amber-400 border border-amber-500/20 hover:bg-amber-500/20 transition">
                                                🚨 Pengingat
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-xs text-slate-400">Belum ada dokumen perizinan resmi yang terbit / masa monitoring.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Audittrail logs for Stage 8 licensing review -->
    <div class="glass-panel rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-900 bg-slate-900/30 flex justify-between items-center">
            <h3 class="font-bold text-white text-base">Riwayat Audit (Audit Trail Proses Tahap 8)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-900 text-xs font-bold text-slate-400 uppercase bg-slate-950/40">
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Petugas / Operator</th>
                        <th class="px-6 py-4">Nama Pemohon</th>
                        <th class="px-6 py-4">Tindakan Keputusan</th>
                        <th class="px-6 py-4">Rincian Informasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-900 text-xs">
                    @forelse($auditLogs as $log)
                        <tr class="hover:bg-slate-900/20 transition">
                            <td class="px-6 py-4 text-slate-400 font-medium">
                                {{ $log->created_at->format('d M Y H:i:s') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-white">{{ $log->admin->name }}</div>
                                <div class="text-[10px] text-slate-500 mt-0.5">{{ ucfirst($log->admin->role) }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                {{ $log->targetUser->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-bold bg-indigo-500/10 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">
                                    {{ strtoupper($log->action) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-400 font-medium leading-relaxed max-w-sm">
                                {{ $log->details }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-xs text-slate-400">Belum ada riwayat audit trail ulasan perizinan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
