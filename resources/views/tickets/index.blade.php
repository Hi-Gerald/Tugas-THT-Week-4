@extends('layouts.app')

@section('title', 'Daftar Laporan - Lapor Pak!')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h3>📋 Daftar Laporan</h3>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('tickets.create') }}" class="btn btn-primary">➕ Buat Laporan Baru</a>
        </div>
    </div>

    @if($tickets->isEmpty())
        <div class="alert alert-info text-center">
            <p>📭 Belum ada laporan. <a href="{{ route('tickets.create') }}">Buat laporan pertama Anda sekarang!</a></p>
        </div>
    @else
        <div class="row">
            @foreach($tickets as $ticket)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        @if($ticket->image_path)
                            <img src="{{ asset('storage/' . $ticket->image_path) }}" class="card-img-top" alt="{{ $ticket->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-muted">📷 Tidak ada foto</span>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title">{{ $ticket->title }}</h5>
                                @php
                                    $badgeClass = match($ticket->status) {
                                        'Pending' => 'badge-pending',
                                        'In Progress' => 'badge-in-progress',
                                        'Resolved' => 'badge-resolved',
                                        default => 'badge-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $ticket->status }}</span>
                            </div>
                            
                            <p class="card-text small text-muted">
                                <strong>📁 Kategori:</strong> {{ $ticket->category->name }}<br>
                                <strong>📍 Lokasi:</strong> {{ $ticket->location }}<br>
                                <strong>👤 Pelapor:</strong> {{ $ticket->user->name }}<br>
                                <strong>📅 Tanggal:</strong> {{ $ticket->created_at->format('d M Y H:i') }}
                            </p>

                            <p class="card-text">{{ Str::limit($ticket->description, 100) }}</p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-info">
                                    👁️ Lihat Detail
                                </a>
                                <span class="text-muted small">
                                    💬 {{ $ticket->comments->count() }} komentar
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
