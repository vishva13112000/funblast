@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Shops</h5>

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.shops.index')}}">Shops</a>
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
                            <h5>Shop Lists</h5>
{{--                            <span>use class <code>table</code> inside table element</span>--}}
                            <div class="card-header-right">
                            <a href="{{route('admin.shops.create')}}" class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add Shop</a>

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

                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Status</th>
                                        <th>Verification</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shops as $shop)
                                    <tr>
                                        <th scope="row">{{$shop->name}}</th>
                                        <td>{{$shop->ownername}}</td>

                                        <td>{{$shop->email}}</td>
                                        <td>{{$shop->phoneno}}</td>
                                        <td>
                                            @if($shop->active == 1)
                                                <div class="btn-group-horizontal" id="assign_remove_{{$shop->id }}" >
                                                    <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="{{route('admin.shops.unassigned')}}" ruid="{{ $shop->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_add_{{ $shop->id }}"  style="display: none"  >
                                                    <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $shop->id }}" url="{{route('admin.shops.assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>
                                            @endif
                                            @if($shop->active == 0)
                                                <div class="btn-group-horizontal" id="assign_add_{{ $shop->id }}" >
                                                    <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $shop->id }}" url="{{route('admin.shops.assign')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_remove_{{ $shop->id }}" style="display: none" >
                                                    <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $shop->id }}" data-style="slide-left" url="{{route('admin.shops.unassigned')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                                @if($shop->verify_by_admin == 1)
                                                    <div class="btn-group-horizontal" id="vassign_remove_{{$shop->id }}" >
                                                        <button class="btn btn-success vunassign ladda-button" data-style="slide-left" id="remove" url="{{route('admin.shops.unverify')}}" ruid="{{ $shop->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Verified</span> </button>
                                                    </div>
                                                    <div class="btn-group-horizontal" id="vassign_add_{{ $shop->id }}"  style="display: none"  >
                                                        <button class="btn btn-danger vassign ladda-button" data-style="slide-left" id="vassign" uid="{{ $shop->id }}" url="{{route('admin.shops.verify')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Not Verified</span></button>
                                                    </div>
                                                @endif
                                                @if($shop->verify_by_admin == 0)
                                                    <div class="btn-group-horizontal" id="vassign_add_{{ $shop->id }}" >
                                                        <button class="btn btn-danger vassign ladda-button" id="vassign" data-style="slide-left" uid="{{ $shop->id }}" url="{{route('admin.shops.verify')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Not Verified</span></button>
                                                    </div>
                                                    <div class="btn-group-horizontal" id="vassign_remove_{{ $shop->id }}" style="display: none" >
                                                        <button class="btn  btn-success vunassign ladda-button" id="remove" ruid="{{ $shop->id }}" data-style="slide-left" url="{{route('admin.shops.unverify')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Verified</span></button>
                                                    </div>
                                                @endif
                                        </td>
                                        <td><a class="btn waves-effect waves-light btn-primary" href="{{route('admin.shops.edit',$shop->id)}}"><i class="fa fa-pencil"></i></a>

                                            <a class="btn waves-effect waves-light btn-info" href="{{route('admin.shops.show',$shop->id)}}"><i class="fa fa-info"></i></a>
{{--                                            <button data-id="{{ $shop->id }}"--}}
{{--                                                    data-token="{{ csrf_token() }}" class="btn waves-effect waves-light btn-danger"><i class="fa fa-trash"></i></button>--}}
                                        </td>
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
            <div id="styleSelector"></div>
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
