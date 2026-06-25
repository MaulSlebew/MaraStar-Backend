@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Data Master</p>
            <h1 class="font-display text-3xl font-bold tracking-tight text-zinc-900 md:text-4xl">Kategori</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola seluruh kategori produk di sini.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="button">+ Tambah Kategori</a>
    </div>

    <div class="rounded-xl border border-zinc-200 bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="font-display text-base font-bold text-zinc-900">Semua Kategori</h2>
            <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-500">
                {{ $categories->count() }} Item
            </span>
        </div>

        @if ($categories->isEmpty())
            <p class="py-10 text-center text-sm text-zinc-400">
                Belum ada kategori. Klik "Tambah Kategori" untuk membuat yang pertama.
            </p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-100 text-left text-xs uppercase tracking-wide text-zinc-400">
                            <th class="py-2 pr-4 font-medium">#</th>
                            <th class="py-2 pr-4 font-medium">Nama Kategori</th>
                            <th class="py-2 pr-4 font-medium">Slug</th>
                            <th class="py-2 pr-4 font-medium">Produk</th>
                            <th class="py-2 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b border-zinc-100 last:border-0 hover:bg-zinc-50">
                                <td class="py-3 pr-4 text-zinc-400">{{ $loop->iteration }}</td>
                                <td class="py-3 pr-4 font-medium text-zinc-800">{{ $category->nama_kategori }}</td>
                                <td class="py-3 pr-4">
                                    <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600">
                                        {{ $category->slug }}
                                    </span>
                                </td>
                                <td class="py-3 pr-4 text-zinc-600">
                                    {{ $category->products_count ?? $category->products()->count() }}
                                </td>
                                <td class="py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('categories.show', $category) }}" class="button secondary small">Lihat</a>
                                        <a href="{{ route('categories.edit', $category) }}" class="button secondary small">Edit</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button danger small" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (method_exists($categories, 'links'))
                <div class="mt-5">
                    {{ $categories->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection