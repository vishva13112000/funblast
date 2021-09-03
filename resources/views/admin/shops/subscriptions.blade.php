@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Shop Subscription</h5>

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.shops.subscriptions')}}">Shops Subscription</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="card-header" style="height: 80px;">
                            <h5>Shop Subscriptions</h5>
{{--                            <span>use class <code>table</code> inside table element</span>--}}
                            <div class="card-header-right">
{{--                            <a href="{{route('admin.shops.create')}}" class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add Shop</a>--}}

                            </div>

                        </div>
                        <br/>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table " id="shops">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Owner Name</th>
                                        <th>Subscription</th>
                                        <th>Price</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shopsubscriptions as $shopsubscription)
                                    <tr>
                                        <th scope="row">{{$shopsubscription->shop->name}}</th>
                                        <td>{{$shopsubscription->shop->ownername}}</td>
                                        <td>{{$shopsubscription->subscription->title}}</td>
                                        <td>{{$shopsubscription->price}} Rs.</td>
                                        <td>{{$shopsubscription->startdate}}</td>
                                        <td>{{$shopsubscription->enddate}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Basic table card end -->

                </div>
                <!-- Page-body end -->
            </div>

        </div>
    </div>

@stop
@push('custom-scripts')
    <script>
        $('.assign').click(function(){

            var shop_id = $(this).attr('uid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: shop_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+shop_id).show();
                    $('#assign_add_'+shop_id).hide();
                }
            });
        });
        $('.unassign').click(function(){
            var shop_id = $(this).attr('ruid');
            var url = $(this).attr('url');


            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: shop_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+shop_id).hide();
                    $('#assign_add_'+shop_id).show();
                }
            });
        });

        $('.vassign').click(function(){

            var shop_id = $(this).attr('uid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: shop_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#vassign_remove_'+shop_id).show();
                    $('#vassign_add_'+shop_id).hide();
                }
            });
        });
        $('.vunassign').click(function(){
            var shop_id = $(this).attr('ruid');
            var url = $(this).attr('url');


            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: shop_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#vassign_remove_'+shop_id).hide();
                    $('#vassign_add_'+shop_id).show();
                }
            });
        });
        $(document).ready(function () {

            $('#shops').DataTable({

            });
        });
    </script>
@endpush
