<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarketplaceController extends Controller
{
    // Public: list active products
    public function index(Request $request)
    {
        $products = Product::active()
            ->with(['seller:id,name,avatar', 'category:id,name,slug'])
            ->when($request->category, fn($q) => $q->whereHas('category', fn($q2) => $q2->where('slug', $request->category)))
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->orderByDesc('created_at')
            ->paginate(12);

        return response()->json($products);
    }

    // Public: single product
    public function show(string $slug)
    {
        $product = Product::active()
            ->with(['seller:id,name,avatar', 'category', 'reviews' => fn($q) => $q->where('approved', true)->with('user:id,name,avatar')])
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($product);
    }

    // Public: categories
    public function categories()
    {
        return response()->json(ProductCategory::withCount('products')->get());
    }

    // Public: submit review (auth required)
    public function storeReview(Request $request, int $id)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'body'   => 'nullable|string|max:2000',
        ]);

        $product = Product::findOrFail($id);

        $review = Review::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => $request->user()->id],
            [...$data, 'approved' => false]
        );

        return response()->json(['message' => 'Review submitted and awaiting approval.', 'review' => $review], 201);
    }

    // Seller: create product
    public function sellerStore(Request $request)
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
        ]);

        $product = Product::create([
            ...$data,
            'seller_id' => $request->user()->id,
            'slug'      => Str::slug($data['title']) . '-' . Str::random(5),
            'status'    => 'pending',
        ]);

        return response()->json($product, 201);
    }

    // Seller: update own product
    public function sellerUpdate(Request $request, int $id)
    {
        $product = Product::where('id', $id)
            ->where('seller_id', $request->user()->id)
            ->firstOrFail();

        $product->update($request->validate([
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price'       => 'sometimes|numeric|min:0',
            'sale_price'  => 'nullable|numeric|min:0',
            'stock'       => 'nullable|integer',
            'thumbnail'   => 'nullable|string',
        ]));

        return response()->json($product);
    }

    // Seller: own orders
    public function sellerOrders(Request $request)
    {
        $orders = Order::whereHas('items.product', fn($q) => $q->where('seller_id', $request->user()->id))
            ->with(['buyer:id,name,email', 'items.product:id,title,price'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return response()->json($orders);
    }

    // Buyer: place order
    public function placeOrder(Request $request)
    {
        $data = $request->validate([
            'items'            => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method'   => 'nullable|string',
            'notes'            => 'nullable|string',
            'shipping_address' => 'nullable|string',
        ]);

        $total = 0;
        $items = [];

        foreach ($data['items'] as $item) {
            $product = Product::active()->findOrFail($item['product_id']);
            $price = $product->sale_price ?? $product->price;
            $total += $price * $item['quantity'];
            $items[] = ['product_id' => $product->id, 'quantity' => $item['quantity'], 'price' => $price];
        }

        $order = Order::create([
            'buyer_id'         => $request->user()->id,
            'total'            => $total,
            'status'           => 'pending',
            'payment_method'   => $data['payment_method'] ?? 'manual',
            'notes'            => $data['notes'] ?? null,
            'shipping_address' => $data['shipping_address'] ?? null,
        ]);

        $order->items()->createMany($items);

        return response()->json(['message' => 'Order placed successfully.', 'order' => $order->load('items')], 201);
    }

    // Buyer: own orders
    public function myOrders(Request $request)
    {
        $orders = Order::where('buyer_id', $request->user()->id)
            ->with('items.product:id,title,thumbnail')
            ->orderByDesc('created_at')
            ->paginate(20);

        return response()->json($orders);
    }

    // Admin: update order status
    public function adminUpdateOrderStatus(Request $request, int $id)
    {
        $order = Order::findOrFail($id);
        $data = $request->validate(['status' => 'required|in:pending,paid,shipped,delivered,cancelled']);
        $order->update($data);
        return response()->json($order);
    }
}
