<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query('keyword', '');
        $products = Product::where('name', 'like', "%{$keyword}%")
            ->orWhere('price', 'like', "%{$keyword}%")
            ->orWhere('stock', 'like', "%{$keyword}%")
            ->orderBy('price', 'desc')
            // ->orderBy('name', 'desc')
            // ->orderBy('stock', 'desc')
            // ->orderBy('image', 'desc')
            ->paginate(5);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        return response()->json(['message' => 'product created'], 201);
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|max:50',
            'stock' => 'required|integer|min:0',
            'image' => 'required',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'image' => 'Gambar harus berupa link.',
        ]);
        $products = new Product($request->all());
        $products->create([
            $products->name = $request->input('name'),
            $products->price = $request->input('price'),
            $products->stock = $request->input('stock'),
            $products->image = $request->input('image'),
        ]);
        return response()->json(['message' => 'product created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::findOrFail($id);
        return response()->json($products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required',
        ]);
        $products = Product::find($id);
        if (!$products) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $products->update($validatedData);
        return response()->json(['message' => 'product updated', 'product' => $products]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Product::findOrFail($id);
        $products->delete();

        return response()->json(['message' => 'product deleted'], 200);
    }
}
