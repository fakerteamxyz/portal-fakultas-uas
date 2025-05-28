<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'isi' => 'required|string',
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'parent_id' => 'nullable|exists:komentars,id',
        ]);

        Komentar::create([
            'user_id' => Auth::id(),
            'isi' => $request->isi,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => $request->commentable_type,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim.');
    }

    public function destroy($id)
    {
        $komentar = Komentar::where('user_id', Auth::id())->findOrFail($id);
        $komentar->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
