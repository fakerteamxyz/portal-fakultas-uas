<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Agenda;
use App\Models\KategoriAgenda;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get the latest information from admin users for the slider
        $sliderInformasi = Informasi::with(['user', 'agenda', 'allComments'])
            ->whereHas('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->where('is_published', 1)
            ->latest()
            ->take(3)
            ->get();

        // If there are less than 3 admin informasi, get any other published informasi
        if ($sliderInformasi->count() < 3) {
            $additionalInformasi = Informasi::with(['user', 'agenda', 'allComments'])
                ->where('is_published', 1)
                ->whereNotIn('id', $sliderInformasi->pluck('id')->toArray())
                ->latest()
                ->take(3 - $sliderInformasi->count())
                ->get();

            $sliderInformasi = $sliderInformasi->merge($additionalInformasi);
        }

        // Get the latest information for the cards section
        $latestInformasi = Informasi::with(['user', 'agenda', 'allComments'])
            ->where('is_published', 1)
            ->latest()
            ->take(3)
            ->get();

        // Get the latest agendas
        $latestAgendas = Agenda::with('user')
            ->latest()
            ->take(3)
            ->get();

        // Get all categories
        $kategoriAgendas = KategoriAgenda::all();

        // Get agendas by category
        $agendasByCategory = [];
        foreach ($kategoriAgendas as $kategori) {
            $agendasByCategory[$kategori->id] = Agenda::where('kategori_agenda_id', $kategori->id)
                ->latest()
                ->take(3)
                ->get();
        }

        return view('welcome', compact(
            'sliderInformasi',
            'latestInformasi',
            'latestAgendas',
            'kategoriAgendas',
            'agendasByCategory'
        ));
    }
}
