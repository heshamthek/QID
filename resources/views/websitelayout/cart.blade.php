@extends('websitelayout.main')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{ route('home') }}">Home</a> <span class="mx-2 mb-0">/</span> 
                <strong class="text-black">Cart</strong>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12 mb-3" method="POST" action="{{ route('cart.clear') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Clear Cart</button>
            </form>
            <form class="col-md-12" method="POST" action="#">
                @csrf
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
                            @if ($order && $order->items->count())
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="{{ asset('storage/' . $item->drug->image_path) }}" alt="{{ $item->drug->name }}" class="img-fluid" style="width: 100px; height: auto;">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $item->drug->name }}</h2>
                                    </td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH') <!-- This line is crucial for simulating the PATCH request -->
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                            <button type="submit">Update</button>
                                        </form>                                   
                                    </td>
                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger btn-sm">X</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Your cart is empty.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-md btn-block">Continue Shopping</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="text-black h4" for="coupon">Coupon</label>
                        <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                        <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-md px-4">Apply Coupon</button>
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
                                <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">${{ number_format($subtotal, 2) }}</strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">${{ number_format($subtotal, 2) }}</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" class="btn btn-primary btn-lg btn-block">Proceed To Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                    <div class="banner-1-inner align-self-center">
                        <h2>Pharma Products</h2>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0">
                <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
                    <div class="banner-1-inner ml-auto align-self-center">
                        <h2>Rated by Experts</h2>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
