@extends('layouts.app')

@section('title', 'Dashboard Admin — ChampVault')

@section('content')

    <!-- jQuery & DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <style>
        /* Custom dark theme styles for jQuery DataTables */
        .dataTables_wrapper {
            padding: 1.5rem 0 !important;
        }
        .dataTables_wrapper .dataTables_length, 
        .dataTables_wrapper .dataTables_filter, 
        .dataTables_wrapper .dataTables_info, 
        .dataTables_wrapper .dataTables_processing, 
        .dataTables_wrapper .dataTables_paginate {
            color: #94a3b8 !important;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }
        .dataTables_wrapper .dataTables_filter input {
            background-color: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(16, 185, 129, 0.15) !important;
            border-radius: 0.75rem !important;
            color: white !important;
            padding: 0.5rem 1rem !important;
            margin-left: 0.5rem !important;
            outline: none !important;
            transition: all 0.2s;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2) !important;
        }
        .dataTables_wrapper .dataTables_length select {
            background-color: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(16, 185, 129, 0.15) !important;
            border-radius: 0.5rem !important;
            color: white !important;
            padding: 0.25rem 0.75rem !important;
            margin: 0 0.25rem !important;
            outline: none !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #94a3b8 !important;
            border-radius: 0.5rem !important;
            border: 1px solid transparent !important;
            padding: 0.375rem 0.75rem !important;
            transition: all 0.2s;
            cursor: pointer;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, #059669, #d97706) !important;
            color: white !important;
            border: 1px solid transparent !important;
            font-weight: 600;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(16, 185, 129, 0.12) !important;
            color: white !important;
            border: 1px solid transparent !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            color: #475569 !important;
            background: transparent !important;
            cursor: not-allowed;
        }
        table.dataTable {
            border-collapse: collapse !important;
            border-bottom: 1px solid rgba(16, 185, 129, 0.08) !important;
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
            width: 100% !important;
        }
        table.dataTable.no-footer {
            border-bottom: 1px solid rgba(16, 185, 129, 0.08) !important;
        }
        table.dataTable thead th {
            border-bottom: 1px solid rgba(16, 185, 129, 0.15) !important;
        }
    </style>

    <div class="space-y-8 animate-fade-in-up">
        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Database Kontrol</h1>
                <p class="text-slate-400 mt-1">Kelola, saring, dan perbarui data atlet juara di portal ChampVault</p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('admin.pemain.exportPdf') }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600/10 border border-emerald-500/20 text-emerald-400 font-semibold text-xs uppercase tracking-wider hover:bg-emerald-600/20 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Unduh PDF
                </a>
                <a href="{{ route('admin.pemain.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-amber-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 hover:from-emerald-500 hover:to-amber-400 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Atlet
                </a>
            </div>
        </div>

        {{-- Stats Grid with vertical bar accents --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="glass-card rounded-2xl p-5 border-l-4 border-emerald-500">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Total Atlet</p>
                <p class="text-3xl font-black text-white mt-1.5">{{ $totalPemain }}</p>
            </div>
            <div class="glass-card rounded-2xl p-5 border-l-4 border-teal-500">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Cabang Olahraga</p>
                <p class="text-3xl font-black text-white mt-1.5">{{ $totalCabang }}</p>
            </div>
            <div class="glass-card rounded-2xl p-5 border-l-4 border-amber-500">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Klub Terdaftar</p>
                <p class="text-3xl font-black text-white mt-1.5">{{ $totalKlub }}</p>
            </div>
        </div>

        {{-- Data Table Section --}}
        <div class="glass-card rounded-2xl overflow-hidden border border-white/5">
            <div class="px-6 py-5 border-b border-white/5 bg-white/[0.01]">
                <h2 class="text-lg font-bold text-white tracking-tight">Database Atlet ChampVault</h2>
            </div>

            @if($pemains->count() > 0)
                <div class="overflow-x-auto px-6">
                    <table id="pemainTable" class="w-full dataTable">
                        <thead>
                            <tr class="border-b border-white/8">
                                <th class="py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">No</th>
                                <th class="py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Gambar</th>
                                <th class="py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Atlet</th>
                                <th class="py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori</th>
                                <th class="py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Klub / Tim</th>
                                <th class="py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Usia</th>
                                <th class="py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($pemains as $index => $pemain)
                                <tr class="hover:bg-white/[0.02] transition-colors">
                                    <td class="py-4">
                                        <span class="text-sm text-slate-500 font-mono">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="py-4">
                                        @if($pemain->gambar)
                                            <img src="{{ asset('storage/' . $pemain->gambar) }}"
                                                 alt="{{ $pemain->nama_pemain }}"
                                                 class="w-11 h-11 rounded-xl object-cover ring-2 ring-white/5">
                                        @else
                                            <div class="w-11 h-11 rounded-xl bg-slate-900 border border-white/5 flex items-center justify-center text-slate-700">
                                                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-4">
                                        <span class="text-sm font-bold text-white hover:text-emerald-400 transition-colors">{{ $pemain->nama_pemain }}</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[9px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase tracking-wider">
                                            {{ $pemain->cabang_olahraga }}
                                        </span>
                                    </td>
                                    <td class="py-4">
                                        <span class="text-sm text-slate-300 font-semibold">{{ $pemain->klub }}</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="text-sm text-slate-300 font-semibold">{{ $pemain->usia }} thn</span>
                                    </td>
                                    <td class="py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('pemain.show', $pemain->id_pemain) }}"
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500/20 transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Detail
                                            </a>
                                            <a href="{{ route('admin.pemain.edit', $pemain->id_pemain) }}"
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20 hover:bg-amber-500/20 transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.pemain.destroy', $pemain->id_pemain) }}"
                                                  class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data pemain {{ $pemain->nama_pemain }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition-all cursor-pointer">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-16 text-center">
                    <div class="w-20 h-20 mx-auto rounded-2xl bg-slate-900 border border-white/5 flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Data Masih Kosong</h3>
                    <p class="text-slate-400 mb-6 text-sm">Belum ada data atlet yang tercatat.</p>
                    <a href="{{ route('admin.pemain.create') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-amber-500 text-white font-bold text-sm shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 transition-all cursor-pointer">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Atlet Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#pemainTable').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Lanjut",
                        "previous": "Kembali"
                    }
                },
                "columnDefs": [
                    { "orderable": false, "targets": [1, 6] }
                ]
            });
        });
    </script>

@endsection
