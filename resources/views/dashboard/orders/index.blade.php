@extends('dashboard.layout.side')

@section('content')
<div class="w-full max-w-7xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-lg">

    <h2 class="text-2xl font-semibold text-gray-800 pb-4 flex items-center">
        <i class="fas fa-shopping-cart mr-3"></i> Order Items
    </h2>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <!-- Order Items Table -->
    <div id="orderItemsTable" class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Drug Name</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantity</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orderItems as $item)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">{{ $item->id }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">{{ $item->order->id }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">{{ $item->drug->drug_name }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">{{ $item->quantity }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 bg-white text-sm">${{ number_format($item->price, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-2 px-4 border-b text-center">No order items found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $orderItems->links() }} <!-- Pagination links -->
    </div>
</div>
@endsection
