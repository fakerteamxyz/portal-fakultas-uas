<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;
use Illuminate\Support\Facades\Auth;

class InformasiController extends Controller
{
    public function index()
    {
        $informasis = Informasi::where('user_id', Auth::id())->latest()->get();
        return view('staff.informasi.index', compact('informasis'));
    }

    public function create()
    {
        return view('staff.informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Informasi::create([
            'judul' => $request->judul,
            'konten' => $request->isi,
            'user_id' => Auth::id(),
            'role' => 'staff',
        ]);

        return redirect()->route('staff.informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $informasi = Informasi::findOrFail($id); // Hilangkan filter user_id agar staff bisa membaca informasi lain
        return view('staff.informasi.show', compact('informasi'));
    }

    public function edit($id)
    {
        $informasi = Informasi::where('user_id', Auth::id())->findOrFail($id);
        return view('staff.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $informasi = Informasi::where('user_id', Auth::id())->findOrFail($id);
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);
        $informasi->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);
        return redirect()->route('staff.informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $informasi = Informasi::where('user_id', Auth::id())->findOrFail($id);
        $informasi->delete();
        return redirect()->route('staff.informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }

    public function listInformasi()
    {
        $informasis = \App\Models\Informasi::latest()->get();
        return view('staff.informasi.list', compact('informasis'));
    }
}
