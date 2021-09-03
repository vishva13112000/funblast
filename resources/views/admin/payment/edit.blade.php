@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Payment</h5>
                        {{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.payment.index')}}">Payment</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.payment.edit',$payment->id)}}">Edit
                                Payment</a>
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
                                    <h5>Edit Payment</h5>

                                </div>
                                <div class="card-block">

                                    <form class="paymentFrm">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            
                                            <div class="form-group col-4">
                                                <label for="title"> Name </label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                       value="{{$payment->title}}">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                       value="{{$payment->id}}">
                                            </div>


                                             <div class="form-group col-4">
                                                <label for="title">Credit </label>
                                                <input type="text" class="form-control" id="credit" name="credit"
                                                       value="{{$payment->credit}}">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                       value="{{$payment->id}}">
                                            </div>


                                             <div class="form-group col-4">
                                                <label for="title">Debit </label>
                                                <input type="text" class="form-control" id="debit" name="debit"
                                                       value="{{$payment->debit}}">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                       value="{{$payment->id}}">
                                            </div>


                                             <div class="form-group col-4">
                                                <label for="title">Total_Amount </label>
                                                <input type="text" class="form-control" id="total_amount" name="total_amount"
                                                       value="{{$payment->total_amount}}">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                       value="{{$payment->id}}">
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
            $(".paymentFrm").validate({
                rules:
                    {
                        name:
                            {
                                required: true
                            },
                        credit:
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
                        credit:
                            {
                                required: "credit is required"
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
                if ($(".paymentFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.payment.update')}}",
                        data: new FormData($('.paymentFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "payment Updated Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.payment.index')}}"
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
