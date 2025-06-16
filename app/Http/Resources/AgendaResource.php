<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
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
            'description' => $this->deskripsi,
            'location' => $this->lokasi,
            'date' => $this->tanggal,
            'created_at' => $this->created_at,
            'kategori' => $this->whenLoaded('kategori', function() {
                return [
                    'id' => $this->kategori->id,
                    'name' => $this->kategori->nama,
                ];
            }),
            'user' => $this->whenLoaded('user', function() {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'role' => $this->user->role,
                ];
            }),
            'url' => url('/agenda#' . $this->id)
        ];
    }
}
