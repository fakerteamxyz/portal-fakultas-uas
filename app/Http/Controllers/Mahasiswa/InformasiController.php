<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasiList = Informasi::where('is_published', 1)
            ->with(['user', 'agenda'])
            ->latest()
            ->paginate(10);
            
        return view('mahasiswa.informasi.index', compact('informasiList'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $informasi = Informasi::where('is_published', 1)
            ->with(['user', 'agenda', 'comments.user', 'replies.user'])
            ->findOrFail($id);
            
        return view('mahasiswa.informasi.show', compact('informasi'));
    }
}
