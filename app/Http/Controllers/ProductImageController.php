<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function destroy(ProductImage $productImage)
    {
        Storage::disk('public')->delete($productImage->image_url);
        $productImage->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}