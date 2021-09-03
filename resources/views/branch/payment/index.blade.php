@extends('branch.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Payment History</h5>

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('branch.payment.index')}}">Payment</a>
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
                      
                        <br/>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table " id="payment">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Ride Name</th>
                                        <th>Person</th>
                                        <th>Credit</th>
                                        <th>Debit</th>
                                        <th>Current Balance</th>
                                                          

                                        <!-- <th>Action</th> -->
                                    </tr>
                                    </thead>
                                    @php

                                    @endphp
                                    <tbody>
                                     @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment->id}}</td>
                                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}</td>
                                        <td>{{$payment->title}}</td>
                                        <td>{{ App\Models\Ride::where('id',$payment->ride_id)->value('name') }}</td>
                                        <td>{{ $payment->person }}</td>
                                        <td>{{$payment->credit}}</td>
                                        <td>{{$payment->debit}}</td>
                                        <td>₹ {{$payment->total_amount}}</td>

                                       <!--  <td>
                                            <a class="btn waves-effect waves-light btn-primary" href="{{route('admin.payment.edit',$payment->id)}}"><i class="fa fa-pencil"></i></a>
                                            <button data-id="{{$payment->id }}" class="btn btn-dark vishbaby"><i class="fa fa-dollar"></i></button>


                                        </td> -->
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

            var payment = $(this).attr('uid');
            var url = $(this).attr('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: payment,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+payment).show();
                    $('#assign_add_'+payment).hide();
                }
            });
        });
        $('.unassign').click(function(){
            var payment = $(this).attr('ruid');
            var url = $(this).attr('url');


            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: payment,
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    $('#assign_remove_'+payment).hide();
                    $('#assign_add_'+payment).show();
                }
            });
        });


        $(document).ready(function () {

            $('#payment').DataTable({
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
         $.ajax({
                        type: "POST",
                        url: "{{route('branch.payment.money')}}",
                        data: new FormData($('.moneyFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "payment Updated Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('branch.payment.index')}}"
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
