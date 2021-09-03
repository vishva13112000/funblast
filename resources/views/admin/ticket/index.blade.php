@extends('admin.layout.auth')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Ticket</h5>

                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('admin.ticket.index')}}">Ticket</a>
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
                        <h5>Ticket Master</h5>
                       
                        <!-- <div class="card-header-right">
                            <a href="{{route('admin.ticket.create')}}" class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add Ticket</a>

                        </div> -->

                    </div>
                    <br/>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table " id="ticket">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer Name</th> 
                                        <th>Ride</th>          
                                        <th>Persons</th>
                                        <th>Total Ammount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php

                                @endphp
                                <tbody>
                                    @foreach($rides as $ride)
                                    
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
</div>

@stop
@push('custom-scripts')
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
</script>
@endpush
