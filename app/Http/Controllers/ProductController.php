<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'sizes'])
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        return view('products.create', compact('categories', 'sizes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'status' => 'boolean',
            'images.*' => 'nullable|image|max:2048', // max 2MB
            'sizes' => 'nullable|array',
        ]);

        $product = Product::create([
            'category_id' => $validated['category_id'],
            'nama_produk' => $validated['nama_produk'],
            'slug' => $validated['slug'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'harga' => $validated['harga'],
            'status' => $request->boolean('status'),
        ]);

        $this->storeImages($product, $request);
        $this->syncSizes($product, $request->input('sizes', []));

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'sizes', 'images']);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $sizes = Size::all();
        $product->load(['sizes', 'images']);
        return view('products.edit', compact('product', 'categories', 'sizes'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug,' . $product->id,
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'status' => 'boolean',
            'images.*' => 'nullable|image|max:2048',
            'sizes' => 'nullable|array',
        ]);

        $product->update([
            'category_id' => $validated['category_id'],
            'nama_produk' => $validated['nama_produk'],
            'slug' => $validated['slug'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'harga' => $validated['harga'],
            'status' => $request->boolean('status'),
        ]);

        $this->storeImages($product, $request);
        $this->syncSizes($product, $request->input('sizes', []));

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Helper: ubah input form jadi format sync() dengan pivot stok.
     */
    private function syncSizes(Product $product, array $sizesInput): void
    {
        $syncData = [];

        foreach ($sizesInput as $sizeId => $data) {
            // hanya simpan size yang checkbox-nya dicentang
            if (!empty($data['checked'])) {
                $syncData[$sizeId] = ['stok' => (int) ($data['stok'] ?? 0)];
            }
        }

        $product->sizes()->sync($syncData);
    }

    private function storeImages(Product $product, Request $request): void
    {
        if (!$request->hasFile('images')) {
            return;
        }

        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public'); // tersimpan di storage/app/public/products

            $product->images()->create([
                'image_url' => $path,
            ]);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
