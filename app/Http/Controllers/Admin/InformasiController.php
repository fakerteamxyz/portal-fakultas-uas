<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasis = Informasi::with(['user', 'agenda'])->latest()->paginate(10);
        return view('admin.informasi.index', compact('informasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agendas = Agenda::with('kategori')->latest()->get();
        return view('admin.informasi.create', compact('agendas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'agenda_id' => 'nullable|exists:agendas,id',
        ], [
            'judul.required' => 'Judul informasi harus diisi',
            'judul.max' => 'Judul terlalu panjang (maksimal 255 karakter)',
            'konten.required' => 'Konten informasi harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'konten' => $request->konten,
            'is_published' => $request->has('is_published'),
            'agenda_id' => $request->agenda_id,
        ];

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads/informasi'), $namaFile);
            $data['gambar'] = 'uploads/informasi/' . $namaFile;
        }

        Informasi::create($data);
        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil ditambahkan. ' . ($request->has('is_published') ? 'Informasi sudah dipublikasikan dan dapat dilihat oleh mahasiswa.' : 'Informasi disimpan sebagai draft dan tidak akan terlihat oleh mahasiswa.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $informasi = Informasi::with(['user', 'agenda', 'comments.user', 'comments.replies.user'])->findOrFail($id);

        // Mark all comments of this information as read
        if ($informasi->allComments->count() > 0) {
            $informasi->allComments()->update(['is_read' => true]);
        }

        return view('admin.informasi.show', compact('informasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        $agendas = Agenda::with('kategori')->latest()->get();
        return view('admin.informasi.edit', compact('informasi', 'agendas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'agenda_id' => 'nullable|exists:agendas,id',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'is_published' => $request->has('is_published'),
            'agenda_id' => $request->agenda_id,
        ];

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($informasi->gambar && file_exists(public_path($informasi->gambar))) {
                unlink(public_path($informasi->gambar));
            }

            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads/informasi'), $namaFile);
            $data['gambar'] = 'uploads/informasi/' . $namaFile;
        }

        $informasi->update($data);
        $statusMessage = $request->has('is_published') ? 'Informasi dipublikasikan dan dapat dilihat oleh mahasiswa.' : 'Informasi disimpan sebagai draft dan tidak akan terlihat oleh mahasiswa.';
        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diupdate. ' . $statusMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        // Hapus file gambar jika ada
        if ($informasi->gambar && file_exists(public_path($informasi->gambar))) {
            unlink(public_path($informasi->gambar));
        }

        // Check if there are comments
        $commentCount = $informasi->allComments()->count();

        // Delete the information
        $judul = $informasi->judul;
        $informasi->delete();

        if ($commentCount > 0) {
            return redirect()->route('admin.informasi.index')->with('info', "Informasi \"$judul\" berhasil dihapus beserta $commentCount komentar terkait.");
        } else {
            return redirect()->route('admin.informasi.index')->with('success', "Informasi \"$judul\" berhasil dihapus.");
        }
    }
}
