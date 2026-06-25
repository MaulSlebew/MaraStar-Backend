@extends('layouts.app')

@section('title', $product->nama_produk)

@section('content')
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Data Master</p>
            <h1 class="font-display text-3xl font-bold tracking-tight text-zinc-900 md:text-4xl">{{ $product->nama_produk }}</h1>
            <p class="mt-1 text-sm text-zinc-500">{{ $product->category?->nama_kategori ?? 'Kategori tidak tersedia' }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('products.edit', $product) }}" class="button secondary">Edit</a>
            <a href="{{ route('products.index') }}" class="button secondary">← Kembali</a>
        </div>
    </div>

    <div class="mb-5 rounded-xl border border-zinc-200 bg-white p-6">
        <h2 class="mb-4 font-display text-base font-bold text-zinc-900">Foto Produk</h2>

        @if ($product->images->isEmpty())
            <p class="py-6 text-center text-sm text-zinc-400">Belum ada foto untuk produk ini.</p>
        @else
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach ($product->images as $image)
                    <div class="aspect-square overflow-hidden rounded-lg border border-zinc-200 bg-zinc-100">
                        <img
                            src="{{ asset('storage/' . $image->image_url) }}"
                            alt="{{ $product->nama_produk }}"
                            class="h-full w-full object-cover"
                        >
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
        {{-- INFO UTAMA --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 lg:col-span-2">
            @if ($product->status)
                <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">Aktif</span>
            @else
                <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-semibold text-zinc-500">Nonaktif</span>
            @endif

            <p class="mt-4 text-xs font-semibold uppercase tracking-wide text-zinc-400">Harga</p>
            <p class="font-display text-3xl font-bold text-zinc-900">
                Rp{{ number_format($product->harga, 0, ',', '.') }}
            </p>

            <p class="mt-5 text-xs font-semibold uppercase tracking-wide text-zinc-400">Deskripsi</p>
            <p class="mt-1.5 text-sm leading-relaxed text-zinc-600">
                {{ $product->deskripsi ?: 'Belum ada deskripsi untuk produk ini.' }}
            </p>

            <p class="mt-5 text-xs font-semibold uppercase tracking-wide text-zinc-400">Slug</p>
            <span class="mt-1.5 inline-block rounded-full bg-zinc-100 px-3 py-1 text-sm font-medium text-zinc-600">
                {{ $product->slug }}
            </span>
        </div>

        {{-- UKURAN & STOK --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6">
            <h2 class="mb-4 font-display text-base font-bold text-zinc-900">Ukuran &amp; Stok</h2>

            @if ($product->sizes->isEmpty())
                <p class="py-6 text-center text-sm text-zinc-400">Belum ada ukuran yang diatur untuk produk ini.</p>
            @else
                <ul class="divide-y divide-zinc-100">
                    @foreach ($product->sizes as $size)
                        <li class="flex items-center justify-between py-3">
                            <span class="text-sm font-semibold text-zinc-800">{{ $size->nama_ukuran }}</span>
                            @if ($size->pivot->stok > 0)
                                <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-semibold text-zinc-600">
                                    {{ $size->pivot->stok }} pcs
                                </span>
                            @else
                                <span class="rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-600">
                                    Habis
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4 border-t border-zinc-100 pt-4">
                    <p class="text-xs text-zinc-400">Total stok</p>
                    <p class="font-display text-xl font-bold text-zinc-900">
                        {{ $product->sizes->sum('pivot.stok') }} pcs
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection