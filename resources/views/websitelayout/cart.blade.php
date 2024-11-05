@extends('websitelayout.main')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{ route('home') }}">Home</a> <span class="mx-2 mb-0">/ 
                <strong class="text-black">Cart</strong>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row mb-5">
            <form class="col-md-12" method="POST" action="{{ route('cart.clear') }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm mb-3">Clear Cart</button>
            </form>
            <div class="col-md-12">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->items as $item)
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="{{ asset('storage/' . $item->drug->image_path) }}" alt="{{ $item->drug->name }}" class="img-fluid" style="width: 100px; height: auto;">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $item->drug->name }}</h2>
                                    </td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>
                                        <input type="number" class="form-control cart-quantity-input" 
                                               value="{{ $item->quantity }}" min="1" 
                                               data-item-id="{{ $item->id }}">
                                    </td>
                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary btn-sm">X</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Your cart is empty.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Subtotal
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">${{ number_format($totals['subtotal'], 2) }}</strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">${{ number_format($totals['total'], 2) }}</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg btn-block">Proceed To Checkout</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.cart-quantity-input').on('change', function() {
        var itemId = $(this).data('item-id');
        var quantity = $(this).val();
        updateCartItem(itemId, quantity);
    });

    function updateCartItem(itemId, quantity) {
        $.ajax({
            url: `/cart/${itemId}`,
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: quantity
            },
            success: function(response) {
                showNotification('success', response.message);
                location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr) {
                showNotification('error', 'Error updating cart item. Please try again.');
            }
        });
    }

    function showNotification(type, message) {
        var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        var notification = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                                message +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                    '<span aria-hidden="true">&times;' +
                                '</button>' +
                            '</div>');
        
        $('.container').first().prepend(notification);
        
        setTimeout(function() {
            notification.alert('close');
        }, 5000);
    }
});
</script>
@endpush
