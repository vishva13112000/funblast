@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Shop Category</h5>

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.shopcategory.index')}}">Shop Category</a>
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
                            <h5>Shop Category Lists</h5>
{{--                            <span>use class <code>table</code> inside table element</span>--}}
                            <div class="card-header-right">
                            <a href="{{route('admin.shopcategory.create')}}" class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add Shop Category</a>

                            </div>

                        </div>
                        <br/>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table " id="shopcategory">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    @php

                                    @endphp
                                    <tbody>
                                    @foreach($shopcategories as $shopcategory)
                                    <tr>
                                        <td>{{$shopcategory->id}}</td>
                                        <td>{{$shopcategory->title}}</td>
                                        <td><img src="{{url($shopcategory->image)}}" height="100px;" width="200px;"></td>

                                        <td>
                                            @if($shopcategory->active == 1)
                                                <div class="btn-group-horizontal" id="assign_remove_{{$shopcategory->id }}" >
                                                    <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="{{route('admin.shopcategory.unassigned')}}" ruid="{{ $shopcategory->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_add_{{ $shopcategory->id }}"  style="display: none"  >
                                                    <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $shopcategory->id }}" url="{{route('admin.shopcategory.assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>
                                            @endif
                                            @if($shopcategory->active == 0)
                                                <div class="btn-group-horizontal" id="assign_add_{{ $shopcategory->id }}" >
                                                    <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $shopcategory->id }}" url="{{route('admin.shopcategory.assign')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_remove_{{ $shopcategory->id }}" style="display: none" >
                                                    <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $shopcategory->id }}" data-style="slide-left" url="{{route('admin.shopcategory.unassigned')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                                </div>
                                            @endif
                                        </td>

                                        <td><a class="btn waves-effect waves-light btn-primary" href="{{route('admin.shopcategory.edit',$shopcategory->id)}}"><i class="fa fa-pencil"></i></a>

{{--                                            <button data-id="{{ $shopcategory->id }}"--}}
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

            var shopcategory_id = $(this).attr('uid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: shopcategory_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+shopcategory_id).show();
                    $('#assign_add_'+shopcategory_id).hide();
                }
            });
        });
        $('.unassign').click(function(){
            var shopcategory_id = $(this).attr('ruid');
            var url = $(this).attr('url');


            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: shopcategory_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+shopcategory_id).hide();
                    $('#assign_add_'+shopcategory_id).show();
                }
            });
        });


        $(document).ready(function () {

            $('#shopcategory').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
