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
                    <div class="container ml-3">
                        @if(session('deleteMessage'))
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            {{ session('deleteMessage') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(session('orderMessage'))
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            {{ session('orderMessage') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <section class="h-100 gradient-custom">
                            <div class="container">
                              <div class="row d-flex justify-content-center my-4">
                                <div class="col-md-8">
                                  <div class="card mb-4 shadow">
                                    <div class="card-header py-3">
                                      <h5 class="mb-0 font-weight-bold">Cart - {{ $cart_count }} items</h5>
                                    </div>
                                    <div class="card-body">
                                      @foreach ($cart_items as $item)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                            <!-- Image -->
                                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                                <img src="{{ $item->product->product_photo }}"
                                                class="w-100 rounded-1" style="height: 175px; object-fit: cover;" alt="Blue Jeans Jacket" />
                                                <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                                </a>
                                            </div>
                                            <!-- Image -->
                                            </div>
                            
                                            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                            <!-- Data -->
                                            <p class="font-weight-bold text-lg">{{ $item->product->name }}</p>
                                            <p class="">
                                               <span class="font-weight-bold"></span>{{ $item->product->description }}
                                            </p>
                                            <form action="{{ route('customer.item.delete', ['order'=>$item->id]) }}" class="d-flex" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                                                title="Move to the wish list">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                            </form>


                                            <!-- Data -->
                                            </div>
                            
                                            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 qty-container">
                                            <!-- Quantity -->
                                                <div class="d-flex mb-4" style="max-width: 300px">
                                                    <button class="btn btn-primary px-3 me-2 btn-minus" data-item-id="{{ $item->id }}">
                                                    <i class="fas fa-minus"></i>
                                                    </button>
                                
                                                    <div class="form-outline">
                                                    <input id="form1" min="0" name="quantity" value="{{ $item->quantity }}" type="number" class="form-control item-qty" />
                                                    <label class="form-label" for="form1">Quantity</label>
                                                    </div>
                                
                                                    <button class="btn btn-primary px-3 ms-2 btn-plus" data-item-id="{{ $item->id }}">
                                                    <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <!-- Quantity -->
                                                <input type="hidden" class="qty-price" value="{{ $item->product->price }}">
                                                <!-- Price -->
                                                <p class="text-start text-md-center">
                                                    <strong>Rs. <span class="amt">{{ $item->product->price * $item->quantity}} </span></strong>
                                                </p>
                                            <!-- Price -->
                                            </div>
                                        </div>
                                        <hr class="my-4" />
                                      @endforeach
                            
                                      <!-- Single item -->
                                     
                                    </div>
                                  </div>
                                  <div class="card mb-4 shadow">
                                    <div class="card-body">
                                      <p><strong>Expected shipping delivery</strong></p>
                                      <p class="mb-0">12.10.2020 - 14.10.2020</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="card mb-4 shadow">
                                    <div class="card-header py-3">
                                      <h5 class="mb-0 font-weight-bold">Checkout Form</h5>
                                    </div>
                                    <div class="card-body">
                                      <form action="{{ route('customer.checkout') }}" method="POST">
                                          @csrf
                                          <div class="form-group">
                                            @if ($address==null)
                                              <textarea  height="100" name="address" class="form-control" placeholder="Detailed Delivery Address"></textarea>
                                            @else
                                              <textarea height="100" name="address" class="form-control" placeholder="Detailed Delivery Address"> {{ $address->address }}</textarea>
                                            @endif
                                            @error('address')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @enderror
                                          </div>
                                          <div class="form-group">
                                            @if ($address==null)
                                              <input type="text" height="100" name="phone" class="form-control" placeholder="Phone Number">

                                            @else
                                              <input value="{{ $address->phone }}" type="text" height="100" name="phone" class="form-control" placeholder="Phone Number">

                                            @endif
                                            @error('phone')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @enderror
                                          </div>
                                          <hr>
                                          <ul class="list-group list-group-flush">
                                            <li
                                              class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                              <span >Products</span> 
                                              <p>Rs. <span class="total-amt"></span></p>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span >Shipping to</span> 
                                              <span>{{ Auth::user()->name}}</span>
                                            </li>
                                            <li
                                              class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                              <div>
                                                <strong>Total amount</strong>
                                                <strong>
                                                  <p class="mb-0">(including VAT)</p>
                                                </strong>
                                              </div>
                                              <p class="font-weight-bold">Rs. <span class="total-amt"></span></p>
                                            </li>
                                          </ul>
                                          <input type="hidden" name="total_amount" class="total_amount">
                                          <button type="submit" class="btn btn-primary btn-md btn-block">
                                            CHECKOUT
                                          </button>
                                      </form>
                                      @php 
                                        $pid = uniqid();
                                      @endphp
                                      <h6 class="text-center font-weight-bold my-2">OR</h6>
                                      <form action="https://uat.esewa.com.np/epay/main" method="POST" class="w-100">
                                        <input value="10" name="tAmt" type="hidden">
                                        <input value="10" name="amt" type="hidden">
                                        <input value="0" name="txAmt" type="hidden">
                                        <input value="0" name="psc" type="hidden">
                                        <input value="0" name="pdc" type="hidden">
                                        <input value="EPAYTEST" name="scd" type="hidden">
                                        <input value="{{ $pid }}" name="pid" type="hidden">
                                        <input value="{{ route('esewa.verify') }}" type="hidden" name="su">
                                        <input value="{{ route('pay.fail') }}" type="hidden" name="fu">
                                       <button class="btn w-100 btn-outline-success">Pay with E-Sewa</button>
                                      </form>
                                    

                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </section>
                    </div>
                </div>
                <script>
                    $(document).on("click", ".btn-plus, .btn-minus", function(){
                        var itemId = $(this).data("item-id"),
                            qtyField = $(this).closest(".qty-container").find(".item-qty"),
                            currentQty = parseInt(qtyField.val()),
                            qtyPrice = $(this).closest(".qty-container").find(".qty-price"),
                            totalPrice = $(this).closest(".qty-container").find(".amt"),
                            price =  parseInt(qtyPrice.val());
                            newQty = 0;

                        if($(this).hasClass("btn-plus")) {
                            newQty = currentQty + 1;
                        } else {
                            if(currentQty > 1) {
                                newQty = currentQty - 1;
                            }
                        }
                        $.ajax({
                            url: "{{route('customer.update_qty')}}",
                            method: "POST",
                            headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                            data: { item_id: itemId, qty: newQty },
                            success: function(data) {
                                if(data.status == "ok") {
                                    qtyField.val(newQty);
                                    $(totalPrice).html(price*newQty);

                                    var total = 0;
                                    $('.amt').each(function(){
                                        total += parseFloat($(this).html());
                                    });
                                    
                                    $('.total-amt').html(total);
                                    $('.total_amount').val(total);
                                } else {
                                    alert("An error occurred while updating the quantity.");
                                }
                            },
                            error: function() {
                                alert("An error occurred while updating the quantity.");
                            }
                        });
                    });
                    var total = 0;
                    $('.amt').each(function(){
                        total += parseFloat($(this).html());
                    });
                    $('.total-amt').html(total);
                    $('.total_amount').val(total);
                </script>
                @include('layouts.customer.footer')
            </div>
        </div>
@endsection
