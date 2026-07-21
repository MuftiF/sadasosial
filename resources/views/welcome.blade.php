@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="relative overflow-hidden">
    <!-- Background Glow Effects -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-emerald-500/5 blur-[120px] pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/3 w-[300px] h-[300px] rounded-full bg-indigo-500/5 blur-[100px] pointer-events-none"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 lg:py-32 relative">
        
        <!-- Hero Section -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-bold text-emerald-400 ring-1 ring-inset ring-emerald-500/20 mb-6">
                <x-heroicon-o-sparkles class="w-5 h-5 inline-block mr-1" /> Selamat Datang di Sada Sosial
            </span>
            <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-none mb-6">
                Portal Layanan &amp; <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Perizinan Sosial</span> Terpadu
            </h1>
            <p class="text-base sm:text-lg text-slate-400 leading-relaxed mb-10">
                Ajukan permohonan perizinan sosial secara mandiri, verifikasi legalitas lembaga Anda secara online, dan pantau seluruh proses persetujuan secara real-time dan transparan.
            </p>
            
            <div class="flex flex-wrap justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-emerald-500/20 hover:opacity-95 hover:scale-[1.01] transition-all duration-200">
                        Masuk ke Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-emerald-500/20 hover:opacity-95 hover:scale-[1.01] transition-all duration-200">
                        Masuk ke Akun
                    </a>
                    <a href="#pilih-pendaftaran" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-slate-300 ring-1 ring-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                        Daftar Akun Baru
                    </a>
                @endauth
            </div>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
            <!-- Feature 1 -->
            <div class="glass-panel rounded-2xl p-6 hover:border-slate-800 transition duration-200">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400 text-lg mb-4"><x-heroicon-o-document-text class="w-4 h-4 inline-block mr-1" /></span>
                <h3 class="text-lg font-bold text-white mb-2">Pengajuan Online</h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Unggah dokumen persyaratan dan isi formulir permohonan langsung dari rumah tanpa perlu mengantre di kantor dinas.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="glass-panel rounded-2xl p-6 hover:border-slate-800 transition duration-200">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-500/10 text-teal-400 text-lg mb-4"><x-heroicon-o-shield-check class="w-5 h-5 inline-block mr-1" /></span>
                <h3 class="text-lg font-bold text-white mb-2">Validasi Terintegrasi</h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Validasi data identitas perorangan (NIK/KK) dan data legalitas hukum organisasi sosial secara aman dan akurat.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="glass-panel rounded-2xl p-6 hover:border-slate-800 transition duration-200">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-400 text-lg mb-4"><x-heroicon-o-clock class="w-5 h-5 inline-block mr-1" /></span>
                <h3 class="text-lg font-bold text-white mb-2">Pantau Real-Time</h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Dapatkan transparansi penuh dengan notifikasi progres dan catatan perbaikan langsung dari tim verifikator dinas.
                </p>
            </div>
        </div>

        @guest
        <!-- Registration Cards Section -->
        <div id="pilih-pendaftaran" class="scroll-mt-24">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Mulai Pendaftaran Akun</h2>
                <p class="text-sm text-slate-400 mt-2">Pilih tipe akun yang sesuai dengan kebutuhan layanan Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Card 1: Masyarakat -->
                <div class="glass-panel rounded-2xl p-8 hover:border-slate-800 transition duration-200 flex flex-col justify-between glow-indigo border-indigo-500/10">
                    <div>
                        <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-sky-400/10 text-sky-400 ring-1 ring-inset ring-sky-400/20 mb-4">
                            Masyarakat Perorangan
                        </span>
                        <h3 class="text-xl font-bold text-white mb-3">Akun Perorangan</h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-6">
                            Gunakan akun ini untuk mengajukan perizinan sosial individu. Memerlukan verifikasi data kependudukan berupa NIK dan Nomor KK.
                        </p>
                    </div>
                    <a href="{{ route('register.masyarakat') }}" class="w-full inline-flex items-center justify-center rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white shadow-md hover:bg-indigo-500 hover:scale-[1.01] transition-all duration-200 text-center">
                        Daftar Akun Masyarakat &rarr;
                    </a>
                </div>

                <!-- Card 2: Lembaga -->
                <div class="glass-panel rounded-2xl p-8 hover:border-slate-800 transition duration-200 flex flex-col justify-between glow-emerald border-emerald-500/10">
                    <div>
                        <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-bold bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20 mb-4">
                            Lembaga / Perusahaan / Instansi
                        </span>
                        <h3 class="text-xl font-bold text-white mb-3">Akun Organisasi</h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-6">
                            Gunakan akun ini untuk mendaftarkan LKS, perusahaan, atau instansi sosial. Memerlukan dokumen legalitas resmi seperti NPWP &amp; Akta.
                        </p>
                    </div>
                    <a href="{{ route('register.lembaga') }}" class="w-full inline-flex items-center justify-center rounded-xl bg-emerald-600 py-3 text-sm font-bold text-white shadow-md hover:bg-emerald-500 hover:scale-[1.01] transition-all duration-200 text-center">
                        Daftar Akun Lembaga &rarr;
                    </a>
                </div>
            </div>
        </div>
        @endguest

    </div>
</div>
@endsection
