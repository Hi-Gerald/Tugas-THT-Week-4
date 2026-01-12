@extends('layouts.app') {{-- kalau kamu pakai layout utama --}}

@section('content')
<div class="container">
    <h2>Buat Laporan Baru</h2>

    {{-- tampilkan pesan sukses jika ada --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Judul" value="{{ old('title') }}">
        <textarea name="description">{{ old('description') }}</textarea>
        <input type="text" name="location" value="{{ old('location') }}">

        <select name="category_id">
            @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>

        <input type="file" name="image">
        <button type="submit">Laporkan</button>
    </form>
</div>
@endsection
