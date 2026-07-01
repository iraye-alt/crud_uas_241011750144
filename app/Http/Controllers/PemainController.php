<?php

namespace App\Http\Controllers;

use App\Models\Pemain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PemainController extends Controller
{
    /**
     * Halaman publik — tampilkan semua pemain untuk guest.
     */
    public function home()
    {
        $pemains = Pemain::latest()->get();
        $totalPemain = Pemain::count();
        $totalCabang = Pemain::distinct('cabang_olahraga')->count('cabang_olahraga');
        $totalKlub = Pemain::distinct('klub')->count('klub');

        return view('home', compact('pemains', 'totalPemain', 'totalCabang', 'totalKlub'));
    }

    /**
     * Dashboard admin — daftar semua pemain.
     */
    public function index()
    {
        $pemains = Pemain::latest()->get();
        $totalPemain = Pemain::count();
        $totalCabang = Pemain::distinct('cabang_olahraga')->count('cabang_olahraga');
        $totalKlub = Pemain::distinct('klub')->count('klub');

        return view('admin.dashboard', compact('pemains', 'totalPemain', 'totalCabang', 'totalKlub'));
    }

    /**
     * Form tambah pemain baru.
     */
    public function create()
    {
        return view('admin.pemain.create');
    }

    /**
     * Simpan data pemain baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'nama_pemain' => 'required|string|max:255',
            'cabang_olahraga' => 'required|string|max:255',
            'klub' => 'required|string|max:255',
            'usia' => 'required|integer|min:1|max:100',
        ], [
            'gambar.required' => 'Gambar pemain wajib diupload.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'nama_pemain.required' => 'Nama pemain wajib diisi.',
            'nama_pemain.max' => 'Nama pemain maksimal 255 karakter.',
            'cabang_olahraga.required' => 'Cabang olahraga wajib diisi.',
            'cabang_olahraga.max' => 'Cabang olahraga maksimal 255 karakter.',
            'klub.required' => 'Nama klub wajib diisi.',
            'klub.max' => 'Nama klub maksimal 255 karakter.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.integer' => 'Usia harus berupa angka.',
            'usia.min' => 'Usia minimal 1 tahun.',
            'usia.max' => 'Usia maksimal 100 tahun.',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pemain', 'public');
        }

        Pemain::create($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data pemain berhasil ditambahkan!');
    }

    /**
     * Form edit data pemain.
     */
    public function edit(Pemain $pemain)
    {
        return view('admin.pemain.edit', compact('pemain'));
    }

    /**
     * Update data pemain.
     */
    public function update(Request $request, Pemain $pemain)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'nama_pemain' => 'required|string|max:255',
            'cabang_olahraga' => 'required|string|max:255',
            'klub' => 'required|string|max:255',
            'usia' => 'required|integer|min:1|max:100',
        ], [
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus: jpeg, png, jpg, gif, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'nama_pemain.required' => 'Nama pemain wajib diisi.',
            'nama_pemain.max' => 'Nama pemain maksimal 255 karakter.',
            'cabang_olahraga.required' => 'Cabang olahraga wajib diisi.',
            'cabang_olahraga.max' => 'Cabang olahraga maksimal 255 karakter.',
            'klub.required' => 'Nama klub wajib diisi.',
            'klub.max' => 'Nama klub maksimal 255 karakter.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.integer' => 'Usia harus berupa angka.',
            'usia.min' => 'Usia minimal 1 tahun.',
            'usia.max' => 'Usia maksimal 100 tahun.',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pemain->gambar && Storage::disk('public')->exists($pemain->gambar)) {
                Storage::disk('public')->delete($pemain->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pemain', 'public');
        }

        $pemain->update($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data pemain berhasil diperbarui!');
    }

    /**
     * Hapus data pemain.
     */
    public function destroy(Pemain $pemain)
    {
        // Hapus file gambar jika ada
        if ($pemain->gambar && Storage::disk('public')->exists($pemain->gambar)) {
            Storage::disk('public')->delete($pemain->gambar);
        }

        $pemain->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data pemain berhasil dihapus!');
    }

    /**
     * Tampilkan detail pemain.
     */
    public function show(Pemain $pemain)
    {
        return view('pemain.show', compact('pemain'));
    }

    /**
     * Export seluruh data pemain ke PDF.
     */
    public function exportPdf()
    {
        $pemains = Pemain::latest()->get();

        $pdf = Pdf::loadView('admin.pemain.pdf', compact('pemains'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-data-pemain-olahraga.pdf');
    }
}
