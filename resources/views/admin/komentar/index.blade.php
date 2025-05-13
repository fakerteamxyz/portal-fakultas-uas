@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Daftar Komentar Mahasiswa</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Mahasiswa</th>
                <th>Komentar</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($komentars as $komentar)
                <tr>
                    <td>{{ $komentar->user->name ?? '-' }}</td>
                    <td>{{ $komentar->isi }}</td>
                    <td>{{ $komentar->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.komentar.destroy', $komentar->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada komentar.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $komentars->links() }}
</div>
@endsection
