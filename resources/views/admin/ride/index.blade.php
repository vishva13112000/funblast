@extends('admin.layout.auth')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Ride</h5>

                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('admin.ride.index')}}">Ride</a>
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
                        <h5>Ride Master</h5>
                        {{--                            <span>use class <code>table</code> inside table element</span>--}}
                        <div class="card-header-right">
                            <a href="{{route('admin.ride.create')}}" class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add Ride</a>

                        </div>

                    </div>
                    <br/>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table " id="ride">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>

                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Ammount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php

                                @endphp
                                <tbody>
                                    @foreach($rides as $ride)
                                    <tr>
                                        <td>{{$ride->id}}</td>
                                        <td>{{$ride->name}}</td>
                                        <td>{{$ride->description}}</td>

                                        <br>

                                        <td><img src="{{ asset($ride->image) }}" height="100px;" width="200px;"></td>

                                        <td>
                                            @if($ride->active == 1)
                                            <div class="btn-group-horizontal" id="assign_remove_{{$ride->id }}" >
                                                <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="{{route('admin.ride.unassigned')}}" ruid="{{ $ride->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                            </div>
                                            <div class="btn-group-horizontal" id="assign_add_{{ $ride->id }}"  style="display: none"  >
                                                <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $ride->id }}" url="{{route('admin.ride.assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                            </div>
                                            @endif
                                            @if($ride->active == 0)
                                            <div class="btn-group-horizontal" id="assign_add_{{ $ride->id }}" >
                                                <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $ride->id }}" url="{{route('admin.ride.assign')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                            </div>
                                            <div class="btn-group-horizontal" id="assign_remove_{{ $ride->id }}" style="display: none" >
                                                <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $ride->id }}" data-style="slide-left" url="{{route('admin.ride.unassigned')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{$ride->ammount}}</td>

                                        <td><a class="btn waves-effect waves-light btn-primary" href="{{route('admin.ride.edit',$ride->id)}}"><i class="fa fa-pencil"></i></a>

                                            <button data-id="{{ $ride->id }}"
                                             data-token="{{ csrf_token() }}" class="btn waves-effect waves-light btn-danger delete"><i class="fa fa-trash"></i></button>

                                             <a class="btn waves-effect waves-light btn-primary" 
                                             data-toggle="modal" data-target="#scan_qr" style="background-color: #212121;" onclick="ScanQR('{{ $ride->id }}')" data-original-title="Scan QR">
                                             <i class="fa fa-qrcode" style="color: #ffffff;"></i>
                                         </a>


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
<div class="modal fade" id="scan_qr" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="kt-scroll ps ps--active-y modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAppoinmentModalLabel">Scan QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="show_qr" data-scroll="true" data-height="auto">
                    <img src="#" id="qr1" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


@stop
@push('custom-scripts')
<script src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Creating-QR-Codes-On-Your-Website-ClassyQR/js/jquery.classyqr.js"></script>
<script>
    $('.assign').click(function(){

        var category_id = $(this).attr('uid');
        var url = $(this).attr('url');

        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: ride_id,
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            dataType: 'json',
            success: function(data){
                $('#assign_remove_'+ride_id).show();
                $('#assign_add_'+ride_id).hide();
            }
        });
    });
    $('.unassign').click(function(){
        var ride_id = $(this).attr('ruid');
        var url = $(this).attr('url');


        $.ajax({
            url: url,
            type: "PUT",
            data: {
                id: ride_id,
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            dataType: 'json',
            success: function(data){
                $('#assign_remove_'+ride_id).hide();
                $('#assign_add_'+ride_id).show();
            }
        });
    });


    $(document).ready(function () {

        $('#ride').DataTable({
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    $(".delete").click(function(){

        var id = $(this).data("id");

        var token = $(this).data("token");
        $.ajax(
        {
            url: "{{Route('admin.ride.delete')}}",
            type: 'POST',
            dataType: "JSON",
            data: {
                "id": id,
                "_token": token,
            },
            success: function ()
            {
                location.reload();
            }
        });

        console.log("It failed");
    });

    function ScanQR(id){
    $.ajax({
        type: "post",
        url: "{{ route('admin.scan.qr') }}",
        data: {
            '_token': $('input[name="_token"]').val(),
            'id': id
        },
        cache: false,
        success: function (data)
        {
            // var info = '{ Ride_id : '+data.data.id+'<br/>Ride_Name : '+data.data.name+'<br/> Ammount : '+data.data.ammount+'}';
            $("#qr1").ClassyQR({
                type: 'text',
                text: data.data.id,
            });

        }
    });
}
</script>

@endpush
