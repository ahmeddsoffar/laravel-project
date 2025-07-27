<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Please login to add items to cart', 'login_required' => true], 401);
        }

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $size = $request->input('size');
        $color = $request->input('color');

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Check if product is in stock
        if ($product->quantity <= 0) {
            return response()->json(['error' => 'This product is out of stock'], 400);
        }

        // Calculate discounted price
        $finalPrice = $product->price;
        if ($product->discount > 0) {
            $finalPrice = $product->price - ($product->price * $product->discount / 100);
        }

        // Get cart from session
        $cart = session()->get('cart', []);

        // Create unique key for cart item (considering size and color)
        $cartKey = $productId . '_' . $size . '_' . $color;

        $newQuantity = $quantity;
        if (isset($cart[$cartKey])) {
            // Calculate total quantity if item already exists
            $newQuantity = $cart[$cartKey]['quantity'] + $quantity;
        }

        // Check if requested quantity exceeds available stock
        if ($newQuantity > $product->quantity) {
            $availableStock = $product->quantity - (isset($cart[$cartKey]) ? $cart[$cartKey]['quantity'] : 0);
            if ($availableStock <= 0) {
                return response()->json(['error' => 'No more stock available for this item'], 400);
            }
            return response()->json([
                'error' => "Only {$availableStock} items available in stock",
                'max_quantity' => $availableStock
            ], 400);
        }

        if (isset($cart[$cartKey])) {
            // Update quantity if item already exists
            $cart[$cartKey]['quantity'] = $newQuantity;
        } else {
            // Add new item to cart
            $cart[$cartKey] = [
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $finalPrice,
                'original_price' => $product->price,
                'discount' => $product->discount,
                'quantity' => $newQuantity,
                'size' => $size,
                'color' => $color,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart',
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal()
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $cartKey = $request->input('cart_key');
        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal()
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $cartKey = $request->input('cart_key');
        $quantity = $request->input('quantity');
        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            if ($quantity <= 0) {
                unset($cart[$cartKey]);
            } else {
                // Validate stock availability
                $product = Product::find($cart[$cartKey]['product_id']);
                if (!$product) {
                    return response()->json(['error' => 'Product not found'], 404);
                }

                if ($quantity > $product->quantity) {
                    return response()->json([
                        'error' => "Only {$product->quantity} items available in stock",
                        'max_quantity' => $product->quantity
                    ], 400);
                }

                $cart[$cartKey]['quantity'] = $quantity;
            }
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal()
        ]);
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json([
            'cart' => $cart,
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal()
        ]);
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        // Calculate total
        $total = $this->getCartTotal();

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending'
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_id' => $order->id
        ]);
    }

    private function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    private function getCartTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
} 