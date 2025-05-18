<?php

namespace App\Http\Controllers\Mahasiswa;

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
            'parent_id' => 'nullable|exists:komentars,id',
        ]);

        $informasi = Informasi::findOrFail($request->informasi_id);
        
        $komentar = new Komentar([
            'user_id' => Auth::id(),
            'isi' => $request->isi,
            'commentable_id' => $informasi->id,
            'commentable_type' => Informasi::class,
            'parent_id' => $request->parent_id,
        ]);
        
        $komentar->save();
        
        return redirect()->back()->with('success', $request->parent_id ? 'Balasan berhasil ditambahkan.' : 'Komentar berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komentar $komentar)
    {
        // Verify that the user owns this comment
        if ($komentar->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }
        
        $komentar->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
