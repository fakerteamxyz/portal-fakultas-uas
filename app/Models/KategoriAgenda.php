<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAgenda extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi'];

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'kategori_agenda_id');
    }
}
