<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50 text-slate-900 selection:bg-emerald-500 selection:text-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sada Sosial') </title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind / Vite -->
    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }
        .text-white {
            color: #0f172a !important;
        }
        .text-slate-100, .text-slate-200, .text-slate-300, .text-slate-350 {
            color: #1e293b !important;
        }
        .text-slate-400, .text-slate-500 {
            color: #475569 !important;
        }
        .bg-slate-950, .bg-slate-950\/40, .bg-slate-950\/60, .bg-slate-900, .bg-slate-900\/30, .bg-slate-900\/40 {
            background-color: #f1f5f9 !important;
        }
        .border-slate-800, .border-slate-900 {
            border-color: #e2e8f0 !important;
        }
        .glass-panel {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
            color: #1e293b !important;
        }
        .glow-emerald {
            box-shadow: 0 10px 30px -5px rgba(16, 185, 129, 0.08) !important;
        }
        .glow-indigo {
            box-shadow: 0 10px 30px -5px rgba(99, 102, 241, 0.08) !important;
        }
        /* Nav bar colors override */
        header {
            background-color: rgba(255, 255, 255, 0.9) !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        header a, header button, header span {
            color: #1e293b !important;
        }
        header a:hover {
            color: #10b981 !important;
        }
        /* Input & select elements light theme override */
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="file"], select, textarea {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            color: #0f172a !important;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #10b981 !important;
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.1) !important;
        }
        /* Tables light theme override */
        table thead {
            background-color: #f1f5f9 !important;
        }
        table thead th {
            color: #475569 !important;
        }
        table tbody tr:hover {
            background-color: #f8fafc !important;
        }
        table td {
            color: #1e293b !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        /* Footer light theme override */
        footer {
            background-color: #ffffff !important;
            border-top: 1px solid #e2e8f0 !important;
            color: #64748b !important;
        }
    </style>
    @yield('styles')
</head>
<body class="h-full flex flex-col font-sans antialiased overflow-x-hidden">

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 w-full border-b border-slate-800 bg-slate-950/80 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center gap-2.5 group">
                        <div class="flex flex-col">
                            <span class="text-2xl font-bold tracking-tight text-white group-hover:text-emerald-400 transition-colors">SADA SOSIAL</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium transition-colors {{ Route::is('dashboard') ? 'text-emerald-400' : 'text-slate-300 hover:text-white' }}">Dashboard</a>
                        
                        <a href="{{ route('perizinan.index') }}" class="text-sm font-medium transition-colors {{ Request::is('perizinan*') || Request::is('admin/perizinan*') ? 'text-emerald-400' : 'text-slate-300 hover:text-white' }}">Layanan Perizinan</a>
                        
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.users.index') }}" class="text-sm font-medium transition-colors {{ Route::is('admin.users.*') ? 'text-emerald-400' : 'text-slate-300 hover:text-white' }}">User Management</a>
                        @endif
                        
                        <a href="{{ route('profile.edit') }}" class="text-sm font-medium transition-colors {{ Route::is('profile.*') ? 'text-emerald-400' : 'text-slate-300 hover:text-white' }}">Profil</a>
                    @endauth
                </nav>

                <!-- Auth Buttons / User Profile -->
                <div class="flex items-center gap-4">
                    @auth
                        <div class="hidden sm:flex flex-col text-right">
                            <span class="text-xs font-semibold text-white">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] text-slate-400">
                                <span class="inline-flex items-center rounded-md px-1.5 py-0.5 text-xs font-medium {{ Auth::user()->isAdmin() ? 'bg-indigo-400/10 text-indigo-400 ring-1 ring-inset ring-indigo-400/20' : 'bg-emerald-400/10 text-emerald-400 ring-1 ring-inset ring-emerald-400/20' }}">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-3.5 py-2 text-sm font-semibold text-slate-200 ring-1 ring-slate-800 hover:bg-slate-800 hover:text-white transition duration-200">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 px-4 py-2 text-sm font-bold text-slate-950 shadow-md shadow-emerald-500/20 hover:opacity-90 hover:scale-[1.02] transition-all duration-200">
                            Masuk
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button type="button" onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-900 bg-slate-950 px-4 py-3 space-y-2">
            <a href="{{ route('welcome') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ Route::is('welcome') ? 'bg-emerald-500/10 text-emerald-400' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">Home</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ Route::is('dashboard') ? 'bg-emerald-500/10 text-emerald-400' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">Dashboard</a>
                <a href="{{ route('perizinan.index') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ Request::is('perizinan*') || Request::is('admin/perizinan*') ? 'bg-emerald-500/10 text-emerald-400' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">Layanan Perizinan</a>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ Route::is('admin.users.*') ? 'bg-emerald-500/10 text-emerald-400' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">User Management</a>
                @endif
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ Route::is('profile.*') ? 'bg-emerald-500/10 text-emerald-400' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">Profil</a>
            @endauth
        </div>
    </header>

    <!-- Success & Error Toast Alerts -->
    @if(session('success') || session('error'))
    <div class="fixed top-20 right-4 z-50 max-w-sm w-full animate-fade-in">
        @if(session('success'))
            <div class="flex items-center gap-3 rounded-xl border border-emerald-500/30 bg-slate-900/90 p-4 text-emerald-400 shadow-xl backdrop-blur-md">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="text-sm font-medium">{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="flex items-center gap-3 rounded-xl border border-rose-500/30 bg-slate-900/90 p-4 text-rose-400 shadow-xl backdrop-blur-md">
                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                <div class="text-sm font-medium">{{ session('error') }}</div>
            </div>
        @endif
    </div>
    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.animate-fade-in');
            alerts.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                el.style.transition = 'all 0.5s ease';
                setTimeout(() => el.remove(), 500);
            });
        }, 4000);
    </script>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto border-t border-slate-900 bg-slate-950 py-8 text-center text-xs text-slate-500">
        <div class="mx-auto max-w-7xl px-4">
            <p>&copy; {{ date('Y') }} SADA SOSIAL</p>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
    @yield('scripts')
</body>
</html>
