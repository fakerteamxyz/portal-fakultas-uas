<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriAgenda;

class KategoriAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriAgenda::all();
        return view('admin.kategori_agenda.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori_agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        KategoriAgenda::create($request->only('nama', 'deskripsi'));
        return redirect()->route('admin.kategori-agenda.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriAgenda $kategori_agenda)
    {
        return view('admin.kategori_agenda.edit', compact('kategori_agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriAgenda $kategori_agenda)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        $kategori_agenda->update($request->only('nama', 'deskripsi'));
        return redirect()->route('admin.kategori-agenda.index')->with('success', 'Kategori berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriAgenda $kategori_agenda)
    {
        $kategori_agenda->delete();
        return redirect()->route('admin.kategori-agenda.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
