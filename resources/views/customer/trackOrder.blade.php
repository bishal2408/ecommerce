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
                        @if(session('deleteMessage'))
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            {{ session('deleteMessage') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <section>
                            <div class="container h-100">
                              <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-10">
                          
                                  <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="fw-normal mb-0 text-black">Track Your Orders ({{ $order_count }}-items)</h3>
                                  </div>
                                  @foreach ($orders as $order)
                                    <div class="card rounded-3 mb-4 shadow">
                                        <div class="card-body p-4">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img
                                                src="{{ $order->product->product_photo }}"
                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <p class="lead fw-normal mb-2"><span class="font-weight-bold">{{ $order->product->name }}</span></p>
                                                <p>
                                                    Order Status: <span class="badge badge-danger">{{ $order->order_status }}</span> <br>
                                                    Paid Staus: <span class="badge badge-success">{{ $order->is_paid }}</span> 
                                                </p>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <p><span class="font-weight-bold">Quantity: </span>{{ $order->quantity }}</p>
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0"> <span class="font-weight-bold">Rs. </span> {{ $order->quantity * $order->product->price }}</h5>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <form action="{{ route('customer.item.delete', ['order'=>$order->id]) }}" class="d-flex" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>  
                                  @endforeach

                          
                                </div>
                              </div>
                            </div>
                          </section>
                    </div>
                </div>
                @include('layouts.customer.footer')
            </div>
        </div>
@endsection
