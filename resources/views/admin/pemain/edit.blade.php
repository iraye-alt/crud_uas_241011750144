@extends('layouts.app')

@section('title', 'Edit Atlet — SportData Hub')

@section('content')

    <section class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-indigo-400 transition-colors mb-6 animate-fade-in">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Dashboard
            </a>

            {{-- Form Card --}}
            <div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up">

                {{-- Header --}}
                <div class="px-6 sm:px-8 py-6 border-b border-white/5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">Edit Data Atlet</h1>
                            <p class="text-sm text-slate-400">Perbarui informasi atlet <span class="text-white font-medium">{{ $pemain->nama_pemain }}</span></p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('admin.pemain.update', $pemain->id_pemain) }}" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Gambar Upload --}}
                    <div>
                        <label for="gambar" class="block text-sm font-medium text-slate-300 mb-2">
                            Foto Atlet
                        </label>
                        <div class="flex items-start gap-4">
                            <div id="imagePreviewContainer"
                                 class="w-24 h-24 rounded-xl bg-slate-800 border-2 border-dashed border-white/10 flex items-center justify-center overflow-hidden shrink-0">
                                @if($pemain->gambar)
                                    <svg id="placeholderIcon" class="w-8 h-8 text-slate-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <img id="imagePreview" src="{{ asset('storage/' . $pemain->gambar) }}" alt="{{ $pemain->nama_pemain }}" class="w-full h-full object-cover">
                                @else
                                    <svg id="placeholderIcon" class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file"
                                       id="gambar"
                                       name="gambar"
                                       accept="image/*"
                                       onchange="previewImage(this)"
                                       class="w-full text-sm text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-amber-600/20 file:text-amber-400 hover:file:bg-amber-600/30 file:cursor-pointer cursor-pointer file:transition-all">
                                <p class="mt-2 text-xs text-slate-500">Kosongkan jika tidak ingin mengganti gambar. Format: JPEG, PNG, JPG, GIF, WebP. Maks: 2MB</p>
                            </div>
                        </div>
                        @error('gambar')
                            <p class="mt-2 text-sm text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Nama Pemain --}}
                    <div>
                        <label for="nama_pemain" class="block text-sm font-medium text-slate-300 mb-2">
                            Nama Lengkap Atlet <span class="text-red-400">*</span>
                        </label>
                        <input type="text"
                               id="nama_pemain"
                               name="nama_pemain"
                               value="{{ old('nama_pemain', $pemain->nama_pemain) }}"
                               placeholder="Masukkan nama lengkap atlet"
                               class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition-all">
                        @error('nama_pemain')
                            <p class="mt-2 text-sm text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Cabang Olahraga & Klub --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="cabang_olahraga" class="block text-sm font-medium text-slate-300 mb-2">
                                Cabang Olahraga <span class="text-red-400">*</span>
                            </label>
                            <input type="text"
                                   id="cabang_olahraga"
                                   name="cabang_olahraga"
                                   value="{{ old('cabang_olahraga', $pemain->cabang_olahraga) }}"
                                   placeholder="cth: Sepak Bola"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition-all">
                            @error('cabang_olahraga')
                                <p class="mt-2 text-sm text-red-400 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="klub" class="block text-sm font-medium text-slate-300 mb-2">
                                Klub <span class="text-red-400">*</span>
                            </label>
                            <input type="text"
                                   id="klub"
                                   name="klub"
                                   value="{{ old('klub', $pemain->klub) }}"
                                   placeholder="cth: Barcelona FC"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition-all">
                            @error('klub')
                                <p class="mt-2 text-sm text-red-400 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Usia --}}
                    <div class="max-w-xs">
                        <label for="usia" class="block text-sm font-medium text-slate-300 mb-2">
                            Usia <span class="text-red-400">*</span>
                        </label>
                        <input type="number"
                               id="usia"
                               name="usia"
                               value="{{ old('usia', $pemain->usia) }}"
                               min="1"
                               max="100"
                               placeholder="cth: 25"
                               class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition-all">
                        @error('usia')
                            <p class="mt-2 text-sm text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold text-sm shadow-lg shadow-amber-500/25 hover:shadow-amber-500/40 hover:from-amber-400 hover:to-orange-500 transition-all transform hover:scale-[1.02] active:scale-[0.98] cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Perbarui Data
                        </button>
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-6 py-3 rounded-xl text-sm font-medium text-slate-400 hover:text-white bg-slate-800/50 hover:bg-slate-700/50 border border-white/10 transition-all">
                            Batal
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </section>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('placeholderIcon');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
