<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ─── Tampilkan Semua Data ───────────────────────────
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'success' => true,
            'data'    => $products,
        ]);
    }

    // ─── Tambah Data ────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'sku'       => 'required|string|unique:products,sku',
            'price'     => 'required|numeric|min:0',
            'stock'     => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan.',
            'data'    => $product,
        ], 201);
    }

    // ─── Tampilkan Satu Data ─────────────────────────────
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $product,
        ]);
    }

    // ─── Ubah Data ───────────────────────────────────────
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'name'      => 'sometimes|required|string|max:255',
            'sku'       => 'sometimes|required|string|unique:products,sku,' . $id,
            'price'     => 'sometimes|required|numeric|min:0',
            'stock'     => 'sometimes|required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui.',
            'data'    => $product,
        ]);
    }

    // ─── Hapus Data ──────────────────────────────────────
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan.',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus.',
        ]);
    }
}