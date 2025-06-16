<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $informasi = Informasi::where('is_published', 1)
            ->with(['user', 'agenda', 'comments.user', 'comments.replies.user'])
            ->findOrFail($id);

        return view('public.informasi.show', compact('informasi'));
    }
}
