@extends('layouts.app')

@section('title', 'Beranda — ChampVault')

@section('content')

    {{-- Welcome Header Banner --}}
    <div class="relative rounded-3xl overflow-hidden p-8 sm:p-10 mb-8 bg-gradient-to-tr from-emerald-600/15 via-teal-600/5 to-amber-500/5 border border-emerald-500/10 animate-fade-in-up">
        {{-- Floating decor orb --}}
        <div class="absolute -right-20 -top-20 w-52 h-52 bg-emerald-500/10 rounded-full blur-2xl"></div>
        <div class="absolute -left-20 -bottom-20 w-52 h-52 bg-amber-500/5 rounded-full blur-2xl"></div>

        <div class="relative z-10 max-w-2xl">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight text-white mb-3">
                Selamat Datang di <span class="bg-gradient-to-r from-emerald-400 to-amber-400 bg-clip-text text-transparent">ChampVault</span>
            </h1>
            <p class="text-sm sm:text-base text-slate-400 leading-relaxed">
                Platform eksklusif database atlet juara dunia. Cari, saring, dan pelajari pencapaian karir atlet legendaris dari berbagai cabang olahraga terkemuka.
            </p>
        </div>
    </div>

    {{-- Quick Analytics Row --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10 animate-fade-in-up delay-100">
        <div class="glass-card rounded-2xl p-5 flex items-center gap-4 hover:border-emerald-500/20">
            <div class="w-11 h-11 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl font-black text-white leading-none">{{ $totalPemain }}</p>
                <p class="text-xs text-slate-500 font-semibold mt-1">Total Atlet Terdaftar</p>
            </div>
        </div>

        <div class="glass-card rounded-2xl p-5 flex items-center gap-4 hover:border-teal-500/20">
            <div class="w-11 h-11 rounded-xl bg-teal-500/10 flex items-center justify-center text-teal-400">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl font-black text-white leading-none">{{ $totalCabang }}</p>
                <p class="text-xs text-slate-500 font-semibold mt-1">Cabang Olahraga</p>
            </div>
        </div>

        <div class="glass-card rounded-2xl p-5 flex items-center gap-4 hover:border-amber-500/20">
            <div class="w-11 h-11 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400">
                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl font-black text-white leading-none">{{ $totalKlub }}</p>
                <p class="text-xs text-slate-500 font-semibold mt-1">Klub/Tim Terdaftar</p>
            </div>
        </div>
    </div>

    {{-- Filter & Content Section --}}
    <div class="space-y-6 animate-fade-in-up delay-200">
        {{-- Category Filter Bar --}}
        <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
            <button class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border border-emerald-500/20 bg-emerald-600/20 text-emerald-400 transition-all cursor-pointer whitespace-nowrap active" data-filter="all">
                Semua Kategori
            </button>
            <button class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border border-white/5 bg-slate-900/40 text-slate-400 hover:text-white transition-all cursor-pointer whitespace-nowrap" data-filter="Tenis">
                Tenis
            </button>
            <button class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border border-white/5 bg-slate-900/40 text-slate-400 hover:text-white transition-all cursor-pointer whitespace-nowrap" data-filter="Senam Artistik">
                Senam Artistik
            </button>
            <button class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border border-white/5 bg-slate-900/40 text-slate-400 hover:text-white transition-all cursor-pointer whitespace-nowrap" data-filter="Sepak Bola">
                Sepak Bola
            </button>
            <button class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border border-white/5 bg-slate-900/40 text-slate-400 hover:text-white transition-all cursor-pointer whitespace-nowrap" data-filter="Bola Basket">
                Bola Basket
            </button>
            <button class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border border-white/5 bg-slate-900/40 text-slate-400 hover:text-white transition-all cursor-pointer whitespace-nowrap" data-filter="Snowboard">
                Snowboard
            </button>
        </div>

        {{-- Horizontal Athlete Cards Grid --}}
        @if($pemains->count() > 0)
            <div id="athletesGrid" class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                @foreach($pemains as $index => $pemain)
                    <div class="athlete-card flex flex-col sm:flex-row glass-card rounded-2xl overflow-hidden" data-sport="{{ $pemain->cabang_olahraga }}">
                        {{-- Image Left --}}
                        <div class="relative sm:w-44 h-48 sm:h-auto bg-slate-900 overflow-hidden shrink-0">
                            @if($pemain->gambar)
                                <img src="{{ asset('storage/' . $pemain->gambar) }}"
                                     alt="{{ $pemain->nama_pemain }}"
                                     class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-950">
                                    <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                            {{-- Floating badge over image --}}
                            <div class="absolute top-3 left-3 sm:hidden">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[9px] font-bold tracking-wider bg-emerald-600/90 text-white backdrop-blur-md shadow-lg uppercase">
                                    {{ $pemain->cabang_olahraga }}
                                </span>
                            </div>
                        </div>

                        {{-- Metadata Right --}}
                        <div class="flex-1 p-6 flex flex-col justify-between min-w-0">
                            <div>
                                <div class="hidden sm:flex items-center justify-between gap-4 mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[9px] font-bold tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase">
                                        {{ $pemain->cabang_olahraga }}
                                    </span>
                                    <span class="text-[10px] text-slate-500 font-mono tracking-wider font-semibold">#ATLET-{{ str_pad($pemain->id_pemain, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-white truncate hover:text-emerald-400 transition-colors" title="{{ $pemain->nama_pemain }}">
                                    {{ $pemain->nama_pemain }}
                                </h3>

                                <div class="mt-4 space-y-2">
                                    <div class="flex items-center gap-2 text-xs text-slate-400">
                                        <div class="w-5 h-5 rounded-md bg-teal-500/10 flex items-center justify-center shrink-0">
                                            <svg class="w-3.5 h-3.5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z"/>
                                            </svg>
                                        </div>
                                        <span class="truncate font-semibold text-slate-300">{{ $pemain->klub }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-slate-400">
                                        <div class="w-5 h-5 rounded-md bg-amber-500/10 flex items-center justify-center shrink-0">
                                            <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-slate-300">{{ $pemain->usia }} tahun</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-white/5 flex items-center justify-between">
                                <span class="sm:hidden text-[9px] text-slate-600 font-mono">#{{ str_pad($pemain->id_pemain, 4, '0', STR_PAD_LEFT) }}</span>
                                <span class="hidden sm:inline"></span>
                                <a href="{{ route('pemain.show', $pemain->id_pemain) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-400 hover:text-emerald-300 transition-colors">
                                    <span>Tinjau Profil</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="glass-card rounded-3xl p-16 text-center border-white/5">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-900 border border-white/5 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-slate-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Belum Ada Data Atlet</h3>
                <p class="text-slate-400 max-w-sm mx-auto text-xs">Data pemain olahraga belum tersedia dalam database ChampVault.</p>
            </div>
        @endif
    </div>

    {{-- Interactive Category Filter JS Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const athleteCards = document.querySelectorAll('.athlete-card');

            filterButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Update Active Button UI Status
                    filterButtons.forEach(b => {
                        b.classList.remove('border-emerald-500/20', 'bg-emerald-600/20', 'text-emerald-400', 'active');
                        b.classList.add('border-white/5', 'bg-slate-900/40', 'text-slate-400');
                    });
                    btn.classList.add('border-emerald-500/20', 'bg-emerald-600/20', 'text-emerald-400', 'active');
                    btn.classList.remove('border-white/5', 'bg-slate-900/40', 'text-slate-400');

                    // Filter Card Elements
                    const filterValue = btn.getAttribute('data-filter');
                    athleteCards.forEach(card => {
                        const sport = card.getAttribute('data-sport');
                        if (filterValue === 'all' || sport === filterValue) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>

@endsection
