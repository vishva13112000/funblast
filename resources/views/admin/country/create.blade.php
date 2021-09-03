@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Country</h5>
{{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.country.index')}}">Country</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.country.create')}}">Add Country</a>
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
                                    <h5>Add Country</h5>

                                </div>
                                <div class="card-block">

                                    <form class="countryFrm">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="title">Country Name </label>
                                                <input type="text" class="form-control" id="name" name="name">
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
            $(".countryFrm").validate({
                rules:
                    {
                        name:
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
                if ($(".countryFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.country.store')}}",
                        data: new FormData($('.countryFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache:false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Country Created Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.country.index')}}"
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
