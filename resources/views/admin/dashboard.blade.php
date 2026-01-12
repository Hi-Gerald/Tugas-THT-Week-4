@extends('layouts.app')

@section('title', 'Admin Dashboard - Lapor Pak!')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2>👨‍💼 Admin Dashboard</h2>
        <p class="text-muted">Kelola semua laporan keluhan fasilitas kampus</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">📊 Total Laporan</h5>
                    <h2 class="text-primary">{{ $stats['total'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">⏳ Pending</h5>
                    <h2 class="text-danger">{{ $stats['pending'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">⚙️ In Progress</h5>
                    <h2 class="text-warning">{{ $stats['in_progress'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">✅ Resolved</h5>
                    <h2 class="text-success">{{ $stats['resolved'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Tickets Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">📋 Semua Laporan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Pelapor</th>
                            <th>Status</th>
                            <th>Komentar</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr>
                                <td><strong>#{{ $ticket->id }}</strong></td>
                                <td>{{ Str::limit($ticket->title, 30) }}</td>
                                <td>{{ $ticket->category->name }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>
                                    @php
                                        $badgeClass = match($ticket->status) {
                                            'Pending' => 'badge-pending',
                                            'In Progress' => 'badge-in-progress',
                                            'Resolved' => 'badge-resolved',
                                            default => 'badge-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $ticket->status }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $ticket->comments->count() }}</span>
                                </td>
                                <td><small>{{ $ticket->created_at->format('d M Y') }}</small></td>
                                <td>
                                    <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-info">
                                        👁️ Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada laporan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
