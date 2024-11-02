<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'drug_id' => 'required|exists:drugs,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        $order = Order::firstOrCreate(
            ['user_id' => Auth::id(), 'order_status' => 'pending'],
            ['order_date' => now()]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order->id, 'drug_id' => $validated['drug_id']],
            ['quantity' => $validated['quantity'], 'price' => $validated['price']]
        );

        return redirect()->route('cart.view')->with('success', 'Item added to cart successfully!');
    }

    public function viewCart()
    {
        $order = Order::with('items.drug') // eager loading drug relation
                      ->where('user_id', Auth::id())
                      ->where('order_status', 'pending')
                      ->first();

        // Calculate subtotal
        $subtotal = $order ? $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        }) : 0;

        return view('websitelayout.cart', compact('order', 'subtotal'));
    }

    public function updateCart(Request $request, $itemId)
{
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // Ensure the item exists
    $orderItem = OrderItem::findOrFail($itemId);
    $orderItem->update(['quantity' => $validated['quantity']]);

    return redirect()->route('cart.view')->with('success', 'Cart updated successfully!');
}


    public function removeItem($itemId)
    {
        $orderItem = OrderItem::withTrashed()->find($itemId);
        
        if ($orderItem) {
            Log::info('Removing item with ID: ' . $itemId);
            $orderItem->forceDelete();
            Log::info('Item removed successfully.');
            return redirect()->route('cart.view')->with('success', 'Item removed from cart successfully!');
        } else {
            Log::warning('Item not found with ID: ' . $itemId);
            return redirect()->route('cart.view')->with('error', 'Item not found.');
        }
    }
    public function clearCart()
    {
        $order = Order::where('user_id', Auth::id())->where('order_status', 'pending')->first();
        if ($order) {
            $order->items()->delete(); // remove all items
        }
        return redirect()->route('cart.view')->with('success', 'Cart cleared successfully!');
    }
}
