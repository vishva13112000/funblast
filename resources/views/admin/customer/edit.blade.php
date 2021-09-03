@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Customer</h5>
                        {{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.customer.index')}}">Customer</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.customer.edit',$customer->id)}}">Edit
                                Customer</a>
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
                                    <h5>Edit Customer</h5>

                                </div>
                                <div class="card-block">

                                    <form class="customerFrm">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            
                                            <div class="form-group col-4">
                                                <label for="title">Customer Name </label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{$customer->name}}">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                       value="{{$customer->id}}">
                                            </div>

                                               <div class="form-group col-4">
                                                <label for="title">Email </label>
                                                <input type="text" class="form-control" id="email" name="email"
                                                       value="{{$customer->email}}">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                       value="{{$customer->id}}">
                                            </div>


                                              <div class="form-group col-4">
                                                <label for="title">Date Of Birth </label>
                                                <input type="date" class="form-control" id="date" name="date"
                                                       value="{{$customer->date}}">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                       value="{{$customer->id}}">
                                            </div>

                                             <div class="form-group col-4">
                                                <label for="title">Contact </label>
                                                <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="Enter Mobile no" maxlength="10" onkeypress="return isNumber(event)" value="{{$customer->mobileno}}">
                                                
                                            </div>


                                             <div class="form-group col-4">
                                                <label for="title">Password </label>
                                                <input type="text" class="form-control" id="viewpassword" name="viewpassword"value="{{$customer->viewpassword}}" readonly="">
                                               
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">New Password </label>
                                                <input type="text" class="form-control" id="password" name="password">
                                              
                                            </div>

                                           
                                            

                                            <div class="form-group col-12">
                                                <button type="submit"
                                                        class="btn btn-inverse btn-round waves-effect waves-light submit">
                                                    Update
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
            $(".customerFrm").validate({
                rules:
                    {
                        name:
                            {
                                required: true
                            },
                        email:
                            {
                                required: true
                            },


                    },
                messages:
                    {
                        name:
                            {
                                required: "Title is required"
                            },
                        email:
                            {
                                required: "email is required"
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
                if ($(".customerFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.customer.update')}}",
                        data: new FormData($('.customerFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "customer Updated Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.customer.index')}}"
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
    
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

@endpush
