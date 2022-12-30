@extends('layouts.merchant.backend-app')

@section('content')
        <!-- Page Wrapper -->
        <div id="wrapper">

            @include('layouts.merchant.sidebar')
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                @include('layouts.merchant.navbar')

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
                    {{-- list --}}
                    <div class="card shadow m-2 w-75">
                        <div class="card-header py-3 flex align-content-center">
                            <h6 class="m-0 font-weight-bold text-primary text-lg" style="float: left !important">Merchant Setting</h6>
                        </div>
                        <div class="card-body m-1">
                            
                            <form  action="{{ route('merchant.setting.update', ['setting'=>$setting->id]) }}" method="post" enctype="multipart/form-data" >
                                <div class="card-body">
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    <table class="w-100">
                                        <tr >
                                            <th><label for="name" class="custom-text-label">Name</label></th>
                                            <td>
                                                <div class="form-group" >
                                                    <input value="{{ $setting->name }}" type="text" name="name" id="name" class="form-control" placeholder="Enter Name " >
                                                    @error('name')
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        {{ $message }}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th><label for="email">Email</label></th>
                                            <td>
                                                <div class="form-group" >
                                                    <input value="{{ $setting->email }}" type="text" name="email" id="email" class="form-control" placeholder="Enter Email " >
                                                    @error('email')
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        {{ $message }}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th><label for="phone_no">Phone Number</label></th>
                                            <td>
                                                <div class="form-group" >
                                                    <input value="{{ $setting->phone }}" type="text" name="phone" id="phone_no" class="form-control" placeholder="Enter Phone Number " >
                                                    @error('phone')
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        {{ $message }}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th><label for="phone_no_2">Second Phone Number</label></th>
                                            <td>
                                                <div class="form-group" >
                                                    <input value="{{ $setting->phone_no_2 }}" type="text" name="phone_no_2" id="phone_no_2" class="form-control" placeholder="Enter second Phone Number " >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th><label for="location">Location</label></th>
                                            <td>
                                                <div class="form-group" >
                                                    <input value="{{ $setting->location }}" type="text" name="location" id="location" class="form-control" placeholder="Enter location " >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th><label for="logo">Logo</label></th>
                                            <td>
                                                <div class="form-group" >
                                                    <input  type="file" name="logo" id="logo" class="form-control" placeholder="Choose a logo" >
                                                    <input value="{{ $setting->logo }}" type="hidden" name="old_logo">
                                                    <img src="{{ $setting->merchant_logo }}" alt="No logo" width="50" height="50" class="rounded mt-2">
                                                </div>
                                                @error('logo')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    {{ $message }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr >
                                            <th><label for="fb_link">Facebook link</label></th>
                                            <td>
                                                <div class="form-group" >
                                                    <input value="{{ $setting->fb_link }}" type="text" name="fb_link" id="fb_link" class="form-control" placeholder="Enter Facebook link" >
                                                </div>
                                            </td>
                                        </tr>

                                        <tr >
                                            <th><label for="insta_link">Instagram link</label></th>
                                            <td>
                                                <div class="form-group" >
                                                    <input value="{{ $setting->insta_link }}" type="text" name="insta_link" id="insta_link" class="form-control" placeholder="Enter Instagram link" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th><label for="youtube_link">Youtube link</label></th>
                                            <td>
                                                <div class="form-group" >
                                                    <input value="{{ $setting->youtube_link }}" type="text" name="youtube_link" id="youtube_link" class="form-control" placeholder="Enter Youtube link" >
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Update Merchant Setting</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @include('layouts.merchant.footer')
            </div>
        </div>
@endsection
