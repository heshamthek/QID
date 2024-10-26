<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Drug;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with('order', 'drug')->get(); // Eager load related models
        return view('order_items.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = Order::all();
        $drugs = Drug::all();
        return view('order_items.create', compact('orders', 'drugs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id', // Ensure the order exists
            'drug_id' => 'required|exists:drugs,id', // Fixed 'drugs_id' to 'drug_id'
            'quantity' => 'required|integer|min:1', // Validate quantity is a positive integer
            'price' => 'required|numeric|min:0', // Validate price is a positive number
        ]);

        OrderItem::create($request->all());

        return redirect()->route('order-items.index')->with('success', 'Order item created successfully.');
    }

    public function show(OrderItem $orderItem)
    {
        return view('order_items.show', compact('orderItem'));
    }

    public function edit(OrderItem $orderItem)
    {
        $orders = Order::all();
        $drugs = Drug::all();
        return view('order_items.edit', compact('orderItem', 'orders', 'drugs'));
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id', // Ensure the order exists
            'drug_id' => 'required|exists:drugs,id', // Fixed 'drugs_id' to 'drug_id'
            'quantity' => 'required|integer|min:1', // Validate quantity is a positive integer
            'price' => 'required|numeric|min:0', // Validate price is a positive number
        ]);

        $orderItem->update($request->all());

        return redirect()->route('order-items.index')->with('success', 'Order item updated successfully.');
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('order-items.index')->with('success', 'Order item deleted successfully.');
    }
}
