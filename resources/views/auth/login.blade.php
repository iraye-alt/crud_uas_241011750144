@extends('layouts.app')

@section('title', 'Login — ChampVault')

@section('content')

    <div class="max-w-4xl mx-auto my-6 sm:my-10 animate-fade-in-up">
        {{-- Card Container --}}
        <div class="glass-card rounded-3xl overflow-hidden border border-white/10 shadow-2xl flex flex-col md:flex-row min-h-[480px]">
            
            {{-- Left Side: Decorative Branding Banner --}}
            <div class="md:w-5/12 bg-gradient-to-br from-emerald-600 to-teal-800 p-8 sm:p-10 flex flex-col justify-between relative overflow-hidden">
                {{-- Decorative background glow --}}
                <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-amber-500/20 rounded-full blur-2xl"></div>
                <div class="absolute -left-10 -top-10 w-44 h-44 bg-white/5 rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15c-3.866 0-7-3.134-7-7V4h14v4c0 3.134-3.134 7-7 7zm0 0v5m-4 1h8M3 7h2m14 0h2" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-white leading-tight">ChampVault</h2>
                    <p class="text-xs text-emerald-200 mt-2 leading-relaxed">Sistem informasi manajemen atlet profesional dan database kejuaraan terintegrasi.</p>
                </div>

                <div class="relative z-10 pt-10">
                    <p class="text-[10px] text-emerald-300 font-bold uppercase tracking-wider">Akses Terproteksi</p>
                    <p class="text-[11px] text-emerald-100 mt-1 leading-relaxed">Hanya personil terverifikasi yang diperbolehkan mengedit database.</p>
                </div>
            </div>

            {{-- Right Side: Login Form --}}
            <div class="flex-1 p-8 sm:p-10 bg-slate-950/40 flex flex-col justify-center">
                <div class="mb-6">
                    <h1 class="text-xl font-bold text-white tracking-tight">Selamat Datang Kembali</h1>
                    <p class="text-xs text-slate-400 mt-1">Gunakan kredensial admin Anda untuk melanjutkan.</p>
                </div>

                {{-- Error Messages --}}
                @if($errors->any())
                    <div class="mb-5 p-3.5 rounded-xl bg-red-500/10 border border-red-500/20 animate-fade-in">
                        @foreach($errors->all() as $error)
                            <div class="flex items-center gap-2 text-xs text-red-400 font-medium">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   value="{{ old('username') }}"
                                   placeholder="admin"
                                   required
                                   autofocus
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-900/60 border border-white/5 text-xs text-white placeholder-slate-600 focus:outline-none focus:border-emerald-500/80 transition-all duration-200">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="••••••••"
                                   required
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-900/60 border border-white/5 text-xs text-white placeholder-slate-600 focus:outline-none focus:border-emerald-500/80 transition-all duration-200">
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="w-full py-2.5 px-6 mt-2 rounded-xl bg-gradient-to-r from-emerald-600 to-amber-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/35 hover:from-emerald-500 hover:to-amber-400 transition-all cursor-pointer">
                        Masuk Sistem
                    </button>
                </form>
            </div>

        </div>
    </div>

@endsection
