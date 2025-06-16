<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaApiController extends Controller
{
    /**
     * Get agenda for calendar
     */
    public function calendar(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        
        $agendas = Agenda::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->with(['user', 'kategori'])
            ->get();
            
        return AgendaResource::collection($agendas);
    }
    
    /**
     * Get all agenda
     */
    public function index()
    {
        $agendas = Agenda::with(['user', 'kategori'])
            ->orderBy('tanggal', 'desc')
            ->get();
            
        return AgendaResource::collection($agendas);
    }
    
    /**
     * Get agenda details
     */
    public function show($id)
    {
        $agenda = Agenda::with(['user', 'kategori'])
            ->findOrFail($id);
            
        return new AgendaResource($agenda);
    }
}
