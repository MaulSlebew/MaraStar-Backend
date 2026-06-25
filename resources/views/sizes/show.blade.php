@extends('layouts.app')

@section('title', 'Detail Size')

@section('content')
    <div class="page-header">
        <div>
            <h1>Detail Size</h1>
            <p class="page-description">Detail ukuran dan produk yang menggunakan ukuran ini.</p>
        </div>
        <a href="{{ route('sizes.index') }}" class="button secondary">Kembali</a>
    </div>

    <div class="card">
        <dl style="display:grid; gap:1rem;">
            <div>
                <h2 class="label">Nama Ukuran</h2>
                <p>{{ $size->nama_ukuran }}</p>
            </div>
            <div>
                <h2 class="label">Total Produk</h2>
                <p>{{ $size->products()->count() }}</p>
            </div>
        </dl>
    </div>
@endsection
