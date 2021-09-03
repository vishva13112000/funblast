@extends('admin.layout.auth')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">State [{{$country->name}}]</h5>

                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.state.index',$country->id)}}">State</a>
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
                            <h5>State Lists [{{$country->name}}]</h5>
                            {{--                            <span>use class <code>table</code> inside table element</span>--}}
                            <div class="card-header-right">
                                <a href="{{route('admin.state.create',$country->id)}}"
                                   class="btn waves-effect waves-light btn-grd-primary " style="color: white; ">Add
                                    State</a>

                            </div>

                        </div>
                        <br/>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table " id="state">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    @php

                                        @endphp
                                    <tbody>

                                    @foreach($states as $state)
                                        <tr>
                                            <td>{{$state->id}}</td>
                                            <td>{{$state->name}}</td>
                                            <td><a class="btn waves-effect waves-light btn-primary"
                                                   href="{{route('admin.state.edit',$state->id)}}"><i
                                                        class="fa fa-pencil"></i></a>
                                                <a class="btn waves-effect waves-light btn-dark"
                                                   href="{{route('admin.city.index',$state->id)}}"><i
                                                        class="fa fa-braille"></i>City</a>

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

        $(document).ready(function () {

            $('#state').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
