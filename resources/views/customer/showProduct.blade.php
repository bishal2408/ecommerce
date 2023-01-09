@extends('layouts.customer.app')

@section('content')
        <!-- Page Wrapper -->
        <div id="wrapper">

            @include('layouts.customer.sidebar')
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column" style="margin-left: 15vw;">
    
                <!-- Main Content -->
                <div id="content">
    
                    @include('layouts.customer.navbar')
                    <div class="container">
                        <section class="product">
                            <div class="container px-4 px-lg-5">
                                <div class="row gx-4 gx-lg-5 align-items-center">
                                    <div class="col-md-6"><img class="card-img-top rounded-3 mb-5 mb-md-0" src="{{ $product->product_photo }}" alt="..." /></div>
                                    <div class="col-md-6">
                                        <div class="small mb-1">By {{ $product->merchant->name }}</div>
                                        <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                                        <div class="fs-5 mb-5">
                                            <span class="text-decoration-line-through">Rs.45.00</span>
                                            <span class="badge badge-danger">Rs. {{ $product->price }}</span>
                                        </div>
                                        <p class="lead">{{ $product->description }}</p>
                                        <div class="d-flex">
                                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                                            <button class="btn btn-outline-danger flex-shrink-0" type="button">
                                                <i class="bi-cart-fill me-1"></i>
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                         <!-- Related items section-->
                        <section class="py-5 bg-light">
                            <div class="container px-4 px-lg-5 mt-5">
                                <h2 class="fw-bolder mb-4">Related products</h2>
                                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                                    @foreach ($related_products as $product)
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Product image-->
                                            <img style="object-fit: cover;" height="180" class="card-img-top" src="{{ $product->product_photo }}" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-0 m-0">
                                                <div class="text-center">
                                                    <h5 class="fw-bolder mt-2">{{ $product->name }}</h5>
                                                    <p class="lead hot-product-desc ml-2 mb-2" style="font-size: 12px;">{{ $product->description }}</p>
                                                    <!-- Product price-->
                                                    <span class="badge badge-danger mb-2">Rs. {{ $product->price }}</span>
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-danger rounded-2 mt-auto" href="{{ route('customer.showProduct', ['product'=>$product->id]) }}">Shop Now</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                @include('layouts.customer.footer')
            </div>
        </div>
@endsection
