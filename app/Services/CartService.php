<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Drug;
use App\Exceptions\ItemNotFoundException;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getCurrentOrder($userId)
    {
        return Order::firstOrCreate(
            [
                'user_id' => $userId,
                'order_status' => 'pending'
            ],
            [
                'total' => 0
            ]
        );
    }

    public function addItem(array $data)
    {
        $order = $this->getCurrentOrder($data['user_id']);
        
        $drug = Drug::findOrFail($data['drug_id']);
        
        $item = $order->items()->updateOrCreate(
            ['drug_id' => $data['drug_id']],
            [
                'quantity' => DB::raw('quantity + ' . $data['quantity']),
                'price' => $drug->drug_price
            ]
        );

        $this->updateOrderTotal($order);

        return $item;
    }

    



    public function calculateTotals(Order $order)
    {
        $subtotal = 0;
        $tax = 0;
        $shipping = 0;

        foreach ($order->items as $item) {
            $subtotal += $item->quantity * $item->price;
        }

        // Calculate tax (assuming 10% tax rate)
        $tax = $subtotal * 0.1;

        // Calculate shipping (you can implement your own logic here)
        $shipping = 5.00; // Flat rate shipping for example

        $total = $subtotal + $tax + $shipping;

        return [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total
        ];
    }


    public function updateItem(array $data)
{
    $order = $this->getCurrentOrder($data['user_id']);
    
    $item = $order->items()->findOrFail($data['item_id']);

    $item->quantity = $data['quantity'];
    $item->save();

    $this->updateOrderTotal($order);

    return $item;
}
    private function updateOrderTotal(Order $order)
    {
        $total = $order->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $order->update(['total' => $total]);
    }




    // ... other methods ...
}
