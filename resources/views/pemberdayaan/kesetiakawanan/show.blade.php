@extends('layouts.app')

@section('title', 'Detail Kegiatan Kesetiakawanan - SADA SOSIAL')

@section('content')
<div class="py-8 px-4 mx-auto max-w-5xl sm:px-6 lg:px-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('pemberdayaan.kesetiakawanan.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">&larr; Kembali ke Daftar</a>
            <h1 class="text-2xl font-bold text-slate-900 mt-2">{{ $item->judul_kegiatan }}</h1>
            <p class="text-sm text-slate-500">Jenis: {{ str_replace('_', ' ', strtoupper($item->jenis_kegiatan)) }} | Pelaksanaan: {{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->format('d F Y') }}</p>
        </div>
        <div>
            <span class="inline-flex items-center rounded-full px-4 py-1.5 text-xs font-bold uppercase tracking-wider bg-indigo-100 text-indigo-800">
                {{ str_replace('_', ' ', strtoupper($item->status_workflow)) }}
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl bg-indigo-50 p-4 border border-indigo-200 text-indigo-800 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Detail Info & Daftar Peserta -->
        <div class="md:col-span-2 space-y-6">
            <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Informasi Rencana Kegiatan</h3>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-xs text-slate-400 block">Tema Acara</span>
                        <span class="font-semibold text-slate-800">{{ $item->tema ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Lokasi &amp; Kab/Kota</span>
                        <span class="font-semibold text-slate-800">{{ $item->lokasi }}, {{ $item->kab_kota }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Target Peserta</span>
                        <span class="font-semibold text-slate-800">{{ $item->target_peserta }} Orang</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Narasumber</span>
                        <span class="font-semibold text-slate-800">{{ $item->narasumber ?? '-' }}</span>
                    </div>
                </div>

                @if($item->deskripsi_kegiatan)
                    <div>
                        <span class="text-xs text-slate-400 block mb-1">Deskripsi Kegiatan</span>
                        <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded-xl border border-slate-100">{{ $item->deskripsi_kegiatan }}</p>
                    </div>
                @endif
            </div>

            <!-- List Peserta Terdaftar -->
            <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                    <h3 class="text-base font-bold text-slate-900">Daftar Peserta Terdaftar ({{ $item->pesertas->count() }})</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-700">
                        <thead class="bg-slate-50 font-semibold text-slate-500 uppercase">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama Peserta</th>
                                <th class="px-4 py-2">Instansi / Unsur</th>
                                <th class="px-4 py-2">Kontak</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($item->pesertas as $idx => $p)
                                <tr>
                                    <td class="px-4 py-2 font-medium">{{ $idx + 1 }}</td>
                                    <td class="px-4 py-2 font-bold text-slate-900">{{ $p->nama_peserta }}</td>
                                    <td class="px-4 py-2">{{ $p->instansi_unsur ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $p->kontak ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-slate-400">Belum ada peserta yang mendaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Laporan & Foto Dokumentasi -->
            @if($item->laporan_kegiatan)
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 space-y-4">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Laporan &amp; Dokumentasi Pelaksanaan</h3>
                    <p class="text-sm text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-100">{{ $item->laporan_kegiatan }}</p>
                </div>
            @endif
        </div>

        <!-- Workflow / Actions Sidebar -->
        <div class="space-y-6">
            <!-- Form Pendaftaran Peserta (Masyarakat / Publik / Unsur) -->
            <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-indigo-50/30">
                <h3 class="text-sm font-bold text-indigo-900 mb-2">Form Pendaftaran Peserta</h3>
                <p class="text-xs text-indigo-700 mb-4">Daftarkan diri Anda / perwakilan instansi untuk mengikuti kegiatan ini.</p>
                <form action="{{ route('pemberdayaan.kesetiakawanan.daftar', $item->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Peserta *</label>
                        <input type="text" name="nama_peserta" value="{{ Auth::check() ? Auth::user()->name : '' }}" required class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Instansi / Unsur Masyarakat</label>
                        <input type="text" name="instansi_unsur" placeholder="Contoh: Orsos Medan / Pemuda Sumut" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Kontak / No. HP</label>
                        <input type="text" name="kontak" placeholder="08xxxxxxxxxx" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm">
                    </div>
                    <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-indigo-700">
                        Konfirmasi Kehadiran
                    </button>
                </form>
            </div>

            <!-- Staff: Input Laporan Kegiatan & Foto -->
            @if(Auth::user()->isBidangPemberdayaan())
                <div class="glass-panel rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-sm font-bold text-slate-900 mb-3">Form Input Laporan &amp; Dokumentasi</h3>
                    <form action="{{ route('pemberdayaan.kesetiakawanan.laporan.store', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Laporan Hasil Kegiatan *</label>
                            <textarea name="laporan_kegiatan" rows="3" required placeholder="Uraian jalannya acara &amp; hasil" class="w-full rounded-xl p-2.5 border border-slate-300 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Foto Dokumentasi (Opsional)</label>
                            <input type="file" name="foto_dokumentasi" class="w-full text-xs text-slate-600">
                        </div>
                        <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-emerald-700">
                            Simpan Laporan Kegiatan
                        </button>
                    </form>
                </div>
            @endif

            <!-- Sekretariat: Arsip -->
            @if((Auth::user()->isSekretariat() || Auth::user()->isAdmin()) && $item->status_workflow === 'laporan_disusun')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-purple-50/40">
                    <h3 class="text-sm font-bold text-purple-900 mb-2">Aksi Sekretariat</h3>
                    <form action="{{ route('pemberdayaan.kesetiakawanan.arsip.store', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-purple-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-purple-700">
                            Arsipkan Laporan Kegiatan
                        </button>
                    </form>
                </div>
            @endif

            <!-- Kadinas: Pengesahan -->
            @if((Auth::user()->isKadinas() || Auth::user()->isAdmin()) && $item->status_workflow === 'diarsipkan_sekretariat')
                <div class="glass-panel rounded-2xl p-6 border border-slate-200 bg-indigo-50/40">
                    <h3 class="text-sm font-bold text-indigo-900 mb-2">Pengesahan Kepala Dinas</h3>
                    <form action="{{ route('pemberdayaan.kesetiakawanan.approval.store', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-indigo-700">
                            Mengesahkan Laporan Kegiatan
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
