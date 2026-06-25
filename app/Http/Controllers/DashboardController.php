<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'categoriesCount' => Category::count(),
            'productsCount' => Product::count(),
            'sizesCount' => Size::count(),
            'latestCategories' => Category::latest()->limit(5)->get(),
            'latestProducts' => Product::with('category')->latest()->limit(5)->get(),
            'latestSizes' => Size::latest()->limit(5)->get(),
        ]);
    }
}
