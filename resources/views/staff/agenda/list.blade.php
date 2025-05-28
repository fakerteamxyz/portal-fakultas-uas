@extends('layouts.staff')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Agenda Fakultas</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas as $agenda)
                        <tr>
                            <td>{{ $agenda->judul }}</td>
                            <td>{{ $agenda->tanggal }}</td>
                            <td>
                                <a href="{{ route('staff.agenda.show', $agenda->id) }}" class="btn btn-info btn-sm">Lihat</a>
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
