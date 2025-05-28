<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::where('user_id', Auth::id())->latest()->get();
        return view('staff.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('staff.agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        Agenda::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'user_id' => Auth::id(),
            'role' => 'staff',
        ]);

        return redirect()->route('staff.agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function show($id)
    {
        $agenda = Agenda::findOrFail($id); // Hilangkan filter user_id agar staff bisa membaca agenda lain
        return view('staff.agenda.show', compact('agenda'));
    }

    public function edit($id)
    {
        $agenda = Agenda::where('user_id', Auth::id())->findOrFail($id);
        return view('staff.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::where('user_id', Auth::id())->findOrFail($id);
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
        ]);
        $agenda->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('staff.agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $agenda = Agenda::where('user_id', Auth::id())->findOrFail($id);
        $agenda->delete();
        return redirect()->route('staff.agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }

    public function listAgenda()
    {
        $agendas = \App\Models\Agenda::latest()->get();
        return view('staff.agenda.list', compact('agendas'));
    }

    public function listInformasi()
    {
        $informasis = \App\Models\Informasi::latest()->get();
        return view('staff.informasi.list', compact('informasis'));
    }
}
