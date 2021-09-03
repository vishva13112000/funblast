@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Subscription</h5>
{{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.subscription.index')}}">Subscription</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.subscription.create')}}">Add Subscription</a>
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
                                    <h5>Add Subscription</h5>

                                </div>
                                <div class="card-block">

                                    <form class="subscriptionFrm">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="title">Subscription Name </label>
                                                <input type="text" class="form-control" id="title" name="title">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Duration </label>
                                                <input type="number" class="form-control" id="duration" name="duration">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Duration Type </label>
                                                <select class="form-control" name="durationtype">
                                                    <option value="month">Months</option>
                                                    <option value="year">Years</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Price </label>
                                                <input type="number" class="form-control" id="price" name="price">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Subscription Type </label>
                                                <select class="form-control" name="subscriptiontype">
                                                    <option value="1">Shops</option>
                                                    <option value="2">Advertisement</option>
                                                    <option value="3">Shops & Advertisements</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-12">
                                            <button  type="submit" class="btn btn-inverse btn-round waves-effect waves-light submit" >Save</button>
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
            $(".subscriptionFrm").validate({
                rules:
                    {
                        title:
                            {
                                required: true
                            },
                        duration:
                            {
                                required: true
                            },
                        price:
                            {
                                required: true
                            },

                    },
                messages:
                    {
                        title:
                            {
                                required: "Title is required"
                            },
                        duration:
                            {
                                required: "Duration is required"
                            },
                        price:
                            {
                                required: "Price is required"
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
                if ($(".subscriptionFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.subscription.store')}}",
                        data: new FormData($('.subscriptionFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache:false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Subscription Created Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.subscription.index')}}"
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
