@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Product</h5>
                        {{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Product</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.product.create')}}">Add Product</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">

                <!-- Page body start -->
                <div class="page-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Add Product</h5>

                                </div>
                                <div class="card-block">

                                    <form class="productFrm">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="title">Shop </label>
                                                <select class="form-control selectshop" name="shop_id">
                                                    <option value="">Select Shop</option>
                                                    @foreach($shops as $shop)
                                                    <option value="{{$shop->id}}">{{$shop->name}}</option>

                                                        @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Product Name </label>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Brand Name </label>
                                                <input type="text" class="form-control" id="brand-id" name="brand-id">
                                            </div>

                                               <div class="form-group col-4">
                                                <label for="title">Description </label>
                                                <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Price </label>
                                                <input type="text" class="form-control" id="price" name="price">
                                            </div>


                                            <div class="form-group col-4">
                                                <label for="title">Discount Price</label>
                                                <input type="text" class="form-control" id="discountprice" name="discountprice">
                                            </div>

                                             <div class="form-group col-4">
                                                <label> Discount valid from:
                                              <span class="text-danger">*</span></label>
                                            <input type="date" name="discountvalidfrom" class="form-control" placeholder="discountprice" required>
                                            </div>

                                               <div class="form-group col-4">
                                                <label> Discount valid to:
                                              <span class="text-danger">*</span></label>
                                            <input type="date" name="discountvalidto" class="form-control" placeholder="discountvalidto" required>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Product Image </label>
                                                <input type="file" class="form-control" id="image" name="image"
                                                       accept="image/*">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="title">Category Name </label>
                                                <input type="text" class="form-control" id="categoryid" name="categoryid">
                                            </div>


                                             <div class="form-group col-6">
                                                <label for="title">Shop  Name </label>
                                                <input type="text" class="form-control" id="shopid" name="shopid">
                                            </div>




                                            <div class="form-group col-12">
                                                <button type="submit"
                                                        class="btn btn-inverse btn-round waves-effect waves-light submit">
                                                    Save
                                                </button>
                                            </div>
                                        </div>


                                    </form>


                                </div>
                            </div>
                            <!-- Basic Form Inputs card end -->

                        </div>
                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>
@stop
@push('custom-scripts')
    <script>

        $(document).ready(function () {
            $('.selectshop').select2();
            $(".productFrm").validate({
                rules:
                    {
                        shop_id:
                            {
                                required: true
                            },
                        name:
                            {
                                required: true
                            },
                        image:
                            {
                                required: true
                            },

                    },
                messages:
                    {
                        shop_id:
                            {
                                required: "Shop is required"
                            },
                        name:
                            {
                                required: "name is required"
                            },
                        image:
                            {
                                required: "Image is required"
                            },

                    },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                    $('.help-block').css('color', 'red');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $(".submit").click(function (event) {
                // alert('he');
                event.preventDefault();
                if ($(".productFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.product.store')}}",
                        data: new FormData($('.productFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Product Created Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.product.index')}}"
                                });

                            } else if (data.status === 'error') {
                                swal({
                                    title: "Error",
                                    text: "Opps..! Something Went to Wrong.",
                                    type: "error"
                                });

                            }


                        }
                    });
                } else {
                    event.preventDefault();
                }
            });

        });
    </script>
@endpush
