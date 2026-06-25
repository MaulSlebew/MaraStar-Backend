@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Data Master</p>
            <h1 class="font-display text-3xl font-bold tracking-tight text-zinc-900 md:text-4xl">Produk</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola seluruh produk, harga, dan stok ukurannya.</p>
        </div>
        <a href="{{ route('products.create') }}" class="button">+ Tambah Produk</a>
    </div>

    <div class="rounded-xl border border-zinc-200 bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="font-display text-base font-bold text-zinc-900">Semua Produk</h2>
            <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-500">
                {{ $products->count() }} Item
            </span>
        </div>

        @if ($products->isEmpty())
            <p class="py-10 text-center text-sm text-zinc-400">
                Belum ada produk. Klik "Tambah Produk" untuk membuat yang pertama.
            </p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-100 text-left text-xs uppercase tracking-wide text-zinc-400">
                            <th class="py-2 pr-4 font-medium">#</th>
                            <th class="py-2 pr-4 font-medium">Nama Produk</th>
                            <th class="py-2 pr-4 font-medium">Kategori</th>
                            <th class="py-2 pr-4 font-medium">Harga</th>
                            <th class="py-2 pr-4 font-medium">Ukuran</th>
                            <th class="py-2 pr-4 font-medium">Status</th>
                            <th class="py-2 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="border-b border-zinc-100 last:border-0 hover:bg-zinc-50">
                                <td class="py-3 pr-4 text-zinc-400">{{ $loop->iteration }}</td>
                                <td class="py-3 pr-4 font-medium text-zinc-800">{{ $product->nama_produk }}</td>
                                <td class="py-3 pr-4 text-zinc-500">
                                    {{ $product->category?->nama_kategori ?? '—' }}
                                </td>
                                <td class="py-3 pr-4 text-zinc-700">
                                    Rp{{ number_format($product->harga, 0, ',', '.') }}
                                </td>
                                <td class="py-3 pr-4">
                                    @if ($product->sizes->isEmpty())
                                        <span class="text-xs text-zinc-400">—</span>
                                    @else
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($product->sizes as $size)
                                                <span class="rounded bg-zinc-100 px-1.5 py-0.5 text-[11px] font-semibold text-zinc-600">
                                                    {{ $size->nama_ukuran }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 pr-4">
                                    @if ($product->status)
                                        <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">Aktif</span>
                                    @else
                                        <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-semibold text-zinc-500">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('products.show', $product) }}" class="button secondary small">Lihat</a>
                                        <a href="{{ route('products.edit', $product) }}" class="button secondary small">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button danger small" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (method_exists($products, 'links'))
                <div class="mt-5">
                    {{ $products->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection