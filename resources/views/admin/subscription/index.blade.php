@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Subscription</h5>

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.subscription.index')}}">Subscription</a>
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
                            <h5>Subscription Lists</h5>
{{--                            <span>use class <code>table</code> inside table element</span>--}}
                            <div class="card-header-right">
                            <a href="{{route('admin.subscription.create')}}" class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add Subscription</a>

                            </div>

                        </div>
                        <br/>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table " id="subscription">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Duration</th>
                                        <th>Price</th>
                                        <th>Subscription Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    @php

                                    @endphp
                                    <tbody>
                                    @foreach($subscriptions as $subscription)
                                    <tr>
                                        <td>{{$subscription->id}}</td>
                                        <td>{{$subscription->title}}</td>
                                        <td>{{$subscription->duration}} {{$subscription->durationtype}}</td>
                                        <td>{{$subscription->price}} Rs.</td>
                                        <td>
                                            @if($subscription->subscriptiontype ==1)
                                                <label class="label label-danger">Shop</label>
                                            @elseif($subscription->subscriptiontype==2)
                                                <label class="label label-primary">Advertisements</label>
                                            @else
                                                <label class="label label-dark">Shop & Advertisements</label>
                                            @endif
                                        </td>



                                        <td>
                                            @if($subscription->active == 1)
                                                <div class="btn-group-horizontal" id="assign_remove_{{$subscription->id }}" >
                                                    <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="{{route('admin.subscription.unassigned')}}" ruid="{{ $subscription->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_add_{{ $subscription->id }}"  style="display: none"  >
                                                    <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $subscription->id }}" url="{{route('admin.subscription.assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>
                                            @endif
                                            @if($subscription->active == 0)
                                                <div class="btn-group-horizontal" id="assign_add_{{ $subscription->id }}" >
                                                    <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $subscription->id }}" url="{{route('admin.subscription.assign')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_remove_{{ $subscription->id }}" style="display: none" >
                                                    <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $subscription->id }}" data-style="slide-left" url="{{route('admin.subscription.unassigned')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                                </div>
                                            @endif
                                        </td>

                                        <td><a class="btn waves-effect waves-light btn-primary" href="{{route('admin.subscription.edit',$subscription->id)}}"><i class="fa fa-pencil"></i></a>

{{--                                            <button data-id="{{ $subscription->id }}"--}}
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

            var subscription_id = $(this).attr('uid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: subscription_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+subscription_id).show();
                    $('#assign_add_'+subscription_id).hide();
                }
            });
        });
        $('.unassign').click(function(){
            var subscription_id = $(this).attr('ruid');
            var url = $(this).attr('url');


            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: subscription_id,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+subscription_id).hide();
                    $('#assign_add_'+subscription_id).show();
                }
            });
        });


        $(document).ready(function () {

            $('#subscription').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
