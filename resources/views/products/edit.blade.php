@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Data Master</p>
            <h1 class="font-display text-3xl font-bold tracking-tight text-zinc-900 md:text-4xl">Edit Produk</h1>
            <p class="mt-1 text-sm text-zinc-500">Perbarui data produk beserta ukuran dan stoknya.</p>
        </div>
        <a href="{{ route('products.index') }}" class="button secondary">← Kembali</a>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-6">
        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="category_id" class="mb-1.5 block text-sm font-semibold text-zinc-700">Kategori</label>
                <select
                    name="category_id"
                    id="category_id"
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none"
                    required
                >
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="nama_produk" class="mb-1.5 block text-sm font-semibold text-zinc-700">Nama Produk</label>
                <input
                    type="text"
                    name="nama_produk"
                    id="nama_produk"
                    value="{{ old('nama_produk', $product->nama_produk) }}"
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none"
                    required
                >
                @error('nama_produk')
                    <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="slug" class="mb-1.5 block text-sm font-semibold text-zinc-700">Slug</label>
                <input
                    type="text"
                    name="slug"
                    id="slug"
                    value="{{ old('slug', $product->slug) }}"
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none"
                    required
                >
                <p class="mt-1.5 text-xs text-zinc-400">Dipakai untuk URL, gunakan huruf kecil dan tanda hubung (-).</p>
                @error('slug')
                    <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="deskripsi" class="mb-1.5 block text-sm font-semibold text-zinc-700">Deskripsi</label>
                <textarea
                    name="deskripsi"
                    id="deskripsi"
                    rows="4"
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none"
                >{{ old('deskripsi', $product->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="harga" class="mb-1.5 block text-sm font-semibold text-zinc-700">Harga (Rp)</label>
                <input
                    type="number"
                    name="harga"
                    id="harga"
                    value="{{ old('harga', $product->harga) }}"
                    min="0"
                    step="0.01"
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none"
                    required
                >
                @error('harga')
                    <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center gap-2.5 text-sm font-medium text-zinc-700">
                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        {{ old('status', $product->status) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900"
                    >
                    Aktifkan produk (tampil di toko)
                </label>
            </div>

            {{-- ===== FOTO PRODUK ===== --}}
            <div class="mb-6">
                <label class="mb-2 block text-sm font-semibold text-zinc-700">Foto Produk</label>

                @if ($product->images->isNotEmpty())
                    <div class="mb-4 grid grid-cols-3 gap-3 sm:grid-cols-4">
                        @foreach ($product->images as $image)
                            <div class="group relative aspect-square overflow-hidden rounded-lg border border-zinc-200 bg-zinc-100">
                                <img
                                    src="{{ asset('storage/' . $image->image_url) }}"
                                    alt="{{ $product->nama_produk }}"
                                    class="h-full w-full object-cover"
                                >
                                <button
                                    type="submit"
                                    form="delete-image-{{ $image->id }}"
                                    class="absolute right-1.5 top-1.5 flex h-6 w-6 items-center justify-center rounded-full bg-red-600 text-xs font-bold text-white shadow hover:bg-red-700"
                                    title="Hapus foto"
                                >
                                    ✕
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mb-3 text-sm text-zinc-400">Belum ada foto untuk produk ini.</p>
                @endif

                <input
                    type="file"
                    name="images[]"
                    id="images"
                    accept="image/*"
                    multiple
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5 text-sm text-zinc-700 file:mr-3 file:rounded-md file:border-0 file:bg-zinc-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-zinc-700 hover:file:bg-zinc-200 focus:border-zinc-900 focus:outline-none"
                >
                <p class="mt-1.5 text-xs text-zinc-400">Tambah foto baru di sini. Foto lama tidak akan terhapus kecuali diklik tombol ✕ di atas.</p>
                @error('images.*')
                    <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===== UKURAN & STOK ===== --}}
            <div class="mb-6">
                <label class="mb-2 block text-sm font-semibold text-zinc-700">Ukuran &amp; Stok</label>

                @if ($sizes->isEmpty())
                    <p class="text-sm text-zinc-400">Belum ada data ukuran. Tambahkan ukuran terlebih dahulu di menu Size.</p>
                @else
                    <div class="space-y-3">
                        @foreach ($sizes as $size)
                            @php
                                $existing = $product->sizes->firstWhere('id', $size->id);
                            @endphp
                            <div class="flex items-center gap-4 rounded-lg border border-zinc-200 px-4 py-3">
                                <label class="flex min-w-[90px] items-center gap-2 text-sm font-semibold text-zinc-700">
                                    <input
                                        type="checkbox"
                                        name="sizes[{{ $size->id }}][checked]"
                                        value="1"
                                        {{ $existing ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900"
                                    >
                                    {{ $size->nama_ukuran }}
                                </label>
                                <input
                                    type="number"
                                    name="sizes[{{ $size->id }}][stok]"
                                    min="0"
                                    value="{{ old('sizes.' . $size->id . '.stok', $existing?->pivot->stok ?? 0) }}"
                                    placeholder="Stok"
                                    class="max-w-[140px] rounded-lg border border-zinc-300 px-3 py-2 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none"
                                >
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-2 text-xs text-zinc-400">Centang ukuran yang tersedia, lalu isi jumlah stoknya.</p>
                @endif
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="button">Simpan Perubahan</button>
                <a href="{{ route('products.index') }}" class="button secondary">Batal</a>
            </div>
        </form>

        @if ($product->images->isNotEmpty())
            @foreach ($product->images as $image)
                <form
                    id="delete-image-{{ $image->id }}"
                    action="{{ route('product-images.destroy', $image) }}"
                    method="POST"
                    class="hidden"
                    onsubmit="return confirm('Hapus foto ini?')"
                >
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        @endif
    </div>
@endsection