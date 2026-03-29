<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['seller:id,name,avatar', 'category:id,name,slug'])
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:product_categories,id',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'sale_price'  => 'nullable|numeric|min:0',
            'type'        => 'required|in:digital,physical',
            'stock'       => 'nullable|integer',
            'thumbnail'   => 'nullable|string',
            'status'      => 'required|in:pending,active,inactive',
        ]);

        $product = Product::create([
            ...$data,
            'seller_id' => $request->user()->id,
            'slug'      => Str::slug($data['title']) . '-' . Str::random(5),
        ]);

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product->load(['seller', 'category', 'reviews']));
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'category_id' => 'nullable|exists:product_categories,id',
            'description' => 'sometimes|string',
            'price'       => 'sometimes|numeric|min:0',
            'sale_price'  => 'nullable|numeric|min:0',
            'type'        => 'sometimes|in:digital,physical',
            'stock'       => 'nullable|integer',
            'thumbnail'   => 'nullable|string',
            'status'      => 'sometimes|in:pending,active,inactive',
        ]);

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);
        }

        $product->update($data);
        return response()->json($product);
    }

    public function destroy(int $id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Product deleted successfully.']);
    }

    public function categories()
    {
        return response()->json(ProductCategory::all());
    }
}
