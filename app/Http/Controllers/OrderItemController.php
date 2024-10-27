<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        // Use paginate() to retrieve paginated order items
        $orderItems = OrderItem::with('order', 'drug')->paginate(10); // Adjust the number of items per page as needed
        return view('dashboard.orders.index', compact('orderItems'));
    }
    
}
