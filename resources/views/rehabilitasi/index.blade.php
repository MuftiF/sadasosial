@extends('layouts.app')

@section('title', 'Rehabilitasi Sosial (PB 3)')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Portal Rehabilitasi Sosial</h1>
            <p class="text-sm text-slate-500 mt-1">Sistem Terpadu Pelayanan, Rujukan, dan Monitoring Rehabilitasi Sosial.</p>
        </div>
        <div>
            <a href="{{ route('rehabilitasi.monitoring') }}" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2.5 text-xs font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-90 transition duration-200">
                📋 Monitoring Rujukan (3.7)
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="glass-panel rounded-2xl p-6 glow-emerald">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Kasus Terdaftar</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-600 text-sm">📁</span>
            </div>
            <h2 class="text-2xl font-black text-slate-900">{{ $stats['total'] }}</h2>
            <p class="text-[11px] text-slate-500 mt-2">Seluruh kasus rehab terintegrasi</p>
        </div>
        
        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rujukan Aktif UPTD/Mitra</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/10 text-blue-600 text-sm">🏨</span>
            </div>
            <h2 class="text-2xl font-black text-slate-900">{{ $stats['rujukan_aktif'] }}</h2>
            <p class="text-[11px] text-blue-600 font-semibold mt-2">Sedang mendapatkan rehabilitasi</p>
        </div>

        <div class="glass-panel rounded-2xl p-6">
            <div class="flex justify-between items-start mb-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori Program</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-600 text-sm">💡</span>
            </div>
            <h2 class="text-2xl font-black text-slate-900">6 Kategori</h2>
            <p class="text-[11px] text-slate-500 mt-2">Anak, Lansia, Disabilitas, Tuna, Korban, NAPZA</p>
        </div>
    </div>

    <!-- 6 Sub-processes Categories -->
    <h3 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-200 pb-2">Program Layanan Rehabilitasi Sosial</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <!-- 3.1 Rehab Anak -->
        <div class="glass-panel rounded-2xl p-6 hover:border-slate-400 hover:scale-[1.01] transition-all duration-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 text-lg font-extrabold">👶</span>
                    <h4 class="text-sm font-extrabold text-slate-900">3.1 Rehabilitasi Anak</h4>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">Pendaftaran, verifikasi, asesmen kebutuhan gizi, dan rujukan panti anak swasta/LKS Anak.</p>
            </div>
            <div class="flex items-center justify-between mt-auto">
                <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-bold">{{ $stats['anak'] }} Kasus</span>
                <div class="flex gap-2">
                    <a href="{{ route('rehabilitasi.sop.gizi_anak') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-600 underline">SOP Gizi</a>
                    <a href="{{ route('rehabilitasi.subproses.index', 'anak') }}" class="text-xs font-bold text-emerald-600 hover:underline">Kasus &rarr;</a>
                </div>
            </div>
        </div>

        <!-- 3.2 Rehab Lansia -->
        <div class="glass-panel rounded-2xl p-6 hover:border-slate-400 hover:scale-[1.01] transition-all duration-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 text-lg font-extrabold">👵</span>
                    <h4 class="text-sm font-extrabold text-slate-900">3.2 Lanjut Usia (Lansia)</h4>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">Pemberian bantuan sembako LKS LU Swasta, rujukan panti lansia, serta pemantauan wilayah.</p>
            </div>
            <div class="flex items-center justify-between mt-auto">
                <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-bold">{{ $stats['lansia'] }} Kasus</span>
                <div class="flex gap-2">
                    <a href="{{ route('rehabilitasi.sop.lansia') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-600 underline">SOP Lansia</a>
                    <a href="{{ route('rehabilitasi.subproses.index', 'lansia') }}" class="text-xs font-bold text-emerald-600 hover:underline">Kasus &rarr;</a>
                </div>
            </div>
        </div>

        <!-- 3.3 Rehab Disabilitas -->
        <div class="glass-panel rounded-2xl p-6 hover:border-slate-400 hover:scale-[1.01] transition-all duration-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 text-lg font-extrabold">♿</span>
                    <h4 class="text-sm font-extrabold text-slate-900">3.3 Penyandang Disabilitas</h4>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">Rekomendasi penyaluran alat bantu fisik (kursi roda, kruk), terapi, dan program rehabilitasi mandiri.</p>
            </div>
            <div class="flex items-center justify-between mt-auto">
                <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-bold">{{ $stats['disabilitas'] }} Kasus</span>
                <div class="flex gap-2">
                    <a href="{{ route('rehabilitasi.sop.disabilitas') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-600 underline">SOP Disabilitas</a>
                    <a href="{{ route('rehabilitasi.subproses.index', 'disabilitas') }}" class="text-xs font-bold text-emerald-600 hover:underline">Kasus &rarr;</a>
                </div>
            </div>
        </div>

        <!-- 3.4 Tuna Sosial -->
        <div class="glass-panel rounded-2xl p-6 hover:border-slate-400 hover:scale-[1.01] transition-all duration-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-700 text-lg font-extrabold">🤝</span>
                    <h4 class="text-sm font-extrabold text-slate-900">3.4 Tuna &amp; Warga Rentan</h4>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">Penanganan, asesmen, pemulangan orang terlantar, dan penampungan sementara LKS terkait.</p>
            </div>
            <div class="flex items-center justify-between mt-auto">
                <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-bold">{{ $stats['tuna_sosial'] ?? 0 }} Kasus</span>
                <div class="flex gap-2">
                    <a href="{{ route('rehabilitasi.sop.tuna_sosial') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-600 underline">SOP Pemulangan OT</a>
                    <a href="{{ route('rehabilitasi.subproses.index', 'tuna_sosial') }}" class="text-xs font-bold text-emerald-600 hover:underline">Kasus &rarr;</a>
                </div>
            </div>
        </div>

        <!-- 3.5 Korban Kekerasan -->
        <div class="glass-panel rounded-2xl p-6 hover:border-slate-400 hover:scale-[1.01] transition-all duration-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-700 text-lg font-extrabold">🛡️</span>
                    <h4 class="text-sm font-extrabold text-slate-900">3.5 Korban Kekerasan &amp; TPPO</h4>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">Layanan perlindungan darurat, pendampingan hukum/medis, pemulangan, dan pemulihan trauma.</p>
            </div>
            <div class="flex items-center justify-between mt-auto">
                <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-bold">{{ $stats['kekerasan'] }} Kasus</span>
                <div class="flex gap-2">
                    <a href="{{ route('rehabilitasi.sop.kekerasan_tppo') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-600 underline">SOP Kekerasan &amp; TPPO</a>
                    <a href="{{ route('rehabilitasi.subproses.index', 'kekerasan') }}" class="text-xs font-bold text-emerald-600 hover:underline">Kasus &rarr;</a>
                </div>
            </div>
        </div>

        <!-- 3.6 NAPZA / ODHA -->
        <div class="glass-panel rounded-2xl p-6 hover:border-slate-400 hover:scale-[1.01] transition-all duration-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100 text-purple-700 text-lg font-extrabold">💊</span>
                    <h4 class="text-sm font-extrabold text-slate-900">3.6 Korban NAPZA &amp; ODHA</h4>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">Rehabilitasi medis/sosial, pemulihan mental, serta penyusunan rekomendasi layanan terpadu.</p>
            </div>
            <div class="flex items-center justify-between mt-auto">
                <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-bold">{{ $stats['napza'] }} Kasus</span>
                <div class="flex gap-2">
                    <a href="{{ route('rehabilitasi.subproses.index', 'napza') }}" class="text-xs font-bold text-emerald-600 hover:underline">Kasus &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Cases Table -->
    <div class="space-y-6">
        <h3 class="text-lg font-bold text-slate-900 border-b border-slate-200 pb-2">Daftar Kasus Terbaru</h3>
        <div class="glass-panel rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-xs">
                    <thead>
                        <tr>
                            <th class="p-4 font-bold text-slate-600">ID</th>
                            <th class="p-4 font-bold text-slate-600">Nama Klien</th>
                            <th class="p-4 font-bold text-slate-600">NIK</th>
                            <th class="p-4 font-bold text-slate-600">Program / Kategori</th>
                            <th class="p-4 font-bold text-slate-600">Kabupaten / Kota</th>
                            <th class="p-4 font-bold text-slate-600">Tanggal Pengajuan</th>
                            <th class="p-4 font-bold text-slate-600">Status Workflow</th>
                            <th class="p-4 font-bold text-slate-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($recentCases as $case)
                            <tr>
                                <td class="p-4 text-slate-500">#{{ $case->id }}</td>
                                <td class="p-4 text-slate-900 font-bold">{{ $case->nama_klien }}</td>
                                <td class="p-4 text-slate-600">{{ $case->nik }}</td>
                                <td class="p-4 text-slate-900">{{ $case->kategori_label }}</td>
                                <td class="p-4 text-slate-600">{{ $case->kab_kota }}</td>
                                <td class="p-4 text-slate-600">{{ $case->created_at->format('d M Y') }}</td>
                                <td class="p-4">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 font-bold uppercase text-[9px] 
                                        @if($case->status_workflow === 'diajukan') bg-slate-100 text-slate-600 ring-1 ring-inset ring-slate-200
                                        @elseif($case->status_workflow === 'selesai') bg-emerald-100 text-emerald-800 ring-1 ring-inset ring-emerald-200
                                        @elseif(str_contains($case->status_workflow, 'ditolak')) bg-rose-100 text-rose-800 ring-1 ring-inset ring-rose-200
                                        @else bg-blue-100 text-blue-800 ring-1 ring-inset ring-blue-200
                                        @endif">
                                        {{ str_replace('_', ' ', $case->status_workflow) }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('rehabilitasi.show', $case->id) }}" class="text-emerald-600 hover:text-emerald-800 font-bold">Lihat Detail &rarr;</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-slate-500">Belum ada data kasus rehabilitasi sosial yang didaftarkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
