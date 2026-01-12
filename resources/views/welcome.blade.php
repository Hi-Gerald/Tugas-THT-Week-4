@extends('layouts.app')

@section('title', 'Home - Lapor Pak!')

@section('content')
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-4">📢 Lapor Pak!</h1>
        <p class="lead mb-4">Sistem Pelaporan Keluhan Fasilitas Kampus</p>
        <p class="mb-4">Fasilitas rusak? AC panas? Wifi mati? Kursi patah?<br>Lapor langsung ke bagian yang tepat dan pantau status laporan Anda!</p>
        
        @if(Auth::check())
            <div class="row mt-5">
                <div class="col-md-4">
                    <a href="{{ route('tickets.index') }}" class="btn btn-light btn-lg">
                        📋 Lihat Laporan Saya
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('tickets.create') }}" class="btn btn-light btn-lg">
                        ➕ Buat Laporan Baru
                    </a>
                </div>
                @if(Auth::user()->is_admin)
                <div class="col-md-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-lg">
                        👨‍💼 Admin Dashboard
                    </a>
                </div>
                @endif
            </div>
        @else
            <div class="row mt-5">
                <div class="col-md-6">
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg me-2">
                        🔑 Login
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                        ✍️ Daftar
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">✨ Mudah Digunakan</h5>
                    <p class="card-text">Cukup isi form laporan dengan deskripsi, lokasi, dan foto bukti.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">🔍 Pantau Status</h5>
                    <p class="card-text">Lihat perkembangan laporan Anda dari Pending hingga Resolved.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">💬 Diskusi Langsung</h5>
                    <p class="card-text">Komunikasi dengan admin melalui fitur komentar pada setiap laporan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
