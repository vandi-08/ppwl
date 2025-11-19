<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'kategori_id' => 'required|exists:categories,id',
        ]);

        // Upload foto
        $fotoPath = $request->file('foto')->store('products', 'public');

        // Simpan produk
        Product::create([
            'nama'        => $request->nama,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoPath,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'kategori_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);

        // Data untuk update
        $data = [
            'nama'        => $request->nama,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'deskripsi'   => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
        ];

        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($product->foto && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }

            // Upload foto baru
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        // Update data & foto jika ada
        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus foto
        if ($product->foto && Storage::disk('public')->exists($product->foto)) {
            Storage::disk('public')->delete($product->foto);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
