@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mb-1 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Data Master</p>
            <h1 class="font-display text-3xl font-bold tracking-tight text-zinc-900 md:text-4xl">Tambah Produk</h1>
            <p class="mt-1 text-sm text-zinc-500">Lengkapi data produk beserta ukuran dan stoknya.</p>
        </div>
        <a href="{{ route('products.index') }}" class="button secondary">← Kembali</a>
    </div>

    <div class="max-w-2xl rounded-xl border border-zinc-200 bg-white p-6">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                    value="{{ old('nama_produk') }}"
                    placeholder="Misal: Boxy Heavyweight Tee"
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
                    value="{{ old('slug') }}"
                    placeholder="boxy-heavyweight-tee"
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
                    placeholder="Deskripsi material, potongan, dan keunggulan produk..."
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none"
                >{{ old('deskripsi') }}</textarea>
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
                    value="{{ old('harga') }}"
                    placeholder="249000"
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
                        {{ old('status', true) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900"
                    >
                    Aktifkan produk (tampil di toko)
                </label>
            </div>

            {{-- ===== FOTO PRODUK ===== --}}
            <div class="mb-6">
                <label for="images" class="mb-1.5 block text-sm font-semibold text-zinc-700">Foto Produk</label>
                <input
                    type="file"
                    name="images[]"
                    id="images"
                    accept="image/*"
                    multiple
                    class="w-full rounded-lg border border-zinc-300 px-4 py-2.5 text-sm text-zinc-700 file:mr-3 file:rounded-md file:border-0 file:bg-zinc-100 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-zinc-700 hover:file:bg-zinc-200 focus:border-zinc-900 focus:outline-none"
                >
                <p class="mt-1.5 text-xs text-zinc-400">Bisa pilih lebih dari satu foto. Format JPG/PNG, maksimal 2MB per foto.</p>
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
                            <div class="flex items-center gap-4 rounded-lg border border-zinc-200 px-4 py-3">
                                <label class="flex min-w-[90px] items-center gap-2 text-sm font-semibold text-zinc-700">
                                    <input
                                        type="checkbox"
                                        name="sizes[{{ $size->id }}][checked]"
                                        value="1"
                                        {{ in_array($size->id, old('sizes', [])) ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900"
                                    >
                                    {{ $size->nama_ukuran }}
                                </label>
                                <input
                                    type="number"
                                    name="sizes[{{ $size->id }}][stok]"
                                    min="0"
                                    value="{{ old('sizes.' . $size->id . '.stok', 0) }}"
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
                <button type="submit" class="button">Simpan Produk</button>
                <a href="{{ route('products.index') }}" class="button secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection