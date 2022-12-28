@extends('layouts.merchant.backend-app')

@section('content')
        <!-- Page Wrapper -->
        <div id="wrapper">

            @include('layouts.merchant.sidebar')
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    @include('layouts.merchant.navbar')
    
                    <div class="card m-5">
                        <h1 class="p-1 font-weight-bold text-primary text-lg" style="float: left !important">Dashboard</h1>
                        <div class="card-header">
                            You are logged in!
                        </div>
                    </div>
                </div>
                @include('layouts.merchant.footer')
            </div>
        </div>
@endsection
