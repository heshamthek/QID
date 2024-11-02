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
                <button type="button" class="btn btn-primary add-to-cart" data-drug-id="{{ $drug->id }}" data-drug-price="{{ $drug->drug_price }}">Add to Cart</button>
            </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <div class="site-block-27">
                    {{ $drugs->links() }} <!-- This will generate the pagination links -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- JavaScript for AJAX Add to Cart functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle the Add to Cart button click event
        $('.add-to-cart').on('click', function(e) {
            e.preventDefault();

            let drugId = $(this).data('drug-id'); // Get drug ID from data attribute
            let price = $(this).data('drug-price'); // Get price from data attribute
            let token = $("meta[name='csrf-token']").attr('content'); // CSRF token

            $.ajax({
                url: "{{ route('cart.add') }}",
                type: "POST",
                data: {
                    _token: token,
                    drug_id: drugId,
                    quantity: 1, // Default quantity of 1
                    price: price // Pass the price as well
                },
                success: function(response) {
                    // Display success message to user (could be a modal or notification)
                    alert(response.message); // Modify this as needed for better UX
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Log error for debugging
                    alert('Error adding item to cart'); // Consider more user-friendly error handling
                }
            });
        });
    });
</script>
@endsection
