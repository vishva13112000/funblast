@extends('admin.layout.auth')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Add Customer</h5>
                    {{--                        <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>--}}
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{route('branch.home')}}"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('branch.customer.index')}}">Customer</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('branch.customer.create')}}">Add Customer</a>
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
                                <h5>Add Customer</h5>

                            </div>
                            <div class="card-block">

                                <form class="customerFrm">
                                    @method('POST')
                                    @csrf
                                    <div class="row">

                                       <div class="form-group col-4">
                                        <label for="title">Customer Name </label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="title">Email </label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="title">Contact</label>
                                        <input type="number" class="form-control" id="mobileno" name="mobileno">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="title">Password </label>
                                        <input type="text" class="form-control" id="password" name="password">
                                    </div>

                                    <!--   <div class="form-group col-4">
                                                <label for="title">Branch </label>
                                                <select class="form-control selectbranch" name="branch_id">
                                                    <option value="">Select Branch</option>
                                                    @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        -->
                                        


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
        $('.selectbranch').select2();
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
                password:
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
                email:
                {
                    required: "Email is required"
                }, 
                password:
                {
                    required: "Password is required"
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
                        url: "{{route('branch.customer.store')}}",
                        data: new FormData($('.customerFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "customer Created Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('branch.customer.index')}}"
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
