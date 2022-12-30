@extends('layouts.merchant.backend-app')

@section('content')
        <!-- Page Wrapper -->
        <div id="wrapper">

            @include('layouts.merchant.sidebar')
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                @include('layouts.merchant.navbar')
                @if(session('successMessage'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('successMessage') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('deleteMessage'))
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    {{ session('deleteMessage') }}
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
                <!-- Main Content -->
                <div id="content">
                    <div class="card shadow m-2">
                        <div class="card-body m-1">
                            <form action="{{ route('merchant.sub-category.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category" class=" font-weight-bold">Select Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{  $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name" class=" font-weight-bold">Sub Category</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter subcategory type">
                                    @error('name')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                <input type="submit" value="Add Sub Category" class="btn btn-primary btn-md">
                            </form>
                        </div>
                    </div>
                    {{-- list --}}
                    <div class="card shadow m-2">
                        <div class="card-header py-3 flex align-content-center">
                            <h6 class="m-0 font-weight-bold text-primary text-lg" style="float: left !important">Sub Category List</h6>
                        </div>
                        <div class="card-body m-1">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Symbol no.</th>
                                            <th>Category</th>
                                            <th>Sub Categories</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @foreach ($subCategory[$loop->iteration - 1] as $subcategory)
                                                    <a href="{{ route('merchant.sub-category.delete', ['id'=>$subcategory->id]) }}" class="btn btn-primary btn-sm">{{ $subcategory->name }} <span class="badge">&times;</span></a>
                                                @endforeach
                                            </td>
                                            <td style="display: flex; ">
                                                <a href="#" class="btn btn-primary btn-circle btn-sm mr-1"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('merchant.sub-category.destroy', ['sub_category'=>$category->id]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger btn-circle btn-sm" data-container="body" title="Delete" data-placement="bottom" data-tooltip="tooltip" role="button" type="submit">
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
                            {{-- {{ $categories->links() }} --}}
                        </div>
                    </div>
                </div>
                @include('layouts.merchant.footer')
            </div>
        </div>
@endsection
