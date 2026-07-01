<!DOCTYPE html>
<html lang="id" class="scroll-smooth h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi ChampVault — UAS Rekayasa Web">
    <title>@yield('title', 'ChampVault')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    <style>
        /* ===== Custom Animations ===== */
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-4px); }
        }
        .animate-fade-in-up { animation: fade-in-up 0.5s ease-out both; }
        .animate-fade-in { animation: fade-in 0.4s ease-out both; }
        .animate-float { animation: float 3s ease-in-out infinite; }

        /* ===== Glassmorphism ===== */
        .glass-sidebar {
            background: rgba(10, 15, 30, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(16, 185, 129, 0.08);
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            background: rgba(15, 23, 42, 0.6);
            border-color: rgba(16, 185, 129, 0.25);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(16, 185, 129, 0.05);
        }

        /* ===== Gradient Text & Accents ===== */
        .gradient-text {
            background: linear-gradient(135deg, #34d399, #10b981, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== Custom Scrollbar ===== */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #059669; }

        * { scroll-behavior: smooth; }
        input:focus, select:focus, textarea:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body class="h-full bg-[#020617] text-slate-100 font-sans antialiased overflow-hidden flex flex-col lg:flex-row">

    {{-- Ambient Background Blobs --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-teal-600/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-amber-500/5 rounded-full blur-3xl"></div>
    </div>

    {{-- Mobile Header Topbar (Visible only on mobile/tablet) --}}
    <header class="lg:hidden flex items-center justify-between px-6 h-16 bg-[#070b19] border-b border-white/5 shrink-0 z-40">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-amber-500 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15c-3.866 0-7-3.134-7-7V4h14v4c0 3.134-3.134 7-7 7zm0 0v5m-4 1h8M3 7h2m14 0h2" />
                </svg>
            </div>
            <span class="text-lg font-black tracking-wider gradient-text">ChampVault</span>
        </a>
        <button id="mobileMenuBtn" class="p-2 text-slate-400 hover:text-white focus:outline-none transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </header>

    {{-- Left Sidebar navigation (Sticky on large screens, sliding panel on mobile) --}}
    <aside id="sidebarMenu" class="hidden lg:flex flex-col w-72 glass-sidebar h-full fixed lg:static inset-y-0 left-0 z-50 shrink-0 select-none animate-fade-in">
        {{-- Sidebar Brand Logo --}}
        <div class="px-6 h-20 flex items-center gap-3.5 border-b border-white/5">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-amber-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15c-3.866 0-7-3.134-7-7V4h14v4c0 3.134-3.134 7-7 7zm0 0v5m-4 1h8M3 7h2m14 0h2" />
                </svg>
            </div>
            <span class="text-2xl font-black tracking-tight gradient-text">ChampVault</span>
        </div>

        {{-- User Session Widget --}}
        <div class="p-6 border-b border-white/5">
            <div class="flex items-center gap-4 bg-white/[0.02] p-4 rounded-2xl border border-white/5">
                <div class="w-11 h-11 rounded-full bg-slate-800 flex items-center justify-center text-emerald-400 font-bold ring-2 ring-emerald-500/20">
                    @auth
                        A
                    @else
                        G
                    @endauth
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-white truncate">
                        @auth
                            Administrator
                        @else
                            Tamu Pengunjung
                        @endauth
                    </p>
                    <span class="inline-flex items-center px-2 py-0.5 mt-1 rounded text-[10px] font-bold tracking-wider uppercase {{ Auth::check() ? 'bg-emerald-500/10 text-emerald-400' : 'bg-slate-700/30 text-slate-400' }}">
                        {{ Auth::check() ? 'Admin' : 'Guest' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Vertical Navigation Links --}}
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ Route::is('home') ? 'bg-emerald-600/15 text-emerald-400 border border-emerald-500/15 shadow-lg shadow-emerald-500/5' : 'text-slate-400 hover:text-white hover:bg-white/[0.03]' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Beranda Utama</span>
            </a>

            @auth
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ Route::is('admin.dashboard') ? 'bg-emerald-600/15 text-emerald-400 border border-emerald-500/15 shadow-lg shadow-emerald-500/5' : 'text-slate-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Dashboard Admin</span>
                </a>
            @endauth

            @auth
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold text-red-400 hover:text-red-300 hover:bg-red-500/5 transition-all text-left cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ Route::is('login') ? 'bg-emerald-600/15 text-emerald-400 border border-emerald-500/15 shadow-lg shadow-emerald-500/5' : 'text-slate-400 hover:text-white hover:bg-white/[0.03]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Masuk Admin (Login)</span>
                </a>
            @endauth
        </nav>

        {{-- Sidebar Student Details Footer --}}
        <div class="p-6 border-t border-white/5 text-center bg-black/10">
            <p class="text-xs text-slate-500 font-semibold tracking-wider uppercase">Tugas Mandiri UAS</p>
            <p class="text-sm font-black text-emerald-400 mt-1">NIM 241011750144</p>
            <p class="text-[10px] text-slate-600 mt-0.5">Rekayasa Web &copy; {{ date('Y') }}</p>
        </div>
    </aside>

    {{-- Main Content Area (Right Side) --}}
    <div class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto">
        {{-- Flash Messages Container (Top of main area) --}}
        @if(session('success'))
            <div class="max-w-7xl mx-auto w-full px-6 sm:px-8 mt-6 animate-fade-in shrink-0">
                <div class="flex items-center gap-3 px-5 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- Dynamic View Content --}}
        <main class="flex-1 px-6 sm:px-8 py-8">
            @yield('content')
        </main>
    </div>

    {{-- Simple Mobile Navigation Drawer Script --}}
    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebarMenu = document.getElementById('sidebarMenu');

        mobileMenuBtn.addEventListener('click', () => {
            sidebarMenu.classList.toggle('hidden');
            sidebarMenu.classList.toggle('fixed');
            sidebarMenu.classList.toggle('w-full');
            sidebarMenu.classList.toggle('bg-[#030712]');
        });
    </script>

</body>
</html>
