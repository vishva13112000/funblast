@extends('admin.layout.auth')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Add Ticket</h5>
                    {{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('admin.ticket.index')}}">Ticket</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('admin.ticket.create')}}">Add Ticket</a>
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
                                <h5>Add Ticket</h5>

                            </div>
                            <div class="card-block">

                                <form class="rideFrm">
                                    @method('POST')
                                    @csrf

                                    <div class="row">

                                     <div class="form-group col-4">
                                         <label for="title">Customer id
                                          <span class="text-danger">*</span></label>
                                          <!--end::Label-->
                                          <select class="form-control" name="name">
                                            <option value="">--Select Customer--</option>
                                            @if(!empty($customers))
                                            @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>

                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>



                                    <div class="form-group col-4">
                                     <label for="title">Rides 
                                      <span class="text-danger">*</span></label>
                                      <!--end::Label-->
                                      <select class="form-control" name="role" id="ride_id">
                                        <option value="">--Select Ride--</option>
                                        @if(!empty($rides))
                                        @foreach($rides as $ride)
                                        <option value="{{ $ride->id }}">{{ $ride->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

                                <div class="form-group col-4">
                                    <label> Ride Ammount
                                    </label>
                                    <input readonly type="text" class="form-control numbersOnly" name="price" placeholder="Price" />

                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>


                                <div class="col-md-3 my-auto"> <input type="hidden" class="prod_id"

                                    value="">

                                    <label for="Debit_ammount">Debit Ammount(Total Customers)</label> <div class="input-group text-center mb-3" style="width:10px;">

                                        <button class="input-group-text changeQuantity decrement-btn">-</button> <input type="text" name="debit_ammount" class="form-control ty-input text-center">

                                        <button class="input-group-text changeQuantity increment-btn">+</button>

                                    </div> 
                                </div>

                                    <div class="form-group col-4">
                                    <label> Total Ammount
                                    </label>
                                    <input readonly type="text" class="form-control numbersOnly" name="price" placeholder="Total" />

                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>

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
        $(document).on('change','#ride_id',function(){

            $.ajax({
                type: "POST",
                url: "{{route('admin.ticket.selectamount')}}",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'ride_id': $('#ride_id').val()
                },
                success: function (data)
                {
                    // console.log()
                    $(".numbersOnly").val("");
                    $(".numbersOnly").val(data['ride'].ammount);
                }
            });
        })
        $('.selectshop').select2();
        $(".rideFrm").validate({
            rules:
            {
                name:
                {
                    required: true
                },
                price:
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
                name:
                {
                    required: "Name is required"
                },
                price:
                {
                    required: "price is required"
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
                if ($(".rideFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.ride.store')}}",
                        data: new FormData($('.rideFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Ride Created Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.ride.index')}}"
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
