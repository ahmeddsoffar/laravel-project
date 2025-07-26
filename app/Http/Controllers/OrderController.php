<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('adminViews.order.listOrders', compact('orders'));
    }

    public function viewOrder()
    {
        $users = User::where('role', 'user')->get();
        $products = Product::where('quantity', '>', 0)->get();
        return view('adminViews.order.createOrder', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
                'total_price' => 'required|numeric|min:0'
            ]);

            // Start transaction
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'user_id' => $request->user_id,
                'total_price' => $request->total_price,
                'status' => 'pending'
            ]);

            // Create order items and update product quantities
            foreach ($request->items as $item) {
                // Get the product
                $product = Product::find($item['product_id']);

                // Verify stock availability
                if ($product->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product: {$product->name}");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);

                // Update product quantity
                $product->decrement('quantity', $item['quantity']);
            }

            DB::commit();

            return redirect()
                ->route('order.list')
                ->with('success', 'Order created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error creating order: ' . $e->getMessage());
        }
    }

    public function editOrder(Order $order)
    {
        $order->load('items.product');
        $users = User::all();
        $products = Product::all(); // Include all products to show even out of stock ones

        return view('adminViews.order.editOrder', compact('order', 'users', 'products'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'status' => 'required|in:pending,processing,completed,cancelled',
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
                'total_price' => 'required|numeric|min:0'
            ]);

            DB::beginTransaction();

            // Get current items to restore quantities
            $currentItems = $order->items->pluck('quantity', 'product_id')->toArray();

            // Update order details
            $order->user_id = $request->user_id;
            $order->status = $request->status;
            $order->total_price = $request->total_price;
            $order->save();

            // Delete existing items
            $order->items()->delete();

            // Add new items
            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);

                // Restore old quantity if this product was in the order
                if (isset($currentItems[$product->id])) {
                    $product->increment('quantity', $currentItems[$product->id]);
                }

                // Check new quantity
                if ($product->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product: {$product->name}");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);

                // Update product quantity
                $product->decrement('quantity', $item['quantity']);
            }

            DB::commit();

            return redirect()
                ->route('order.list')
                ->with('success', 'Order updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order update failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error updating order: ' . $e->getMessage());
        }
    }

    public function destroy(Order $order)
    {
        try {
            DB::beginTransaction();

            Log::info('Starting order deletion process', ['order_id' => $order->id]);

            // Restore product quantities
            foreach ($order->items as $item) {
                Log::info('Restoring product quantity', [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity
                ]);
                $item->product->increment('quantity', $item->quantity);
            }

            // Delete the order (will cascade delete items due to foreign key constraint)
            Log::info('Deleting order', ['order_id' => $order->id]);
            $result = $order->delete();
            Log::info('Delete result', ['success' => $result]);

            DB::commit();
            Log::info('Transaction committed');

            return redirect()
                ->route('order.list')
                ->with('success', 'Order deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order deletion failed: ' . $e->getMessage(), [
                'order_id' => $order->id,
                'exception' => $e
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error deleting order: ' . $e->getMessage());
        }
    }
}
