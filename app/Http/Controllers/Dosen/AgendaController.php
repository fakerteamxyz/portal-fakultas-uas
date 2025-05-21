<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\KategoriAgenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Agenda::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('dosen.agenda.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = KategoriAgenda::all();
        return view('dosen.agenda.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_agenda_id' => 'nullable|exists:kategori_agendas,id'
        ]);

        $data = $validated;
        $data['user_id'] = Auth::id();
        
        try {
            $agenda = Agenda::create($data);
            return redirect()->route('dosen.agenda.index')
                ->with('success', 'Agenda berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan agenda: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        // Check if the user is authorized to view this agenda
        if ($agenda->user_id !== Auth::id()) {
            return redirect()->route('dosen.agenda.index')
                ->with('error', 'Anda tidak memiliki izin untuk melihat agenda ini');
        }

        return view('dosen.agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        // Check if the user is authorized to edit this agenda
        if ($agenda->user_id !== Auth::id()) {
            return redirect()->route('dosen.agenda.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit agenda ini');
        }

        $kategoris = KategoriAgenda::all();
        return view('dosen.agenda.edit', compact('agenda', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        // Check if the user is authorized to update this agenda
        if ($agenda->user_id !== Auth::id()) {
            return redirect()->route('dosen.agenda.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit agenda ini');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_agenda_id' => 'nullable|exists:kategori_agendas,id'
        ]);

        $data = $validated;

        try {
            $agenda->update($data);
            return redirect()->route('dosen.agenda.index')
                ->with('success', 'Agenda berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui agenda: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        // Check if the user is authorized to delete this agenda
        if ($agenda->user_id !== Auth::id()) {
            return redirect()->route('dosen.agenda.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus agenda ini');
        }
        
        try {
            $agenda->delete();
            return redirect()->route('dosen.agenda.index')
                ->with('success', 'Agenda berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus agenda: ' . $e->getMessage());
        }
    }
}
