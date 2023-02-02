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
                            <h6 class="m-0 font-weight-bold text-primary text-lg" style="float: left !important">User Demographics</h6>
                        </div>
                        <div class="card-body m-1">
                            <div class="d-flex justify-content-between ">
                                <div class="card shadow bg-primary text-white m-2">
                                    <div class="card-header py-2 flex align-content-center">
                                        <h6 class="m-0 font-weight-bold text-md" style="float: left !important">Popular Product (this week)</h6> <br>
                                    </div>
                                    <div class="card-body m-1">
                                        <h4 class="text-center" style="font-size: 1rem;">{{ $data['product_of_the_week'] }}</h4>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="card shadow bg-primary text-white m-2">
                                    <div class="card-header py-2 flex align-content-center">
                                        <h6 class="m-0 font-weight-bold text-md" style="float: left !important">Total Revenue (this week)</h6> <br>
                                    </div>
                                    <div class="card-body m-1">
                                        <h4 class="text-center text-md" style="font-size: 1rem;">Rs. {{ $data['total_revene_this_week'] }}</h4>
                                    </div>
                                </div>
                                <div class="card shadow bg-primary text-white m-2">
                                    <div class="card-header py-2 flex align-content-center">
                                        <h6 class="m-0 font-weight-bold text-md" style="float: left !important">Total Sales (this week)</h6> <br>
                                    </div>
                                    <div class="card-body m-1">
                                        <h4 class="text-center text-md" style="font-size: 1rem;">{{ $data['total_sales_this_week'] }}</h4>
                                    </div>
                                </div>
                                <div class="card shadow bg-primary text-white m-2">
                                    <div class="card-header py-2 flex align-content-center">
                                        <h6 class="m-0 font-weight-bold text-md" style="float: left !important">Age Demographics (this week)</h6> <br>
                                    </div>
                                    <div class="card-body m-1">
                                        <h4 class="text-center text-md" style="font-size: 1rem;">25-30 years old</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.merchant.footer')
            </div>
        </div>
@endsection