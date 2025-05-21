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
            'is_read' => false,
        ]);

        $komentar->save();

        $actionType = $request->parent_id ? 'Balasan' : 'Komentar';
        return redirect()->back()->with('success', "$actionType berhasil ditambahkan. Admin akan melihat komentar Anda.");
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

        // Check if this comment has replies
        if ($komentar->replies && $komentar->replies->count() > 0) {
            return redirect()->back()->with('warning', 'Komentar yang memiliki balasan tidak dapat dihapus. Hubungi admin jika diperlukan.');
        }

        $commentType = $komentar->parent_id ? 'Balasan' : 'Komentar';
        $komentar->delete();
        return redirect()->back()->with('success', "$commentType berhasil dihapus.");
    }
}
