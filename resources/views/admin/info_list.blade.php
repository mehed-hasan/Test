@extends('admin.layout')
@section('head')
<link rel="stylesheet" href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
<style>
    .min_img{
        height:auto;
        width:60px;
        position: relative;
    }
    .min_img img{
        object-fit: cover;
    }
</style>
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
                            <h2><strong>Info</strong> Lists </h2>
                        </div>
                        <div class="body">
                            @if (session()->has('message'))
                                <p class="alert alert-success"> {{session('message')}}</p>
                            @endif

                            @if (session()->has('error_message'))
                            <p class="alert alert-danger"> {{session('error_message')}}</p>
                        @endif


                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Website Logo</th>
                                            <th>Contact No</th>
                                            <th>Email</th>
                                            <th>Open Hour</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
       
                                    <tbody>
                                        @foreach ($datas as $data )
                                        <tr>
                                            
                                            <td ><img class="min_img img-thumbnail" src=" {{$data->logo == 'null' ? asset('uploads/logo/default_logo/add_logo.png')  : asset('uploads/logo/'.$data->logo)  }} " alt="" srcset=""></td>
                                            <td>{{$data->contact_no}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->open_hour}}</td>
                                            <td>{{$data->address}}</td>
                                            <td><a class="btn btn-default" href="/admin/edit_info/{{$data->id}}">Edit</a></td>
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
<script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>


@endsection