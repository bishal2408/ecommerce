@extends('layouts.merchant.backend-app')

@section('content')
        <!-- Page Wrapper -->
        <div id="wrapper">

            @include('layouts.merchant.sidebar')
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                @include('layouts.merchant.navbar')

                @if(session('deleteMessage'))
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    {{ session('deleteMessage') }}
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
                            <a href="{{ route('merchant.product.create') }}" class="btn btn-primary btn-md float-right">Add product</a>
                        </div>
                        <div class="card-body m-1">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Photo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            @if ( $product->subcategory == null)
                                                <td></td> 
                                            @else
                                                <td>{{ $product->subcategory->name }}</td>  
                                            @endif
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->stock_quantity }}</td>
                                            <td>
                                                <img width="50" class="rounded" src="{{ $product->product_photo }}" alt="Product Photo">
                                            </td>
                                            <td class="d-flex flex-row">
                                                <a class="btn btn-warning btn-circle btn-sm " href="{{ route('merchant.product.show', ['product'=>$product->id]) }}">
                                                    <i class="fa fa-fw fa-eye pr-1"></i>
                                                </a>
                                                <a class="btn btn-primary btn-circle btn-sm mx-1" href="{{ route('merchant.product.edit', ['product'=>$product->id]) }}">
                                                    <i class="fa fa-fw fa-edit pr-1"></i>
                                                </a>
                                                <form action="{{ route('merchant.product.destroy', ['product'=>$product->id]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-circle btn-sm mr-1">
                                                        <i class="fa fa-fw fa-trash pr-1"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="float-right">
                            
                        </div>
                    </div>
                </div>
                @include('layouts.merchant.footer')
            </div>
        </div>
@endsection