@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Ride</h5>
                        {{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.ride.index')}}">Ride</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.ride.edit',$ride->id)}}">Edit
                                Ride</a>
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
                                    <h5>Edit Ride</h5>

                                </div>
                                <div class="card-block">

                                    <form class="rideFrm">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            
                                            <div class="form-group col-4">
                                                <label for="name">Ride Name </label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{$ride->name}}">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                       value="{{$ride->id}}">
                                            </div>

                                           <div class="form-group col-4">
                                                <label for="title">Ride Image </label>
                                                <input type="file" class="form-control" id="image" name="image"
                                                       accept="image/*">
                                            </div>
                                            <div class="form-group col-12">

                                                <img src="{{url($ride->image)}}" height="100px;" width="200px;">
                                            </div>

                                              <div class="form-group col-4">
                                            <label>Description:</label>
                                            <textarea class="form-control" value="{{$ride->description}}" placeholder="Enter Description" name="description">{{$ride->description}}</textarea>
                                            </div>

                                             <div class="form-group col-4">
                                            <label> Ammount
                                            <span class="text-danger"></span></label>
                                            <input type="text" class="form-control numbersOnly" name="ammount" value="{{$ride->ammount}}" placeholder="Ammount" onkeypress="return isNumber(event)"/>

                                    <!--end::Input-->
                                             @foreach($errors->get('ammount') as $error)
                                            <span class="help-block">{{ $error }}</span>
                                            @endforeach
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
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


                    },
                messages:
                    {
                        name:
                            {
                                required: "Title is required"
                            },
                        price:
                            {
                                required: "Shops is required"
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
                        url: "{{route('admin.ride.update')}}",
                        data: new FormData($('.rideFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Ride Updated Successfully",
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
