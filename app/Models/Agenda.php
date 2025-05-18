<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'deskripsi', 'tanggal', 'user_id', 'kategori_agenda_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriAgenda::class, 'kategori_agenda_id');
    }

    public function informasi()
    {
        return $this->hasMany(Informasi::class);
    }
}
