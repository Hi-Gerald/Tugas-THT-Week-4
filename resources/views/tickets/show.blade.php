@extends('layouts.app')

@section('title', $ticket->title . ' - Lapor Pak!')

@section('content')
<div class="container">
    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary mb-3">← Kembali ke Daftar</a>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="card-title">{{ $ticket->title }}</h2>
                            <p class="card-text text-muted">
                                <strong>Tiket ID:</strong> #{{ $ticket->id }} | 
                                <strong>Dibuat:</strong> {{ $ticket->created_at->format('d M Y H:i') }}
                            </p>
                        </div>
                        @php
                            $badgeClass = match($ticket->status) {
                                'Pending' => 'badge-pending',
                                'In Progress' => 'badge-in-progress',
                                'Resolved' => 'badge-resolved',
                                default => 'badge-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} fs-6">{{ $ticket->status }}</span>
                    </div>

                    <hr>

                    @if($ticket->image_path)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $ticket->image_path) }}" alt="{{ $ticket->title }}" class="img-fluid rounded" style="max-height: 400px;">
                        </div>
                    @endif

                    <div class="info-section mb-4">
                        <h5>📋 Informasi Laporan</h5>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>📁 Kategori:</strong></td>
                                <td>{{ $ticket->category->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>📍 Lokasi:</strong></td>
                                <td>{{ $ticket->location }}</td>
                            </tr>
                            <tr>
                                <td><strong>👤 Pelapor:</strong></td>
                                <td>{{ $ticket->user->name }} ({{ $ticket->user->email }})</td>
                            </tr>
                            <tr>
                                <td><strong>📅 Waktu Lapor:</strong></td>
                                <td>{{ $ticket->created_at->format('d M Y H:i:s') }}</td>
                            </tr>
                            @if($ticket->updated_at != $ticket->created_at)
                            <tr>
                                <td><strong>🔄 Update Terakhir:</strong></td>
                                <td>{{ $ticket->updated_at->format('d M Y H:i:s') }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                    <div class="description-section mb-4">
                        <h5>📝 Deskripsi Masalah</h5>
                        <p class="border-start ps-3 py-2">{{ $ticket->description }}</p>
                    </div>

                    @if(Auth::user()->is_admin)
                    <div class="admin-section border-top pt-3">
                        <h5>👨‍💼 Kontrol Admin</h5>
                        <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}" class="d-flex gap-2 align-items-end">
                            @csrf
                            @method('PATCH')
                            <div class="flex-grow-1">
                                <label for="status" class="form-label">Ubah Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Pending" {{ $ticket->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Resolved" {{ $ticket->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning">Update Status</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">💬 Komentar ({{ $ticket->comments->count() }})</h5>
                </div>
                <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                    @forelse($ticket->comments as $comment)
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <strong>
                                    @if($comment->user->is_admin)
                                        👨‍💼 {{ $comment->user->name }}
                                    @else
                                        👤 {{ $comment->user->name }}
                                    @endif
                                </strong>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0 mt-2 small">{{ $comment->message }}</p>
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada komentar</p>
                    @endforelse
                </div>

                <div class="card-footer bg-light">
                    <form method="POST" action="{{ route('comments.store', $ticket) }}">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name="message" placeholder="Tulis komentar..." required>
                            <button class="btn btn-outline-primary" type="submit">Kirim</button>
                        </div>
                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
