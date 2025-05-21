<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Informasi;
use App\Models\Agenda;
use App\Models\Komentar;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get unread comments count
        $unreadCommentsCount = Komentar::where('is_read', false)->count();

        // Check if this is the first login for this session
        if (!$request->session()->has('admin_welcomed')) {
            $request->session()->put('admin_welcomed', true);
            $welcomeMessage = $this->getWelcomeMessage($unreadCommentsCount);
            return view('admin.dashboard')->with('info', $welcomeMessage);
        }

        return view('admin.dashboard');
    }

    private function getWelcomeMessage($unreadCommentsCount)
    {
        $time = date('H');
        $greeting = '';

        if ($time < 12) {
            $greeting = 'Selamat Pagi';
        } elseif ($time < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($time < 18) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        if ($unreadCommentsCount > 0) {
            return "$greeting, " . Auth::user()->name . "! Anda memiliki $unreadCommentsCount komentar belum dibaca. Segera tinjau untuk memberikan respon kepada mahasiswa.";
        } else {
            return "$greeting, " . Auth::user()->name . "! Semua komentar mahasiswa telah Anda baca. Terima kasih atas kerja kerasnya!";
        }
    }
}
