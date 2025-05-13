<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;
use App\Models\User;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $staff = User::where('role', 'staff')->first();
        Agenda::create([
            'judul' => 'Seminar Nasional',
            'deskripsi' => 'Seminar nasional tentang teknologi terbaru.',
            'tanggal' => now()->addDays(7),
            'user_id' => $staff ? $staff->id : 1,
        ]);
        Agenda::create([
            'judul' => 'Workshop Laravel',
            'deskripsi' => 'Workshop pengembangan aplikasi dengan Laravel.',
            'tanggal' => now()->addDays(14),
            'user_id' => $staff ? $staff->id : 1,
        ]);
    }
}
