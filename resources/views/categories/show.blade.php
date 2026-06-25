@extends('layouts.app')

@section('title', $category->nama_kategori)

@section('content')
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Data Master</p>
            <h1 class="font-display text-3xl font-bold tracking-tight text-zinc-900 md:text-4xl">{{ $category->nama_kategori }}</h1>
            <p class="mt-1 text-sm text-zinc-500">Detail kategori dan produk yang terhubung.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('categories.edit', $category) }}" class="button secondary">Edit</a>
            <a href="{{ route('categories.index') }}" class="button secondary">← Kembali</a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
        {{-- INFO --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6">
            <p class="text-xs font-semibold uppercase tracking-wide text-zinc-400">Slug</p>
            <span class="mt-1.5 inline-block rounded-full bg-zinc-100 px-3 py-1 text-sm font-medium text-zinc-600">
                {{ $category->slug }}
            </span>

            <p class="mt-5 text-xs font-semibold uppercase tracking-wide text-zinc-400">Total Produk</p>
            <p class="mt-1 font-display text-2xl font-bold text-zinc-900">{{ $category->products->count() }}</p>
        </div>

        {{-- DAFTAR PRODUK --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 lg:col-span-2">
            <h2 class="mb-4 font-display text-base font-bold text-zinc-900">Produk dalam Kategori Ini</h2>

            @if ($category->products->isEmpty())
                <p class="py-8 text-center text-sm text-zinc-400">Belum ada produk di kategori ini.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-zinc-100 text-left text-xs uppercase tracking-wide text-zinc-400">
                                <th class="py-2 pr-4 font-medium">Nama Produk</th>
                                <th class="py-2 pr-4 font-medium">Harga</th>
                                <th class="py-2 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->products as $product)
                                <tr class="border-b border-zinc-100 last:border-0 hover:bg-zinc-50">
                                    <td class="py-3 pr-4 font-medium text-zinc-800">{{ $product->nama_produk }}</td>
                                    <td class="py-3 pr-4 text-zinc-700">Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td class="py-3">
                                        @if ($product->status)
                                            <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">Aktif</span>
                                        @else
                                            <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-semibold text-zinc-500">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection