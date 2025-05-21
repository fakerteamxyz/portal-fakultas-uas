<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Informasi;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi' => 'required|string',
            'informasi_id' => 'required|exists:informasis,id',
            'parent_id' => 'required|exists:komentars,id', // Dosen can only reply to existing comments
        ]);

        $informasi = Informasi::findOrFail($request->informasi_id);
        $parentComment = Komentar::findOrFail($request->parent_id);

        $komentar = new Komentar([
            'user_id' => Auth::id(),
            'isi' => $request->isi,
            'commentable_id' => $informasi->id,
            'commentable_type' => Informasi::class,
            'parent_id' => $request->parent_id,
            'is_read' => true, // Dosen's replies are already read
        ]);

        $komentar->save();

        return redirect()->back()->with('success', 'Balasan berhasil ditambahkan. Mahasiswa akan melihat balasan Anda.');
    }
}
