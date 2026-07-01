@extends('layouts.app')

@section('title', $pemain->nama_pemain . ' — Detail Atlet')

@section('content')

    <div class="max-w-4xl mx-auto animate-fade-in-up">
        {{-- Back Button --}}
        <a href="{{ url()->previous() == url()->current() ? route('home') : url()->previous() }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-400 hover:text-emerald-400 transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>

        {{-- Detail Profile Container --}}
        <div class="glass-card rounded-3xl overflow-hidden border border-white/5 flex flex-col md:flex-row min-h-[460px]">
            {{-- Left Side: Large Athlete Image --}}
            <div class="md:w-5/12 relative bg-slate-900 overflow-hidden min-h-[300px] md:min-h-0">
                @if($pemain->gambar)
                    <img src="{{ asset('storage/' . $pemain->gambar) }}"
                         alt="{{ $pemain->nama_pemain }}"
                         class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-950">
                        <svg class="w-20 h-20 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                @endif
                {{-- Sport floating badge --}}
                <div class="absolute top-4 left-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-[10px] font-bold tracking-wider uppercase bg-emerald-600/90 text-white backdrop-blur-md shadow-lg border border-white/10">
                        {{ $pemain->cabang_olahraga }}
                    </span>
                </div>
            </div>

            {{-- Right Side: Profile Details --}}
            <div class="flex-1 p-8 sm:p-10 flex flex-col justify-between bg-slate-950/20">
                <div>
                    {{-- ID Indicator --}}
                    <div class="flex items-center justify-between gap-4 mb-2">
                        <span class="text-[10px] text-emerald-400 font-mono tracking-wider font-bold uppercase">Profil Atlet Terverifikasi</span>
                        <span class="text-[10px] text-slate-500 font-mono tracking-wider font-semibold">#ATLET-{{ str_pad($pemain->id_pemain, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    {{-- Athlete Name --}}
                    <h1 class="text-3xl font-black text-white tracking-tight leading-none mt-2">{{ $pemain->nama_pemain }}</h1>
                    
                    <hr class="border-white/5 my-6">

                    {{-- Spec Details list --}}
                    <div class="space-y-5">
                        <div class="flex items-center gap-4.5">
                            <div class="w-10 h-10 rounded-xl bg-teal-500/10 border border-teal-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Klub / Tim</p>
                                <p class="text-base font-bold text-slate-200 mt-0.5">{{ $pemain->klub }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4.5">
                            <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Usia Atlet</p>
                                <p class="text-base font-bold text-slate-200 mt-0.5">{{ $pemain->usia }} Tahun</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4.5">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Kategori Database</p>
                                <p class="text-base font-bold text-slate-200 mt-0.5">Data Atlet Profesional</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Panel for Admins --}}
                @auth
                    <div class="mt-8 pt-6 border-t border-white/5 flex gap-3 shrink-0">
                        <a href="{{ route('admin.pemain.edit', $pemain->id_pemain) }}" 
                           class="flex-1 py-2.5 px-4 rounded-xl bg-amber-500/20 border border-amber-500/30 text-amber-400 font-bold text-xs uppercase tracking-wider text-center hover:bg-amber-500/30 transition-all cursor-pointer">
                            Edit Profil
                        </a>
                    </div>
                @endauth
            </div>

        </div>
    </div>

@endsection
