<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\User;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all comments
        $komentars = Komentar::with(['user', 'commentable'])->latest()->paginate(10);

        // Mark all comments as read
        Komentar::where('is_read', false)->update(['is_read' => true]);

        return view('admin.komentar.index', compact('komentars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi' => 'required|string',
            'parent_id' => 'required|exists:komentars,id',
            'informasi_id' => 'nullable|exists:informasis,id',
        ]);

        $parentComment = Komentar::findOrFail($request->parent_id);

        $komentar = new Komentar([
            'user_id' => auth()->id(),
            'isi' => $request->isi,
            'parent_id' => $request->parent_id,
            'commentable_id' => $parentComment->commentable_id,
            'commentable_type' => $parentComment->commentable_type,
        ]);

        $komentar->save();

        if ($request->has('informasi_id') && $parentComment->commentable_type === 'App\\Models\\Informasi') {
            return redirect()->route('admin.informasi.show', $request->informasi_id)->with('success', 'Balasan berhasil ditambahkan. Mahasiswa akan melihat balasan Anda.');
        }

        return redirect()->back()->with('success', 'Balasan berhasil ditambahkan. Mahasiswa akan melihat balasan Anda.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komentar $komentar)
    {
        // Check if the comment has replies
        if ($komentar->replies->count() > 0) {
            return redirect()->back()->with('warning', 'Tidak dapat menghapus komentar yang memiliki balasan. Hapus balasan terlebih dahulu.');
        }

        // Store information about the deleted comment for more informative message
        $userName = $komentar->user->name ?? 'Pengguna';
        $commentType = $komentar->parent_id ? 'Balasan' : 'Komentar';

        $komentar->delete();
        return redirect()->back()->with('success', "$commentType dari $userName berhasil dihapus.");
    }
}
