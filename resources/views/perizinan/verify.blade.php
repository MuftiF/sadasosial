@extends('layouts.app')

@section('title', 'Verifikasi Keaslian Dokumen - Sada Sosial')

@section('content')
<div class="mx-auto max-w-xl px-4 py-16 flex items-center justify-center min-h-[70vh]">
    <div class="w-full">
        @if($perizinan)
            <!-- ================== DOKUMEN VALID ================== -->
            <div class="glass-panel rounded-3xl p-8 glow-emerald text-center space-y-6">
                
                <div class="flex justify-center">
                    <span class="flex h-16 w-16 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-400 text-3xl ring-8 ring-emerald-500/5">
                        <x-heroicon-o-shield-check class="w-5 h-5 inline-block mr-1" />
                    </span>
                </div>

                <div class="space-y-1.5">
                    <span class="inline-flex items-center rounded-full bg-emerald-400/10 px-3 py-1 text-xs font-bold text-emerald-400 ring-1 ring-inset ring-emerald-400/20">
                        DOKUMEN VALID & TERCATAT RESMI
                    </span>
                    <h2 class="text-xl font-black text-white mt-4">{{ $perizinan->nomor_izin }}</h2>
                </div>

                <div class="border-y border-slate-900 py-6 text-left space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <span class="text-[10px] text-slate-500 uppercase tracking-wider font-bold block">Jenis Layanan</span>
                            <span class="text-xs font-semibold text-slate-200">{{ $jenisLabels[$perizinan->jenis_layanan] }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-500 uppercase tracking-wider font-bold block">Pemohon / Lembaga</span>
                            <span class="text-xs font-semibold text-slate-200">
                                {{ $perizinan->pemohon->name }} 
                                @if($perizinan->pemohon->nama_lembaga) ({{ $perizinan->pemohon->nama_lembaga }}) @endif
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-500 uppercase tracking-wider font-bold block">Tanggal Terbit</span>
                            <span class="text-xs font-semibold text-slate-200">{{ $perizinan->tanggal_terbit->format('d F Y') }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-500 uppercase tracking-wider font-bold block">Hingga Tanggal</span>
                            <span class="text-xs font-semibold text-slate-200">
                                @if($perizinan->jenis_layanan === 'adopsi')
                                    Selamanya (Permanen)
                                @else
                                    {{ $perizinan->tanggal_kadaluarsa->format('d F Y') }}
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    @php
                        $daysLeft = now()->diffInDays($perizinan->tanggal_kadaluarsa, false);
                        $isExpired = $daysLeft < 0;
                    @endphp

                    <div class="p-3.5 rounded-xl border {{ $isExpired ? 'border-rose-500/20 bg-rose-500/5 text-rose-400' : 'border-emerald-500/20 bg-emerald-500/5 text-emerald-400' }} text-center">
                        <span class="text-xs font-bold">
                            @if($perizinan->jenis_layanan === 'adopsi')
                                STATUS: DOKUMEN AKTIF PERMANEN
                            @elseif($isExpired)
                                STATUS: KEDALUWARSA / SUDAH TIDAK BERLAKU
                            @else
                                STATUS: DOKUMEN AKTIF (Sisa {{ $daysLeft }} Hari Masa Berlaku)
                            @endif
                        </span>
                    </div>
                </div>

                <p class="text-[10px] text-slate-500 leading-relaxed">
                    Sistem verifikasi dinilai sah secara digital menggunakan tanda tangan elektronik yang diakui Dinas Sosial Pemerintah Provinsi Sumatera Utara.
                </p>

                <div class="pt-2">
                    <a href="{{ route('perizinan.download_pdf', $perizinan->id) }}" target="_blank" class="inline-block text-xs font-bold text-emerald-400 hover:underline">
                        Lihat/Cetak Surat Keputusan Rekomendasi Resmi &rarr;
                    </a>
                </div>
            </div>
        @else
            <!-- ================== DOKUMEN TIDAK VALID ================== -->
            <div class="glass-panel rounded-3xl p-8 glow-rose border-rose-500/20 text-center space-y-6">
                
                <div class="flex justify-center">
                    <span class="flex h-16 w-16 items-center justify-center rounded-full bg-rose-500/10 text-rose-400 text-3xl ring-8 ring-rose-500/5">
                        <x-heroicon-o-x-circle class="w-4 h-4 inline-block mr-1" />
                    </span>
                </div>

                <div class="space-y-1.5">
                    <span class="inline-flex items-center rounded-full bg-rose-400/10 px-3 py-1 text-xs font-bold text-rose-400 ring-1 ring-inset ring-rose-400/20">
                        VERIFIKASI GAGAL / TIDAK DITEMUKAN
                    </span>
                    <h2 class="text-base font-bold text-slate-300 mt-4 leading-relaxed">Dokumen perizinan dengan kode keamanan ini tidak terdaftar atau telah dicabut secara resmi.</h2>
                </div>

                <div class="p-4 rounded-xl bg-slate-950 border border-slate-900 text-xs text-slate-400 leading-relaxed">
                    Mohon pastikan nomor dokumen yang dimasukkan sesuai atau pastikan tautan QR Code yang dipindai menunjuk ke domain resmi <strong>sadasosial.org</strong>.
                </div>

                <div class="pt-4">
                    <a href="{{ route('welcome') }}" class="rounded-xl bg-slate-900 px-5 py-2.5 text-xs font-bold text-slate-300 border border-slate-800 hover:bg-slate-800 transition">
                        Kembali ke Halaman Utama
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
