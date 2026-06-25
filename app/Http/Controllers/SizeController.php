<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::withCount('products')->latest()->get();

        return view('sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('sizes.create');
    }

    public function show(Size $size)
    {
        return view('sizes.show', compact('size'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ukuran' => 'required|max:10',
        ]);

        Size::create([
            'nama_ukuran' => $request->nama_ukuran,
        ]);

        return redirect()
            ->route('sizes.index')
            ->with('success', 'Ukuran berhasil ditambahkan');
    }

    public function edit(Size $size)
    {
        return view('sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'nama_ukuran' => 'required|max:10',
        ]);

        $size->update([
            'nama_ukuran' => $request->nama_ukuran,
        ]);

        return redirect()
            ->route('sizes.index')
            ->with('success', 'Ukuran berhasil diupdate');
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return redirect()
            ->route('sizes.index')
            ->with('success', 'Ukuran berhasil dihapus');
    }
}