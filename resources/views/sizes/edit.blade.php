@extends('layouts.app')

@section('title', 'Edit Size')

@section('content')
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Data Master</p>
            <h1 class="font-display text-3xl font-bold tracking-tight text-zinc-900 md:text-4xl">Edit Size</h1>
            <p class="mt-1 text-sm text-zinc-500">Perbarui nama ukuran.</p>
        </div>
        <a href="{{ route('sizes.index') }}" class="button secondary">← Kembali</a>
    </div>

    <div class="max-w-md rounded-xl border border-zinc-200 bg-white p-6">
        <form action="{{ route('sizes.update', $size) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="nama_ukuran" class="mb-1.5 block text-sm font-semibold text-zinc-700">Nama Ukuran</label>
                <input
                    type="text"
                    name="nama_ukuran"
                    id="nama_ukuran"
                    value="{{ old('nama_ukuran', $size->nama_ukuran) }}"
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none"
                    required
                >
                @error('nama_ukuran')
                    <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="button">Simpan Perubahan</button>
                <a href="{{ route('sizes.index') }}" class="button secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection