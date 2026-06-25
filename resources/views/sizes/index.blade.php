@extends('layouts.app')

@section('title', 'Size')

@section('content')
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Data Master</p>
            <h1 class="font-display text-3xl font-bold tracking-tight text-zinc-900 md:text-4xl">Size</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola daftar ukuran yang tersedia untuk produk.</p>
        </div>
        <a href="{{ route('sizes.create') }}" class="button">+ Tambah Size</a>
    </div>

    <div class="rounded-xl border border-zinc-200 bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="font-display text-base font-bold text-zinc-900">Semua Ukuran</h2>
            <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-500">
                {{ $sizes->count() }} Item
            </span>
        </div>

        @if ($sizes->isEmpty())
            <p class="py-10 text-center text-sm text-zinc-400">
                Belum ada ukuran. Klik "Tambah Size" untuk membuat yang pertama.
            </p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-100 text-left text-xs uppercase tracking-wide text-zinc-400">
                            <th class="py-2 pr-4 font-medium">#</th>
                            <th class="py-2 pr-4 font-medium">Nama Ukuran</th>
                            <th class="py-2 pr-4 font-medium">Dipakai di Produk</th>
                            <th class="py-2 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sizes as $size)
                            <tr class="border-b border-zinc-100 last:border-0 hover:bg-zinc-50">
                                <td class="py-3 pr-4 text-zinc-400">{{ $loop->iteration }}</td>
                                <td class="py-3 pr-4 font-medium text-zinc-800">{{ $size->nama_ukuran }}</td>
                                <td class="py-3 pr-4 text-zinc-600">
                                    {{ $size->products_count ?? $size->products()->count() }} produk
                                </td>
                                <td class="py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('sizes.edit', $size) }}" class="button secondary small">Edit</a>
                                        <form action="{{ route('sizes.destroy', $size) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button danger small" onclick="return confirm('Hapus ukuran ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (method_exists($sizes, 'links'))
                <div class="mt-5">
                    {{ $sizes->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection