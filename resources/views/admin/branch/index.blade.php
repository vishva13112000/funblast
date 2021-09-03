@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Branch History</h5>

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.branch.index')}}">Branch</a>
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
                            <h5>Branch Lists</h5>
                            <div class="card-header-right">
                            <a href="{{route('admin.branch.create')}}" class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add Branch </a>

                            </div>

                        </div>
                        <br/>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table " id="branch">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Branch Name</th>
                                        <th>Email</th>
                                      

                                        <th>Status</th>                     

                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    @php

                                    @endphp
                                    <tbody>
                                     @foreach($branches as $branch)
                                    <tr>
                                        <td>{{$branch->id}}</td>
                                        <td>{{$branch->name}}</td>
                                        <td>{{$branch->email}}</td>
                                        


                                        <td>
                                            @if($branch->active == 1)
                                                <div class="btn-group-horizontal" id="assign_remove_{{$branch->id }}" >
                                                    <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="{{route('admin.branch.unassigned')}}" ruid="{{ $branch->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_add_{{ $branch->id }}"  style="display: none"  >
                                                    <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $branch->id }}" url="{{route('admin.branch.assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>
                                            @endif
                                            @if($branch->active == 0)
                                                <div class="btn-group-horizontal" id="assign_add_{{ $branch->id }}" >
                                                    <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $branch->id }}" url="{{route('admin.branch.assign')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>

                                                <div class="btn-group-horizontal" id="assign_remove_{{ $branch->id }}" style="display: none" >
                                                    <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $branch->id }}" data-style="slide-left" url="{{route('admin.branch.unassigned')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn waves-effect waves-light btn-primary" href="{{route('admin.branch.edit',$branch->id)}}"><i class="fa fa-pencil"></i></a>
                                          
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
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Money Load</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form class="moneyFrm">
           @method('POST')
           @csrf                                  
        <label for="title">Amount </label>
        <input type="text" class="form-control" id="amount" name="amount" >
        <input type="hidden" class="form-control" id="id" name="id">   
        </form>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
@stop
@push('custom-scripts')
    <script>
        $('.assign').click(function(){

            var branch = $(this).attr('uid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: branch,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+branch).show();
                    $('#assign_add_'+branch).hide();
                }
            });
        });
        $('.unassign').click(function(){
            var branch = $(this).attr('ruid');
            var url = $(this).attr('url');


            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: branch,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+branch).hide();
                    $('#assign_add_'+branch).show();
                }
            });
        });


        $(document).ready(function () {

            $('#branch').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    
@endpush
