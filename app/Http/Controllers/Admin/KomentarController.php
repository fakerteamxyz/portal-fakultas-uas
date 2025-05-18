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
        $komentars = Komentar::with(['user', 'commentable'])->latest()->paginate(10);
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
            return redirect()->route('admin.informasi.show', $request->informasi_id)->with('success', 'Balasan berhasil ditambahkan.');
        }

        return redirect()->back()->with('success', 'Balasan berhasil ditambahkan.');
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
        $komentar->delete();
        return redirect()->route('admin.komentar.index')->with('success', 'Komentar berhasil dihapus.');
    }
}
