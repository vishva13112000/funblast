@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Shop</h5>
                        {{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.shops.index')}}">Shop</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.shops.create')}}">Add Shop</a>
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
                                    <h5>Add Shop</h5>

                                </div>
                                <div class="card-block">

                                    <form class="shopFrm">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="title">Category </label>
                                                <select class="form-control shopselect" name="shopcategory_id">
                                                    <option value="">Select Category</option>
                                                    @foreach($shopcategories as $shopcategory)
                                                        <option
                                                            value="{{$shopcategory->id}}">{{$shopcategory->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Company Name </label>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Owner Name </label>
                                                <input type="text" class="form-control" id="ownername" name="ownername">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Email </label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Mobile No </label>
                                                <input type="number" class="form-control" id="phoneno" name="phoneno">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Address </label>
                                                <textarea class="form-control" name="address"></textarea>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Country </label>
                                                <select class="form-control shopselect country_id" name="country_id">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">State </label>
                                                <select class="form-control shopselect state_id" name="state_id">
                                                    <option value="">Select State</option>

                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">City </label>
                                                <select class="form-control shopselect city_id" name="city_id">
                                                    <option value="">Select City</option>

                                                </select>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Pincode </label>
                                                <input type="number" class="form-control" name="pincode">
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
            $('.shopselect').select2();
            $(document).on('change','.country_id',function (){
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.state.select')}}",
                    data: {
                        '_token': $('input[name="_token"]').val(),
                        'country_id': $('.country_id').val()
                    },
                    success: function (data) {
                        // console.log(data);
                        $(".state_id").html("");

                        $(".state_id").html(data);

                    }
                });
            })
            $(document).on('change','.state_id',function (){
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.city.select')}}",
                    data: {
                        '_token': $('input[name="_token"]').val(),
                        'state_id': $('.state_id').val()
                    },
                    success: function (data) {
                        // console.log(data);
                        $(".city_id").html("");

                        $(".city_id").html(data);

                    }
                });
            })

            $(".shopFrm").validate({
                rules:
                    {
                        name:
                            {
                                required: true
                            },
                        ownername:
                            {
                                required: true
                            },
                        phoneno:
                            {
                                required: true,

                            },
                        email:
                            {
                                required: true,
                                email: true
                            },
                        address:
                            {
                                required: true
                            },
                    },
                messages:
                    {
                        name:
                            {
                                required: "Name is required"
                            },
                        ownername:
                            {
                                required: "Owner Name is required"
                            },
                        phoneno:
                            {
                                required: "Mobile No is required",

                            },
                        email:
                            {
                                required: "Email is required",
                                email: 'Email is in invalid format'
                            },
                        address:
                            {
                                required: "Address is required"
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
                if ($(".shopFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.shops.store')}}",
                        data: new FormData($('.shopFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Shop Created Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.shops.index')}}"
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
