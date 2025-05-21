<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = Informasi::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('dosen.informasi.index', compact('informasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agendas = Agenda::where('user_id', Auth::id())->orderBy('tanggal', 'desc')->get();
        return view('dosen.informasi.create', compact('agendas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'agenda_id' => 'nullable|exists:agendas,id',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/informasi'), $filename);
            $data['gambar'] = 'uploads/informasi/' . $filename;
        }

        try {
            $informasi = Informasi::create($data);
            return redirect()->route('dosen.informasi.index')
                ->with('success', 'Informasi berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan informasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        // Check if the user is authorized to view this informasi
        if ($informasi->user_id !== Auth::id()) {
            return redirect()->route('dosen.informasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk melihat informasi ini');
        }

        return view('dosen.informasi.show', compact('informasi'));
    }
    
    /**
     * Display any published information, allowing dosen to reply to student comments.
     */
    public function viewPublished($id)
    {
        $informasi = Informasi::where('is_published', 1)
            ->with(['user', 'agenda', 'comments.user', 'comments.replies.user'])
            ->findOrFail($id);
            
        return view('dosen.informasi.view_published', compact('informasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        // Check if the user is authorized to edit this informasi
        if ($informasi->user_id !== Auth::id()) {
            return redirect()->route('dosen.informasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit informasi ini');
        }

        $agendas = Agenda::where('user_id', Auth::id())->orderBy('tanggal', 'desc')->get();
        return view('dosen.informasi.edit', compact('informasi', 'agendas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        // Check if the user is authorized to update this informasi
        if ($informasi->user_id !== Auth::id()) {
            return redirect()->route('dosen.informasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit informasi ini');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'agenda_id' => 'nullable|exists:agendas,id',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($informasi->gambar && file_exists(public_path($informasi->gambar))) {
                unlink(public_path($informasi->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/informasi'), $filename);
            $data['gambar'] = 'uploads/informasi/' . $filename;
        }

        try {
            $informasi->update($data);
            return redirect()->route('dosen.informasi.index')
                ->with('success', 'Informasi berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui informasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        // Check if the user is authorized to delete this informasi
        if ($informasi->user_id !== Auth::id()) {
            return redirect()->route('dosen.informasi.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus informasi ini');
        }

        // Delete image if exists
        if ($informasi->gambar && file_exists(public_path($informasi->gambar))) {
            unlink(public_path($informasi->gambar));
        }

        $informasi->delete();

        return redirect()->route('dosen.informasi.index')
            ->with('success', 'Informasi berhasil dihapus');
    }
}
