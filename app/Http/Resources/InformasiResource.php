<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InformasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->judul,
            'content' => $this->konten,
            'image' => $this->gambar ? url($this->gambar) : null,
            'file_url' => $this->file_path ? url($this->file_path) : null,
            'file_name' => $this->file_name,
            'is_published' => (bool)$this->is_published,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'role' => $this->user->role,
            ],
            'agenda' => $this->agenda ? [
                'id' => $this->agenda->id,
                'title' => $this->agenda->judul,
                'date' => $this->agenda->tanggal,
                'location' => $this->agenda->lokasi ?? null,
                'description' => $this->agenda->deskripsi ?? null
            ] : null,
            'url' => route('public.informasi.show', $this->id),
        ];
    }
}
