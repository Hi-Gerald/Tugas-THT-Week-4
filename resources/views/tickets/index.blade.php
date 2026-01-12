@extends('layouts.app') {{-- jika kamu pakai layout utama --}}

@section('content')
<div class="container">
    <h2>Daftar Laporan Tiket</h2>

    {{-- tampilkan pesan sukses jika ada --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->description }}</td>
                <td>{{ $ticket->location }}</td>
                <td>{{ $ticket->category->name ?? '-' }}</td>
                <td>
                    <span class="badge 
                        @if($ticket->status == 'Pending') bg-danger 
                        @elseif($ticket->status == 'In Progress') bg-warning 
                        @else bg-success @endif">
                        {{ $ticket->status }}
                    </span>
                </td>
                <td>{{ $ticket->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
