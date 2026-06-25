@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- PAGE HEADER --}}
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Control Deck</p>
            <h1 class="font-display text-3xl font-bold tracking-tight text-zinc-900 md:text-4xl">Dashboard</h1>
            <p class="mt-1 text-sm text-zinc-500">Ringkasan kategori, produk, dan ukuran toko kamu.</p>
        </div>
        <a href="{{ route('products.create') }}" class="button">+ Tambah Produk</a>
    </div>

    {{-- ===================== STAT CARDS ===================== --}}
    <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-3">
        {{-- KATEGORI --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6">
            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-zinc-100">
                <svg class="h-5 w-5 text-zinc-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </div>
            <p class="mt-4 text-sm text-zinc-500">Kategori</p>
            <p class="font-display text-3xl font-bold text-zinc-900">{{ $categoriesCount }}</p>
        </div>

        {{-- PRODUK --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6">
            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-zinc-100">
                <svg class="h-5 w-5 text-zinc-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <p class="mt-4 text-sm text-zinc-500">Produk</p>
            <p class="font-display text-3xl font-bold text-zinc-900">{{ $productsCount }}</p>
        </div>

        {{-- SIZE --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6">
            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-zinc-100">
                <svg class="h-5 w-5 text-zinc-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
            </div>
            <p class="mt-4 text-sm text-zinc-500">Ukuran</p>
            <p class="font-display text-3xl font-bold text-zinc-900">{{ $sizesCount }}</p>
        </div>
    </div>

    {{-- ===================== LATEST DATA GRID ===================== --}}
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
        {{-- LATEST PRODUK — kolom lebih besar --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 lg:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="font-display text-base font-bold text-zinc-900">Produk Terbaru</h2>
                    <p class="text-xs text-zinc-400">Produk yang baru saja ditambahkan</p>
                </div>
                <a href="{{ route('products.index') }}" class="text-xs font-semibold uppercase tracking-wide text-zinc-500 hover:text-zinc-900">
                    Lihat Semua →
                </a>
            </div>

            @if ($latestProducts->isEmpty())
                <p class="py-8 text-center text-sm text-zinc-400">Belum ada produk.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-zinc-100 text-left text-xs uppercase tracking-wide text-zinc-400">
                                <th class="py-2 pr-4 font-medium">Produk</th>
                                <th class="py-2 pr-4 font-medium">Kategori</th>
                                <th class="py-2 pr-4 font-medium">Harga</th>
                                <th class="py-2 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestProducts as $product)
                                <tr class="border-b border-zinc-100 last:border-0 hover:bg-zinc-50">
                                    <td class="py-3 pr-4 font-medium text-zinc-800">{{ $product->nama_produk }}</td>
                                    <td class="py-3 pr-4 text-zinc-500">{{ $product->category?->nama_kategori ?? '—' }}</td>
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

        {{-- LATEST KATEGORI --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="font-display text-base font-bold text-zinc-900">Kategori Terbaru</h2>
                <a href="{{ route('categories.index') }}" class="text-xs font-semibold uppercase tracking-wide text-zinc-500 hover:text-zinc-900">
                    Semua
                </a>
            </div>

            @if ($latestCategories->isEmpty())
                <p class="py-6 text-center text-sm text-zinc-400">Belum ada kategori.</p>
            @else
                <ul class="divide-y divide-zinc-100">
                    @foreach ($latestCategories as $index => $category)
                        <li class="flex items-center gap-3 py-3">
                            <span class="flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full bg-zinc-100 text-xs font-bold text-zinc-500">
                                {{ $index + 1 }}
                            </span>
                            <div>
                                <p class="text-sm font-medium text-zinc-800">{{ $category->nama_kategori }}</p>
                                <p class="text-xs text-zinc-400">{{ $category->slug }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- LATEST SIZE — strip horizontal di bawah --}}
    <div class="mt-5 rounded-xl border border-zinc-200 bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="font-display text-base font-bold text-zinc-900">Ukuran Terbaru</h2>
            <a href="{{ route('sizes.index') }}" class="text-xs font-semibold uppercase tracking-wide text-zinc-500 hover:text-zinc-900">
                Lihat Semua →
            </a>
        </div>

        @if ($latestSizes->isEmpty())
            <p class="py-4 text-center text-sm text-zinc-400">Belum ada ukuran.</p>
        @else
            <div class="flex flex-wrap gap-3">
                @foreach ($latestSizes as $size)
                    <span class="rounded-lg border border-zinc-200 bg-zinc-50 px-4 py-2 text-sm font-semibold text-zinc-700">
                        {{ $size->nama_ukuran }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>
@endsection