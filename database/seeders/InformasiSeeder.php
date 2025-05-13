<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Informasi;
use App\Models\User;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        Informasi::create([
            'judul' => 'Pengumuman Libur Fakultas',
            'konten' => 'Fakultas akan libur pada tanggal 17 Agustus.',
            'user_id' => $admin ? $admin->id : 1,
            'is_published' => true,
        ]);
        Informasi::create([
            'judul' => 'Pendaftaran Seminar',
            'konten' => 'Pendaftaran seminar dibuka hingga 20 Mei.',
            'user_id' => $admin ? $admin->id : 1,
            'is_published' => true,
        ]);
    }
}
