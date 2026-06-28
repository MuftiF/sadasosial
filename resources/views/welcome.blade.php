@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="relative isolate overflow-hidden min-h-[calc(100vh-4rem)] flex flex-col justify-center">
    <!-- Background Ambient Lights -->
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-1155/678 w-[36rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-emerald-500 to-teal-400 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72rem]"></div>
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-20 sm:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            <!-- Hero Left: Content -->
            <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white leading-tight">
                    <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">SADA SOSIAL</span>
                </h1>
                <p class="text-lg text-slate-400 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    SADA SOSIAL ( Sistem Aplikasi Digital Administrasi Layanan Sosial Terpadu Dinas Sosial Provinsi Sumatera Utara ) adalah platform untuk memfasilitasi kegiatan administrasi di Dinas Sosial Provinsi Sumatera Utara seperti 
                </p>
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-3.5 text-base font-bold text-slate-950 shadow-lg shadow-emerald-500/25 hover:scale-[1.02] hover:opacity-90 transition duration-200">
                            Masuk Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-6 py-3.5 text-base font-bold text-slate-950 shadow-lg shadow-emerald-500/25 hover:scale-[1.02] hover:opacity-90 transition duration-200">
                            Masuk
                        </a>
                        <a href="#tentang-kami" class="rounded-xl bg-slate-900 px-6 py-3.5 text-base font-semibold text-slate-200 ring-1 ring-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                            Pelajari Selengkapnya
                        </a>
                    @endauth
                </div>

                <!-- Stats Overview -->
                <!-- <div class="grid grid-cols-3 gap-6 pt-8 border-t border-slate-900 max-w-lg mx-auto lg:mx-0">
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-white">Rp 148M+</p>
                        <p class="text-xs text-slate-400 mt-1 uppercase font-medium">Donasi Tersalurkan</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-white">340+</p>
                        <p class="text-xs text-slate-400 mt-1 uppercase font-medium">Relawan Aktif</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-white">12k+</p>
                        <p class="text-xs text-slate-400 mt-1 uppercase font-medium">Jiwa Terbantu</p>
                    </div>
                </div> -->
            </div>

            <!-- Hero Right: Premium Mockup/Illustration -->
            <!-- <div class="lg:col-span-5 relative w-full max-w-md mx-auto">
                <div class="absolute -inset-1 rounded-2xl bg-gradient-to-tr from-emerald-500 to-indigo-500 opacity-20 blur-xl"></div>
                <div class="relative glass-panel rounded-2xl p-6 sm:p-8 glow-emerald">
                    <div class="flex items-center justify-between border-b border-slate-800 pb-4 mb-6">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-400 font-bold">
                                📊
                            </span>
                            <div>
                                <h3 class="text-sm font-bold text-white">Laporan Kebaikan</h3>
                                <p class="text-[10px] text-slate-400 font-medium">Pembaruan Hari Ini</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-emerald-400/10 px-2.5 py-0.5 text-xs font-semibold text-emerald-400 ring-1 ring-inset ring-emerald-400/20">
                            Aktif
                        </span>
                    </div> -->

                    <!-- Progress bar visualization -->
                    <!-- <div class="space-y-4">
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-medium">
                                <span class="text-slate-300">Target Kampanye Kemanusiaan</span>
                                <span class="text-emerald-400">84%</span>
                            </div>
                            <div class="h-2 w-full rounded-full bg-slate-900 overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full" style="width: 84%"></div>
                            </div>
                        </div> -->

                        <!-- Mini activity list -->
                        <!-- <div class="space-y-3 pt-4 border-t border-slate-800/60">
                            <p class="text-xs font-bold text-slate-200">Aktivitas Terbaru</p>
                            <div class="flex items-center justify-between text-[11px]">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    <span class="text-slate-300 font-semibold">Siti Aminah</span>
                                    <span class="text-slate-400">berdonasi</span>
                                </div>
                                <span class="text-emerald-400 font-bold">Rp 250.000</span>
                            </div>
                            <div class="flex items-center justify-between text-[11px]">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    <span class="text-slate-300 font-semibold">Ahmad H.</span>
                                    <span class="text-slate-400">berdonasi</span>
                                </div>
                                <span class="text-emerald-400 font-bold">Rp 100.000</span>
                            </div>
                            <div class="flex items-center justify-between text-[11px]">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    <span class="text-slate-300 font-semibold">Budi Santoso</span>
                                    <span class="text-slate-400">berdonasi</span>
                                </div>
                                <span class="text-emerald-400 font-bold">Rp 1.000.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </div>

    <!-- Background Ambient Lights Bottom -->
    <div class="absolute inset-x-0 top-[calc(100vh-20rem)] -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-1155/678 w-[36rem] -translate-x-1/2 bg-gradient-to-tr from-indigo-500 to-emerald-500 opacity-10 sm:left-[calc(50%+36rem)] sm:w-[72rem]"></div>
    </div>
</div>
@endsection
