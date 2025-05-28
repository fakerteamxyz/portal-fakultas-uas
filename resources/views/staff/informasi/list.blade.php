@extends('layouts.staff')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Informasi Fakultas</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informasis as $informasi)
                        <tr>
                            <td>{{ $informasi->judul }}</td>
                            <td>{{ $informasi->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('staff.informasi.show', $informasi->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
