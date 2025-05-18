<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\KategoriAgenda;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Agenda::with(['user', 'kategori'])->latest()->paginate(10);
        return view('admin.agenda.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriAgendas = KategoriAgenda::all();
        return view('admin.agenda.create', compact('kategoriAgendas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'kategori_agenda_id' => 'required|exists:kategori_agendas,id',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'kategori_agenda_id' => $request->kategori_agenda_id,
        ];

        Agenda::create($data);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
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
    public function edit(Agenda $agenda)
    {
        $kategoriAgendas = KategoriAgenda::all();
        return view('admin.agenda.edit', compact('agenda', 'kategoriAgendas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'kategori_agenda_id' => 'required|exists:kategori_agendas,id',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'kategori_agenda_id' => $request->kategori_agenda_id,
        ];

        $agenda->update($data);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
