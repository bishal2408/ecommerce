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
                        {{-- carousel and below ad content --}}
                        <div class="row px-4 py-2">
                            <div class="col-lg-8">
                                <div id="carouselExampleControls" class="carousel slide w-100 mb-4" data-interval="false" >
                                    <div class="carousel-inner">
                                      <div class="carousel-item active">
                                        <img class="rounded-4 d-block w-100" src="https://img.freepik.com/premium-photo/fashionable-awesome-tanned-curly-man-brown-jacket-trendy-sunglasses-wear-classic-hat-posing-isolated-beige-pastel-background-fashion-new-collection-offer-retro-style-concept-free-place-ad_163305-156833.jpg"  alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h3 class="text-dark font-weight-bolder">Welcome to Zonebiz</h3>
                                            <p class="text-dark font-weight-bolder">A Great Theme For Business Consulting</p>
                                            <a href="" class="btn btn-danger btn-md rounded-5">Shop Now</a>
                                         </div>
                                      </div>
                                      <div class="carousel-item ">
                                        <img  class="rounded-4 d-block w-100" src="https://as1.ftcdn.net/v2/jpg/02/72/18/58/1000_F_272185862_IwefIgl66f8g6pfEj3AQQMgVgXuf7qgG.jpg" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h3 class="text-dark font-weight-bolder">Welcome to Zonebiz</h3>
                                            <p class="text-dark font-weight-bolder">A Great Theme For Business Consulting</p>
                                            <a href="" class="btn btn-danger btn-md rounded-5">Shop Now</a>
                                         </div>
                                      </div>
                                      <div class="carousel-item">
                                        <img  class="rounded-4 d-block w-100" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/1200px-Image_created_with_a_mobile_phone.png" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h3 class="text-dark font-weight-bolder">Welcome to Zonebiz</h3>
                                            <p class="text-dark font-weight-bolder">A Great Theme For Business Consulting</p>
                                            <a href="" class="btn btn-danger btn-md rounded-5">Shop Now</a>
                                         </div>
                                      </div>
                                    </div>
                                   <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                    </button>
                                </div>
                                <div class="d-flex w-100">
                                    <div style="width: 40%;" class="mr-4 d-flex flex-column justify-content-between">
                                        <div class="mb-2 w-100">
                                            <a href="" class="text-decoration-none text-md">
                                                <img style="object-fit:cover;" class="ad-img rounded-4 w-100" src="https://i.ytimg.com/vi/yQQY-Eupjlc/maxresdefault.jpg" alt="">
                                                <div class="text-overlay">
                                                    <p class="text-light font-weight-bolder m-0">Chinese Brand Watches</p>
                                                    <a href="" class="text-light p-1 m-0">Shop now</a>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="w-100" >
                                            <a href="" class="text-decoration-none text-md">
                                                <img style="object-fit:cover;" class="ad-img rounded-4 w-100" src="https://i.ytimg.com/vi/1aqI7EnfbVM/maxresdefault.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div style="width: 60%;" >
                                        <a href="">
                                            <img style="height: 100%; object-fit:cover;" class="w-100 rounded-4" src="https://cdn.mos.cms.futurecdn.net/9ieWhRN5ktfbWSFwFYPbbM.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{-- hot deals --}}
                            <div class="col-lg-4">
                                <h6 class="font-weight-bolder mb-3 text-lg">Hot Deal</h6>
                                <div class="hot-deals">
                                    @foreach ($hot_deals as $product)
                                    <div class="mb-3 hot-product">
                                        <a href="{{ route('customer.showProduct', ['product'=>$product->id]) }}" class="d-flex flex-row text-decoration-none text-dark">
                                            <img class="hot-product-img rounded-3 mr-2" src="{{ $product->product_photo }}" alt="Hot product image">
                                            <div class="mt-2">
                                                <h6 class="font-weight-bold text-md mb-1">{{ $product->name }}</h6>
                                                <p class="lead hot-product-desc m-0" style="font-size: 12px;">
                                                    {{ $product->description }}
                                                </p>
                                                <span class="badge badge-danger mt-2">Rs. {{ $product->price }}</span>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        {{-- another section --}}
                        <section class="my-4">
                            <h3 class="text-center mb-5"><strong>Our Merchants</strong></h3>
                            <div class="container d-flex flex-wrap">
                                <div class="mr-3 mb-4">
                                    <a href="" class="text-danger">
                                        <img width="200" height="160" class="rounded-3" src="https://img.freepik.com/premium-photo/fashionable-awesome-tanned-curly-man-brown-jacket-trendy-sunglasses-wear-classic-hat-posing-isolated-beige-pastel-background-fashion-new-collection-offer-retro-style-concept-free-place-ad_163305-156833.jpg" alt="merchant photo">
                                        <div><span class="font-weight-bold">Merchant name</span></div>
                                    </a>
                                </div>
                                <div class="mr-3 mb-4">
                                    <a href="" class="text-danger">
                                        <img width="200" height="160" class="rounded-3" src="https://img.freepik.com/premium-photo/fashionable-awesome-tanned-curly-man-brown-jacket-trendy-sunglasses-wear-classic-hat-posing-isolated-beige-pastel-background-fashion-new-collection-offer-retro-style-concept-free-place-ad_163305-156833.jpg" alt="merchant photo">
                                        <div><span class="font-weight-bold">Merchant name</span></div>
                                    </a>
                                </div>
                                <div class="mr-3 mb-4">
                                    <a href="" class="text-danger">
                                        <img width="200" height="160" class="rounded-3" src="https://img.freepik.com/premium-photo/fashionable-awesome-tanned-curly-man-brown-jacket-trendy-sunglasses-wear-classic-hat-posing-isolated-beige-pastel-background-fashion-new-collection-offer-retro-style-concept-free-place-ad_163305-156833.jpg" alt="merchant photo">
                                        <div><span class="font-weight-bold">Merchant name</span></div>
                                    </a>
                                </div>
                                <div class="mr-3 mb-4">
                                    <a href="" class="text-danger">
                                        <img width="200" height="160" class="rounded-3" src="https://img.freepik.com/premium-photo/fashionable-awesome-tanned-curly-man-brown-jacket-trendy-sunglasses-wear-classic-hat-posing-isolated-beige-pastel-background-fashion-new-collection-offer-retro-style-concept-free-place-ad_163305-156833.jpg" alt="merchant photo">
                                        <div><span class="font-weight-bold">Merchant name</span></div>
                                    </a>
                                </div>
                                <div class="mr-3 mb-4">
                                    <a href="" class="text-danger">
                                        <img width="200" height="160" class="rounded-3" src="https://img.freepik.com/premium-photo/fashionable-awesome-tanned-curly-man-brown-jacket-trendy-sunglasses-wear-classic-hat-posing-isolated-beige-pastel-background-fashion-new-collection-offer-retro-style-concept-free-place-ad_163305-156833.jpg" alt="merchant photo">
                                        <div><span class="font-weight-bold">Merchant name</span></div>
                                    </a>
                                </div>
                            </div>
                        </section>

                        {{-- recomendation section --}}
                        
                    </div>
                </div>
                @include('layouts.customer.footer')
            </div>
        </div>
@endsection
