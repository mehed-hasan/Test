@extends('admin.layout')

@section('head')
<link rel="stylesheet" href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="container">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="header">
                            <h2><strong>Order</strong> Lists </h2>
                        </div>
                        <div class="body">

                            @if (session()->has('message'))
                                <p class="alert alert-success">{{session('message')}}</p>                                
                            @endif

                        @if (session()->has('error_message'))
                            <p class="alert alert-success">{{session('error_message')}}</p>                                
                        @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User Id </th>
                                        <th>Invoice No</th>
                                        <th>Status</th>
                                        <th>Reciving Time </th>
                                        <th>Order type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                    <tbody>
                                            @foreach ($orderDatas as $orderData )
                                            <tr>
                                                {{-- <td><img src="{{asset('')}}uploads/product_images/{{$orderData->image1}}" alt="Product img"></td> --}}
                                                <td>{{$orderData->name}}</td>
                                                <td>#{{$orderData->user_id}}</td>
                                                <td>#{{$orderData->id}}</td>
                                                <td><span class="badge badge-{{$orderData->is_ordered == 1 ? 'info' : 'primary'}}">{{$orderData->is_ordered == 1 ? 'New' : 'Completed'}}</span></td>
                                                <td>{{$orderData->dlv_time}}</td>
                                                <td>{{$orderData->order_type == 1 ? 'Paid' : "Cash On"}}</td>
                                                <td>
                                                    <a href="/admin/order_details/{{$orderData->id}}/{{$orderData->user_id}}" class="btn btn-succcess">View</a>

                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection


@section('scripts')

<!-- Jquery DataTable Plugin Js --> 
<script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>

{{-- Deleting script --}}

@endsection