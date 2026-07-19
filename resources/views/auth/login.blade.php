@extends('layouts.app')

@section('title', 'Masuk Akun')

@section('content')
<div class="relative min-h-[calc(100vh-8rem)] flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-12">

    <div class="w-full max-w-md">
        <!-- Brand Header -->
        <div class="text-center mb-8">
            <h2 class="mb-4 text-4xl font-extrabold text-white tracking-tight">SADA SOSIAL</h2>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Selamat Datang Kembali</h2>
            <p class="mt-2 text-sm text-slate-400">Silakan masuk untuk mengakses SADA SOSIAL</p>
        </div>

        <!-- Glassmorphism Login Card -->
        <div class="glass-panel rounded-2xl p-8 glow-emerald shadow-2xl">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-slate-200">Alamat Email</label>
                    <div class="relative">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200"
                            placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-semibold text-slate-200">Kata Sandi</label>
                    </div>
                    <div class="relative">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-xl bg-slate-950 border border-slate-800 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:outline-none transition-all duration-200"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="text-xs text-rose-400 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4.5 w-4.5 rounded border-slate-800 bg-slate-950 text-emerald-500 focus:ring-emerald-500/20 focus:ring-offset-0 focus:outline-none">
                    <label for="remember" class="ml-2.5 block text-sm font-medium text-slate-300 select-none cursor-pointer">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 py-3 text-sm font-bold text-slate-950 shadow-lg shadow-emerald-500/20 hover:opacity-95 hover:scale-[1.01] transition-all duration-200">
                    Masuk Sekarang
                </button>
            </form>
        </div>

        <!-- Seed Credentials Helper Info Box (very helpful for testing!) -->
        <!-- <div class="mt-6 rounded-2xl border border-indigo-500/20 bg-indigo-500/5 p-5 backdrop-blur-md">
            <h4 class="text-xs font-bold text-indigo-300 uppercase tracking-wider mb-3">💡 Akun Uji Coba (Demo Accounts)</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="space-y-1">
                    <span class="font-bold text-slate-200 block">Peran: Administrator</span>
                    <span class="text-slate-400 font-medium block">Email: <code class="text-indigo-200 select-all font-mono">admin@sadasosial.org</code></span>
                    <span class="text-slate-400 font-medium block">Sandi: <code class="text-indigo-200 font-mono">password</code></span>
                </div>
                <div class="space-y-1">
                    <span class="font-bold text-slate-200 block">Peran: User Biasa</span>
                    <span class="text-slate-400 font-medium block">Email: <code class="text-indigo-200 select-all font-mono">siti@sadasosial.org</code></span>
                    <span class="text-slate-400 font-medium block">Sandi: <code class="text-indigo-200 font-mono">password</code></span>
                </div>
            </div>
        </div> -->
        <!-- Register Links -->
        <div class="mt-6 text-center space-y-2">
            <p class="text-sm text-slate-500">
                Belum punya akun?
                <a href="{{ route('register.lembaga') }}" class="font-semibold text-emerald-400 hover:text-emerald-300 transition-colors">
                    Daftar sebagai Lembaga / Instansi
                </a>
            </p>
            <p class="text-xs text-slate-600">
                Atau daftar sebagai
                <a href="{{ route('register.masyarakat') }}" class="text-teal-400 hover:text-teal-300 font-medium transition-colors">Masyarakat Perorangan</a>
            </p>
        </div>
    </div>
</div>
@endsection
