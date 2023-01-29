@extends('layouts.merchant.backend-app')

@section('content')
        <!-- Page Wrapper -->
        <div id="wrapper">

            @include('layouts.merchant.sidebar')
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                @include('layouts.merchant.navbar')

                @if(session('approveMessage'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('approveMessage') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <!-- Main Content -->
                <div id="content">
                    {{-- list --}}
                    <div class="card shadow m-2">
                        <div class="card-header py-3 flex align-content-center">
                            <h6 class="m-0 font-weight-bold text-primary text-lg" style="float: left !important">Product List</h6>
                        </div>
                        <div class="card-body m-1">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Delivery Address</th>
                                            <th>Phone Number</th>
                                            <th>Paid Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="w-25">{{ $order->product->name }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->product->price * $order->quantity }}</td>
                                            <td>{{ $order->user->userAddress->address }}</td>
                                            <td>{{ $order->user->userAddress->phone }}</td>
                                            <td>
                                                <span class="badge badge-primary">{{ $order->is_paid }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('merchant.approve.delivery', ['id'=> $order->id]) }}" class="btn btn-outline-primary">
                                                    Approve Delivery
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.merchant.footer')
            </div>
        </div>
@endsection