@extends('branch.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Customer History</h5>

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('branch.customer.index')}}">Customer</a>
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
                            <h5>Customer Lists</h5>
                            <div class="card-header-right">
                            <a href="{{route('branch.customer.create')}}" class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add Customer </a>

                            </div>

                        </div>
                        <br/>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table " id="customer">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Amount</th>
                                        <th>Branch Name</th>
                                        <th>Status</th>                     

                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    @php

                                    @endphp
                                    <tbody>
                                     @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$customer->id}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->mobileno}}</td>
                                        <td>{{$customer->amount}}</td>
                            
                              
                                        <td>
                                            @if($customer->active == 1)
                                                <div class="btn-group-horizontal" id="assign_remove_{{$customer->id }}" >
                                                    <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="{{route('branch.customer.unassigned')}}" ruid="{{ $customer->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                                </div>
                                                <div class="btn-group-horizontal" id="assign_add_{{ $customer->id }}"  style="display: none"  >
                                                    <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $customer->id }}" url="{{route('branch.customer.assign')}}" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>
                                            @endif
                                            @if($customer->active == 0)
                                                <div class="btn-group-horizontal" id="assign_add_{{ $customer->id }}" >
                                                    <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $customer->id }}" url="{{route('branch.customer.assign')}}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Inactive</span></button>
                                                </div>

                                                <div class="btn-group-horizontal" id="assign_remove_{{ $customer->id }}" style="display: none" >
                                                    <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $customer->id }}" data-style="slide-left" url="{{route('branch.customer.unassigned')}}" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn waves-effect waves-light btn-primary" href="{{route('branch.customer.edit',$customer->id)}}"><i class="fa fa-pencil"></i></a>
                                            <button data-id="{{$customer->id }}" class="btn btn-dark vishbaby"><i class="fa fa-dollar"></i></button>
                                             <a href="{{route('branch.customer.paymentHistory',$customer->id)}}" style="background-color: white;"><i class="btn btn-warning fa fa-history" style="color: blue;"></i></a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>
@stop
@push('custom-scripts')
    <script>
        $('.assign').click(function(){

            var customer = $(this).attr('uid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: customer,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+customer).show();
                    $('#assign_add_'+customer).hide();
                }
            });
        });
        $('.unassign').click(function(){
            var customer = $(this).attr('ruid');
            var url = $(this).attr('url');


            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: customer,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+customer).hide();
                    $('#assign_add_'+customer).show();
                }
            });
        });


        $(document).ready(function () {

            $('#customer').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    <script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.vishbaby',function(){
        
        $('#exampleModal').modal('show')
        $('#id').val('')
           $('#amount').val('')
        $('#id').val($(this).data('id'))
    })
     $(".moneyFrm").validate({
                rules:
                    {
                        amount:
                            {
                                required: true
                            },
                       

                    },
                messages:
                    {
                        amount:
                            {
                                required: "Amount is required"
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
$(document).on('click','.submit',function(){
        event.preventDefault();
                if ($(".moneyFrm").valid()) { 
                    $('.submit').attr('disabled','disabled')
                    $('#exampleModal').modal('hide')
         $.ajax({
                        type: "POST",
                        url: "{{route('branch.customer.money')}}",
                        data: new FormData($('.moneyFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "customer Updated Successfully",
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
    })


})
</script>
@endpush
