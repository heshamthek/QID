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
        $orderItems = OrderItem::all();
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
            'order_id' => 'required',
            'drugs_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        OrderItem::create($request->all());

        return redirect()->route('order-items.index');
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
            'order_id' => 'required',
            'drugs_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $orderItem->update($request->all());

        return redirect()->route('order-items.index');
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        return redirect()->route('order-items.index');
    }
}
