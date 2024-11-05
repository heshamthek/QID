<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CheckoutController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $order = $this->cartService->getCurrentOrder($request->user()->id);
        $totals = $this->cartService->calculateTotals($order);

        return view('websitelayout.checkout', compact('order', 'totals'));
    }
}
