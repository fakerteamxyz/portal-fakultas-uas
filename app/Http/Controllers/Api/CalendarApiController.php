<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\InformasiResource;
use App\Models\Agenda;
use App\Models\Informasi;
use Illuminate\Http\Request;

class CalendarApiController extends Controller
{
    /**
     * Get combined agenda and informasi data for calendar
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        
        // Fetch informasi with agenda for the requested month/year
        $informasiWithAgenda = Informasi::where('is_published', 1)
            ->whereHas('agenda', function($query) use ($month, $year) {
                $query->whereMonth('tanggal', $month)
                      ->whereYear('tanggal', $year);
            })
            ->with(['user', 'agenda'])
            ->get();
        
        // Fetch standalone informasi created in the requested month/year
        $informasiWithoutAgenda = Informasi::where('is_published', 1)
            ->whereNull('agenda_id')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->with(['user'])
            ->get();
            
        // Fetch additional informasi from surrounding months for better user experience
        $additionalInformasi = Informasi::where('is_published', 1)
            ->whereMonth('created_at', '>=', $month - 1)
            ->whereMonth('created_at', '<=', $month + 1)
            ->whereYear('created_at', $year)
            ->whereNull('agenda_id')
            ->whereNotIn('id', $informasiWithoutAgenda->pluck('id')->toArray())
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Fetch agenda for the requested month/year
        $agendas = Agenda::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->with(['user', 'kategori'])
            ->get();
            
        // Format response with appropriate resources
        return response()->json([
            'informasi' => [
                'data' => InformasiResource::collection(
                    $informasiWithAgenda->merge($informasiWithoutAgenda)->merge($additionalInformasi)
                )
            ],
            'agenda' => [
                'data' => AgendaResource::collection($agendas)
            ]
        ]);
    }
}
