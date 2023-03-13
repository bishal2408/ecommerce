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
                            @if(session('successMessage'))
                            <div class="alert alert-primary alert-dismissible fade show m-3" role="alert">
                                {{ session('successMessage') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(session('editMessage'))
                            <div class="alert alert-primary alert-dismissible fade show m-3" role="alert">
                                {{ session('editMessage') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="container px-4 px-lg-5">
                                <div class="row gx-4 gx-lg-5 align-items-center">
                                    <div class="col-md-4"><img class="card-img-top product-image rounded-3 mb-5 mb-md-0" src="{{ $product->product_photo }}" alt="..." /></div>
                                    <div class="col-md-8">
                                        <div class="star-rating">
                                            <div class="rating" data-item-id="{{ $product->id }}">
                                                <p class="m-0 font-weight-bold">
                                                    Rate Product:
                                                    <label for="rating1" class="ml-2"><i  class="fa fa-star"></i></label>
                                                    <input type="radio" name="rating" id="rating1" value="1" @if ($user_rating == 1) checked @endif>
                                                    <label for="rating2"><i  class="fa fa-star"></i></label>
                                                    <input type="radio" name="rating" id="rating2" value="2" @if ($user_rating == 2) checked @endif>
                                                    <label for="rating3"><i  class="fa fa-star"></i></label>
                                                    <input type="radio" name="rating" id="rating3" value="3" @if ($user_rating == 3) checked @endif>
                                                    <label for="rating4"><i  class="fa fa-star"></i></label>
                                                    <input type="radio" name="rating" id="rating4" value="4" @if ($user_rating == 4) checked @endif>
                                                    <label for="rating5"><i  class="fa fa-star"></i></label>
                                                    <input type="radio" name="rating" id="rating5" value="5" @if ($user_rating == 5) checked @endif>
                                                </p>

                                               
                                            </div>

                                        </div>
                                        <div class="small mb-1">By {{ $product->merchant->name }}</div>
                                        <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                                        <div class="fs-5 mb-5">
                                            <span class="text-decoration-line-through">Rs.45.00</span>
                                            <span class="badge badge-danger">Rs. {{ $product->price }}</span>
                                        </div>
                                        <p class="lead">{{ $product->description }}</p>         
                                        @if ($existingCartItem == null)
                                            <form action="{{ route('customer.addProductToCart', ['product'=> $product->id]) }}" method="POST"class="d-flex">
                                        @else
                                            <form action="{{ route('customer.updateProductQuantity', ['order'=> $existingCartItem->id]) }}" method="POST" class="d-flex">
                                        @endif
                                            @csrf
                                            @if ($existingCartItem == null) 
                                                <input name="quantity" class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                                                @error('quantity')
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        {{ $message }}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @enderror
                                                <button class="btn btn-outline-danger flex-shrink-0" type="submit">
                                                    <i class="fa fa-shopping-cart me-1"></i>
                                                    Add to cart
                                                </button>
                                            @else
                                                <input name="quantity" class="form-control text-center me-3" id="inputQuantity" type="num" value="{{ $existingCartItem->quantity }}" style="max-width: 3rem" />
                                                @error('quantity')
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        {{ $message }}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @enderror
                                                <button class="btn btn-outline-danger flex-shrink-0" type="submit">
                                                    <i class="fa fa-shopping-cart me-1"></i>
                                                    Update cart
                                                </button>
                                            @endif

                                        </form>
                                        
                                    </div>
                                    <section>
                                        <div class="container mt-5 ">
                                          <div class="row d-flex justify-content-center">
                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                              <div class="card shadow">
                                                <div class="card-header">
                                                    <h5 class="text-primary">Product Reviews <span class="text-danger">({{ $average_rating }})</span> </h5>
                                                </div>
                                                @foreach ($comments as $comment)
                                                    <div class="card-body ">
                                                        <div class="d-flex flex-start align-items-center">
                                                            <img class="rounded-circle shadow-1-strong me-3"
                                                                src="{{ $comment->commentUser->user_photo }}" alt="avatar" width="60"
                                                                height="60" />
                                                            <div class="d-flex ">
                                                                <div class="mr-3">
                                                                    <h6 class="fw-bold text-primary mb-1">{{ $comment->commentUser->name }}</h6>
                                                                    <p class="text-muted small mb-0">
                                                                        Shared publicly - {{ $comment->created_at->format('M d') }}
                                                                    </p>
                                                                </div>
                                                                @if(Auth::check() && Auth::id() == $comment->commentUser->id )
                                                                    <form action="{{ route('comment.destroy', ['comment'=>$comment->id]) }}" class="d-flex" method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-outline-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove Comment">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <p class="my-2"> {{ $comment->comments }} </p>
                                                    </div>
                                                @endforeach
                                                
                                                @if(Auth::check())
                                                <div class="card-footer py-3 border-0" >
                                                    <div class="d-flex flex-start w-100">
                                                      <img class="rounded-circle shadow-1-strong me-3"
                                                        src="{{ Auth::user()->user_photo }}" alt="avatar" width="40"
                                                        height="40" />
                                                      <div class="form-outline w-100">
                                                          <form action="{{ route('comment.store') }}" method="post">
                                                              @csrf
                                                              <textarea class="form-control" id="textAreaExample" rows="2"
                                                              style="background: #fff;" name="comment" id="comment"></textarea>
                                                              <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                                                              @error('comment')
                                                                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                      {{ $message }}
                                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                      </button>
                                                                  </div>
                                                              @enderror
                                                              <div class="float-end mt-2 pt-1">
                                                                  <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                                                              </div>
                                                          </form>
                                                          
                                                      </div>
                                                    </div>
                                                    
                                                  </div>
                                                @endif

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </section>
                                   
                                </div>
                            </div>
                        </section>
                        {{-- Associated product section --}}
                        @if ($associated_products->count() != 0)
                            <section class="pt-5 bg-light">
                                <div class="container px-4 px-lg-5 mt-5">
                                    <h2 class="fw-bolder mb-4">You may also like...</h2>
                                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                                        @foreach ($associated_products as $product)
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
                        @endif

                         <!-- Related items section-->
                        <section class="mt-3 bg-light">
                            <div class="container px-4 px-lg-5 mt-5">
                                <h2 class="fw-bolder mb-4">Similar products </h2>
                                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                                    @foreach ($similar_products as $product)
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
                <script>
                    $(document).ready(function() {
                        $('input[type="radio"]').click(function() {
                            var rating = $(this).val();
                            var productId = $('.rating').data("item-id");
                            $.ajax({
                            url: "{{route('customer.rateProduct')}}",
                            method: "POST",
                            headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                data: {rating: rating, product_id: productId },
                                success: function(data) {
                                    if(data.status == "ok") {
                                        console.log('success');
                                    }
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>

@endsection
