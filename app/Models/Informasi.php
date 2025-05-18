<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'konten', 'gambar', 'user_id', 'is_published', 'agenda_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function comments()
    {
        return $this->morphMany(Komentar::class, 'commentable')->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->morphMany(Komentar::class, 'commentable')->whereNotNull('parent_id');
    }

    public function allComments()
    {
        return $this->morphMany(Komentar::class, 'commentable');
    }
}
