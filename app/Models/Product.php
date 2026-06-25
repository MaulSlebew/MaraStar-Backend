<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama_produk',
        'slug',
        'deskripsi',
        'harga',
        'status',
        'brand',
        'gender',
        'berat',
    ];

    protected $casts = [
        'status' => 'boolean',
        'harga' => 'decimal:2',
        'berat' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(
            Size::class,
            'product_sizes'
        )->withPivot('stok')
        ->withTimestamps();;
    }
}