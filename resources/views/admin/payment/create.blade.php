@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Paymentr</h5>
                        {{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.payment.index')}}">Paymentr</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.payment.create')}}">Add Payment</a>
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
                                    <h5>Add Payment</h5>

                                </div>
                                <div class="card-block">

                                    <form class="paymentFrm">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                
                                             <div class="form-group col-4">
                                                <label for="title"> Name </label>
                                                <input type="text" class="form-control" id="title" name="title">
                                            </div>


                                          <!--      <div class="form-group col-4">
                                                <label for="title"> Customer_Name </label>
                                                <input type="text" class="form-control" id="customer_id" name="customer_id">
                                            </div> -->


                                          

                                             <div class="form-group col-4">
                                            <label> Credit
                                             <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control numbersOnly" name="credit" placeholder="credit" onkeypress="return isNumber(event)"/>

                                        <!--end::Input-->
                                            @foreach($errors->get('credit') as $error)
                                            <span class="help-block">{{ $error }}</span>
                                            @endforeach
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                             </div>



                                             <div class="form-group col-4">
                                            <label> Debit
                                             <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control numbersOnly" name="debit" placeholder="debit" onkeypress="return isNumber(event)"/>

                                        <!--end::Input-->
                                            @foreach($errors->get('debit') as $error)
                                            <span class="help-block">{{ $error }}</span>
                                            @endforeach
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                             </div>


                                             <div class="form-group col-4">
                                            <label> Total_Amount
                                             <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control numbersOnly" name="total_amount" placeholder="total_amount" onkeypress="return isNumber(event)"/>

                                        <!--end::Input-->
                                            @foreach($errors->get('total_amount') as $error)
                                            <span class="help-block">{{ $error }}</span>
                                            @endforeach
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                             </div>



                                       


                                           <!--  <div class="form-group col-4">
                                                <label for="title">Category Name </label>
                                                <input type="text" class="form-control" id="title" name="title">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Category Image </label>
                                                <input type="file" class="form-control" id="image" name="image"
                                                       accept="image/*">
                                            </div> -->


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
                                required: "Name is required"
                            },
                        credit:
                            {
                                required: "Credit is required"
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
                        url: "{{route('admin.payment.store')}}",
                        data: new FormData($('.paymentFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "payment Created Successfully",
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
