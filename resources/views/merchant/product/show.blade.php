@extends('layouts.merchant.backend-app')

@section('content')
        <!-- Page Wrapper -->
        <div id="wrapper">

            @include('layouts.merchant.sidebar')
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                @include('layouts.merchant.navbar')

                <!-- Main Content -->
                <div id="content">
                    {{-- list --}}
                    <div class="card shadow m-2">
                        <div class="card-header py-3 flex align-content-center">
                            <h6 class="m-0 font-weight-bold text-primary text-lg" style="float: left !important">Product Detail</h6>
                        </div>
                        <div class="card-body m-1">
                            <p><span class="font-weight-bold">Product name: </span>{{ $product->name }}</p>
                            <p><span class="font-weight-bold">Category: </span>{{ $product->category->name }} </p>
                            @if ( $product->subcategory == null)
                                <p><span class="font-weight-bold">Sub Category: </span></p>
                                
                            @else
                                <p><span class="font-weight-bold">Sub Category: </span>{{ $product->subcategory->name }} </p>
                            @endif

                            <p><span class="font-weight-bold">Product Description: </span>{{ $product->description }}</p>
                            <p><span class="font-weight-bold">Product Price: </span>{{ $product->price }}</p>
                            <p><span class="font-weight-bold">Stock Quantity: </span>{{ $product->stock_quantity }}</p>
                            <img src="{{ $product->product_photo }}" class="w-25 rounded"  alt="product photo" >
                        </div>

                    </div>
                </div>
                @include('layouts.merchant.footer')
            </div>
        </div>
@endsection
