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
                <!-- Main Content -->
                <div id="content">
                    {{-- list --}}
                    <div class="card shadow m-2">
                        <div class="card-header py-3 flex align-content-center">
                            <h6 class="m-0 font-weight-bold text-primary text-lg" style="float: left !important">Edit Product</h6>
                        </div>
                        <div class="card-body m-1">
                            <form action="{{ route('merchant.product.update', ['product'=>$product->id]) }}"  method="POST" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PATCH') }}
                                <input type="hidden" name="merchant_id" id="merchant_id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $product->name }}" name="name" id="name" class="form-control" placeholder="Enter product name">
                                    @error('name')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category" class="font-weight-bold">Category <span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-control" onchange="updateSubcategories()">
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if ($product->category->id == $category->id) selected @endif>{{ $category->name }}</option>
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
                                    <label for="subcategory" class="font-weight-bold">Sub Category</label>
                                    <select name="sub_category" id="subcategory" class="form-control">
                                        @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}" {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="font-weight-bold">Product description <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $product->description }}" name="description" id="description" class="form-control" placeholder="Enter product description">
                                    @error('description')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="font-weight-bold">Select photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" id="photo" class="form-control" placeholder="Select Photo">
                                    <img width="50" class="rounded ml-3 mt-2" src="{{ $product->product_photo }}" alt="Product Photo">
                                    <input type="hidden" name="old_photo"  value="{{ $product->photo }}">
                                    @error('photo')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price" class="font-weight-bold">Product price <span class="text-danger">*</span></label>
                                    <input type="number"  value="{{ $product->price }}" name="price" id="price" class="form-control" placeholder="Enter product price">
                                    @error('price')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock_quantity" class="font-weight-bold">Product stock quantity <span class="text-danger">*</span></label>
                                    <input type="number"  value="{{ $product->stock_quantity }}" name="stock_quantity" id="stock_quantity" class="form-control" placeholder="Enter product stock quantity">
                                    @error('stock_quantity')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Update Product" class="btn btn-primary btn-md" class="form-control">
                                </div>
                            </form> 
                        </div>
                    </div>

                </div>
                <script>
                    function updateSubcategories() {
                      const categoryId = document.querySelector('#category').value;
                      console.log(categoryId);
                      const xhr = new XMLHttpRequest();
                      xhr.open('GET', '/subcategories/' + categoryId);
                      xhr.onload = function() {
                        if (xhr.status === 200) {
                          const subcategories = JSON.parse(xhr.responseText);
                          const subcategorySelect = document.querySelector('#subcategory');
                          subcategorySelect.innerHTML = '';
                          for (let i = 0; i < subcategories.length; i++) {
                            const option = document.createElement('option');
                            option.value = subcategories[i].id;
                            option.text = subcategories[i].name;
                            subcategorySelect.appendChild(option);
                          }
                        }
                      };
                      xhr.send();
                    }
                </script>
                @include('layouts.merchant.footer')
            </div>
        </div>
@endsection
