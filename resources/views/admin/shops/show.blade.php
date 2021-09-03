@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">View Shop</h5>
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
                        <li class="breadcrumb-item"><a href="{{route('admin.shops.show',$shop->id)}}">View Shop</a>
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
                                    <h5>View Shop</h5>

                                </div>
                                <div class="card-block">

                                    <form class="shopFrm">
                                        @method('POST')
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-4">

                                                <img
                                                    src="{{($shop->profile)?url($shop->profile):url('assets/images/im.jpg')}}"
                                                    height="200px;">
                                            </div>
                                            <div class="form-group col-8"></div>
                                            <div class="form-group col-4">
                                                <label for="title">Category </label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{$shop->shopCategory->title}}" readonly>

                                            </div>
                                            <div class="form-group col-4">
                                                <label for="title">Company Name </label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{$shop->name}}" readonly>
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                       value="{{$shop->id}}">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Owner Name </label>
                                                <input type="text" class="form-control" id="ownername" name="ownername"
                                                       value="{{$shop->ownername}}" readonly>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Email </label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       value="{{$shop->email}}" readonly>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Mobile No </label>
                                                <input type="number" class="form-control" id="phoneno" name="phoneno"
                                                       value="{{$shop->phoneno}}" readonly>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Address </label>
                                                <textarea class="form-control" name="address"
                                                          readonly> {{$shop->address}}</textarea>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">Country </label>
                                                <input type="text" class="form-control"
                                                       value="{{$shop->country->name}}" readonly>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">State</label>
                                                <input type="text" class="form-control" id="phoneno" name="phoneno"
                                                       value="{{$shop->state->name}}" readonly>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="title">City </label>
                                                <input type="text" class="form-control" id="phoneno" name="phoneno"
                                                       value="{{$shop->city->name}}" readonly>
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

    </div>
{{--    <div class="pcoded-inner-content">--}}
{{--        <!-- Main-body start -->--}}
{{--        <div class="main-body">--}}
{{--            <div class="page-wrapper">--}}

{{--                <!-- Page body start -->--}}
{{--                <div class="page-body">--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-sm-12">--}}
{{--                            <!-- Basic Form Inputs card start -->--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h5>Subscription</h5>--}}

{{--                                </div>--}}
{{--                                <div class="card-block table-border-style">--}}
{{--                                    <div class="table-responsive">--}}
{{--                                        <table class="table " id="brand">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}

{{--                                                <th>Name</th>--}}
{{--                                                <th>Start Date</th>--}}
{{--                                                <th>End Date</th>--}}
{{--                                                <th>Price</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}

{{--                                            <tbody>--}}
{{--                                            @foreach($shopsubscriptions as $shopsubscription)--}}
{{--                                                <tr>--}}

{{--                                                    <td>{{$shopsubscription->subscription->title}}</td>--}}
{{--                                                    <td>{{$shopsubscription->startdate}}</td>--}}
{{--                                                    <td>{{$shopsubscription->enddate}}</td>--}}
{{--                                                    <td>{{$shopsubscription->price}} Rs.</td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- Basic Form Inputs card end -->--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Page body end -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Main-body end -->--}}

{{--    </div>--}}
@stop
@push('custom-scripts')
@endpush
