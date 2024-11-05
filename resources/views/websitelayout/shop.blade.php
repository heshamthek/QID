@extends('websitelayout.main')

@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <div id="slider-range" class="border-primary"></div>
                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
            </div>
            <div class="col-lg-6">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Reference</h3>
                <button type="button" class="btn btn-secondary btn-md dropdown-toggle px-4" id="dropdownMenuReference"
                        data-toggle="dropdown">Reference</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                    <a class="dropdown-item" href="#">Relevance</a>
                    <a class="dropdown-item" href="#">Name, A to Z</a>
                    <a class="dropdown-item" href="#">Name, Z to A</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Price, low to high</a>
                    <a class="dropdown-item" href="#">Price, high to low</a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            @foreach($drugs as $drug)
            <div class="col-sm-6 col-lg-4 text-center item mb-4">
                <a href="#">
                    <img src="{{ asset('storage/' . $drug->image_path) }}" alt="{{ $drug->drug_name }}" class="img-fluid" style="width: 200px; height: 200px; object-fit: cover;">
                </a>
                <h3 class="text-dark"><a href="#">{{ $drug->drug_name }}</a></h3>
                <p class="price">
                    @if($drug->drug_price < $drug->original_price)
                    <del>${{ number_format($drug->original_price, 2) }}</del> &mdash; 
                    @endif
                    ${{ number_format($drug->drug_price, 2) }}
                </p>
                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                    @csrf
                    <input type="hidden" name="drug_id" value="{{ $drug->id }}">
                    <input type="number" name="quantity" value="1" min="1" max="10" class="form-control d-inline-block mb-2" style="width: 70px;">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <div class="site-block-27">
                    {{ $drugs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
$(document).ready(function() {
    console.log('Document ready');

    // Use event delegation for dynamically added elements
    $(document).on('click', '.add-to-cart-btn', function(e) {
        e.preventDefault();
        console.log('Add to cart button clicked');
        
        var form = $(this).closest('form');
        var addToCartBtn = $(this);
        addToCartBtn.prop('disabled', true).text('Adding...');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                console.log('Success:', response);
                showNotification('success', response.message);
                updateCartCount();
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
                showNotification('error', 'Error adding item to cart. Please try again.');
            },
            complete: function() {
                addToCartBtn.prop('disabled', false).text('Add to Cart');
            }
        });
    });

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

    function updateCartCount() {
        $.get('/cart/count', function(data) {
            $('#cart-count').text(data.count);
        });
    }

    // ... (rest of your JavaScript code) ...
});
</script>
@endpush
