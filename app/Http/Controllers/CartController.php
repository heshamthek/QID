<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Services\CartService;
use App\Exceptions\ItemNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

    public function addToCart(AddToCartRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['user_id'] = $request->user()->id;
            $item = $this->cartService->addItem($validatedData);
            return response()->json(['message' => 'Item added to cart successfully.']);
        } catch (\Exception $e) {
            Log::error('Error adding item to cart: ' . $e->getMessage());
            return response()->json(['message' => 'Error adding item to cart: ' . $e->getMessage()], 500);
        }
    }

    public function viewCart(Request $request)
    {
        try {
            $order = $this->cartService->getCurrentOrder($request->user()->id);
            
            $totals = Cache::remember("cart_totals_{$order->id}", now()->addMinutes(5), function () use ($order) {
                return $this->cartService->calculateTotals($order);
            });

            return view('websitelayout.cart', compact('order', 'totals'));
        } catch (\Exception $e) {
            Log::error('Error viewing cart: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Unable to view cart. Please try again.');
        }
    }

    public function updateItem(UpdateCartItemRequest $request, $itemId)
{
    try {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;
        $validatedData['item_id'] = $itemId;

        $item = $this->cartService->updateItem($validatedData);
        
        // Recalculate totals
        $order = $this->cartService->getCurrentOrder($request->user()->id);
        $totals = $this->cartService->calculateTotals($order);

        return redirect('cart.view');
    } catch (ItemNotFoundException $e) {
        return response()->json(['message' => $e->getMessage()], 404);
    } catch (\Exception $e) {
        Log::error('Error updating cart item: ' . $e->getMessage());
        return response()->json(['message' => 'An error occurred while updating the cart'], 500);
    }
}


    public function removeItem(Request $request, $itemId)
    {
        try {
            $this->cartService->removeItem($itemId, $request->user()->id);
            Cache::forget("cart_totals_{$request->user()->id}");
            return response()->json(['message' => 'Item removed from cart successfully.']);
        } catch (ItemNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            Log::error('Error removing item from cart: ' . $e->getMessage());
            return response()->json(['message' => 'Unable to remove item from cart. Please try again.'], 500);
        }
    }

    public function clearCart(Request $request)
    {
        try {
            $this->cartService->clearCart($request->user()->id);
            Cache::forget("cart_totals_{$request->user()->id}");
            return response()->json(['message' => 'Cart cleared successfully.']);
        } catch (\Exception $e) {
            Log::error('Error clearing cart: ' . $e->getMessage());
            return response()->json(['message' => 'Unable to clear cart. Please try again.'], 500);
        }
    }

    public function getCartCount(Request $request)
    {
        try {
            $count = $this->cartService->getCartItemCount($request->user()->id);
            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            Log::error('Error getting cart count: ' . $e->getMessage());
            return response()->json(['message' => 'Unable to get cart count. Please try again.'], 500);
        }
    }
}
