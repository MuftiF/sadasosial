@extends('layouts.app')

@section('title', 'Akun Menunggu Verifikasi')

@section('content')
<div class="mx-auto max-w-2xl px-4 py-16 sm:py-24 lg:px-8 flex flex-col items-center">
    <div class="glass-panel rounded-3xl p-8 sm:p-12 text-center glow-indigo w-full border border-indigo-500/20">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-400 text-3xl mb-6">
            <x-heroicon-o-clock class="w-5 h-5 inline-block mr-1" />
        </div>
        
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-4">Pendaftaran Sedang Ditinjau</h1>
        
        <p class="text-sm text-slate-300 leading-relaxed max-w-md mx-auto mb-8">
            Halo, <strong class="text-white">{{ Auth::user()->name }}</strong>. Pendaftaran akun Anda (tipe: <strong class="text-white">{{ ucfirst(Auth::user()->account_type) }}</strong>) telah kami terima dan saat ini sedang menunggu verifikasi oleh Verifikator Administrasi.
        </p>

        <div class="p-4 rounded-xl bg-slate-900/60 border border-slate-800 text-left max-w-md mx-auto mb-8 space-y-2">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wide">Detail Pengajuan:</h3>
            <div class="grid grid-cols-3 text-xs gap-y-1">
                <span class="text-slate-500">Nama:</span>
                <span class="col-span-2 text-slate-300">{{ Auth::user()->name }}</span>

                @if(Auth::user()->isLembaga())
                    <span class="text-slate-500">Lembaga:</span>
                    <span class="col-span-2 text-slate-300">{{ Auth::user()->nama_lembaga }}</span>
                    <span class="text-slate-500">NPWP:</span>
                    <span class="col-span-2 text-slate-300 font-mono">{{ Auth::user()->npwp }}</span>
                @else
                    <span class="text-slate-500">NIK:</span>
                    <span class="col-span-2 text-slate-300 font-mono">{{ Auth::user()->nik }}</span>
                @endif

                <span class="text-slate-500">Tanggal:</span>
                <span class="col-span-2 text-slate-300">{{ Auth::user()->created_at->format('d F Y, H:i') }}</span>
            </div>
        </div>

        <p class="text-xs text-slate-500 mb-8">
            Kami akan mengirimkan notifikasi apabila akun Anda telah aktif dan disetujui. Silakan cek berkala atau hubungi administrator untuk info lebih lanjut.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4 border-t border-slate-900 pt-6">
            <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-slate-300 ring-1 ring-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                    Keluar Aplikasi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
