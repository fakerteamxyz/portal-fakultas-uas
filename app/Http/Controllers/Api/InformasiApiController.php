<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InformasiResource;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InformasiApiController extends Controller
{
    /**
     * Get informasi for calendar
     */
    public function calendar(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        
        // Informasi dengan agenda di bulan dan tahun yang diminta
        $informasiWithAgenda = Informasi::where('is_published', 1)
            ->whereHas('agenda', function($query) use ($month, $year) {
                $query->whereMonth('tanggal', $month)
                      ->whereYear('tanggal', $year);
            })
            ->with(['user', 'agenda'])
            ->get();
        
        // Informasi terbaru di bulan dan tahun yang sama (tanpa agenda)
        $informasiWithoutAgenda = Informasi::where('is_published', 1)
            ->whereNull('agenda_id')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->with(['user'])
            ->get();
            
        // Coba ambil data dari bulan ini terlepas dari tanggal pembuatan
        // Ini untuk memastikan selalu ada konten di kalendar
        $additionalInformasi = Informasi::where('is_published', 1)
            ->whereMonth('created_at', '>=', $month - 1) // Termasuk bulan sebelumnya
            ->whereMonth('created_at', '<=', $month + 1) // Termasuk bulan selanjutnya
            ->whereYear('created_at', $year)
            ->whereNull('agenda_id')
            ->whereNotIn('id', $informasiWithoutAgenda->pluck('id')->toArray())
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Gabungkan semua koleksi
        $allInformasi = $informasiWithAgenda
            ->merge($informasiWithoutAgenda)
            ->merge($additionalInformasi);
            
        return InformasiResource::collection($allInformasi);
    }
    
    /**
     * Get latest informasi
     */
    public function latest()
    {
        $informasi = Informasi::where('is_published', 1)
            ->with(['user', 'agenda'])
            ->latest()
            ->take(10)
            ->get();
            
        return InformasiResource::collection($informasi);
    }
    
    /**
     * Get informasi details
     */
    public function show($id)
    {
        $informasi = Informasi::where('is_published', 1)
            ->with(['user', 'agenda'])
            ->findOrFail($id);
            
        return new InformasiResource($informasi);
    }
}
