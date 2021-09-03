@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Discount History</h5>

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.discount.index')}}">Discount</a>
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
                            <h5>Discount Lists</h5>
                            <div class="card-header-right">
                            <a href="{{route('admin.discount.create')}}" class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add Discount</a>

                            </div>

                        </div>
                        <br/>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table " id="discount">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Days</th>
                                        <th>Discount</th>
                                      

                                        <th>Status</th>                     

                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    @php

                                    @endphp
                                    <tbody>
                                     @foreach($discounts as $discount)
                                    <tr>
                                        <td>{{$discount->id}}</td>
                                        <td>{{$discount->days}}</td>
                                        <td>{{$discount->discount}}</td>
                                        


                                        <td>
                                            @if($discount->active == 1)
                                                <div class="btn-group-horizontal" id="assign_remove_{{$discount->id }}" >
                                                    <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="{{route('admin.discount.unassigned')}}" ruid="{{ $discount->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_add_{{ $discount->id }}"  style="display: none"  >
                                                    <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $discount->id }}" url="{{route('admin.discount.assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>
                                            @endif
                                            @if($discount->active == 0)
                                                <div class="btn-group-horizontal" id="assign_add_{{ $discount->id }}" >
                                                    <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $discount->id }}" url="{{route('admin.discount.assign')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>

                                                <div class="btn-group-horizontal" id="assign_remove_{{ $discount->id }}" style="display: none" >
                                                    <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $discount->id }}" data-style="slide-left" url="{{route('admin.discount.unassigned')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn waves-effect waves-light btn-primary" href="{{route('admin.discount.edit',$discount->id)}}"><i class="fa fa-pencil"></i></a>
                                          
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

            var discount = $(this).attr('uid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: discount,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+discount).show();
                    $('#assign_add_'+discount).hide();
                }
            });
        });
        $('.unassign').click(function(){
            var discount = $(this).attr('ruid');
            var url = $(this).attr('url');


            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: discount,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+discount).hide();
                    $('#assign_add_'+discount).show();
                }
            });
        });


        $(document).ready(function () {

            $('#discount').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    
@endpush
