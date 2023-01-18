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
                    <section class="bg-light">
                        <div class="container px-4 px-lg-5 mt-5">
                            <h2 class="fw-bolder mb-4 category-name">{{ $category_name }}</h2>
                        </div>
                        @foreach ($subcategories as $subcategory)
                            <div class="container px-4 px-lg-5 mt-5">
                                <h4 class="font-weight-bold mb-4">{{ $subcategory->name }}</h4>
                                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                                    @foreach ($products as $product)
                                    @if ($subcategory->id == $product->sub_category_id)
                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Product image-->
                                            <img style="height: 35vh; object-fit: cover;"class="card-img-top" src="{{ $product->product_photo }}" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-0 m-0">
                                                <div class="text-center">
                                                    <p class="fw-bolder mt-2">{{ $product->name }}</p>
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
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </section>
                </div>
                <script>
                    var category_name = $('.category-name').text();
                    $('.nav-item .nav-link span').each(function(){
                        if($(this).text() == category_name){
                            $(this).closest('.nav-item').addClass('active');
                        }
                    });
                </script>                
                @include('layouts.customer.footer')
            </div>
        </div>

@endsection
