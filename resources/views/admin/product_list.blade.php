@extends('admin.layout')

@section('head')
<link rel="stylesheet" href="{{asset('plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')


{{-- Modal started  --}}
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Are you sure?</h4>
            </div>
            <div class="modal-body"> 
                Product " <span class="spec_name"> </span> " will be delete and it will never overcome.
            </div>
            <div class="modal-footer">
                <form action="{{route('product_delete')}}" method="POST">
                    @csrf
                    <input class="delete_field"  value="" type="hidden" name="delete_id">
                    <button type="submit" name="delete" class="btn btn-default btn-round waves-effect">YES DELETE</button>
                </form>
                
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">NO</button>
            </div>
        </div>
    </div>
</div>
{{-- Modak ended  --}}




<section class="content">
    <div class="body_scroll">
        <div class="container">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Product</strong> Lists </h2>
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
                                            <th>Product Name</th>
                                            <th>Product Id</th>
                                            <th>Category</th>
                                            <th>Images</th>
                                            <th>Avg rev.</th>
                                            <th>Stock</th>
                                            <th>Health</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            @foreach ( $datas as $data )
                                            <td>{{$data->p_name}} </td>
                                            <td>{{$data->id}} </td>
                                            <td>{{$data->cat_name.' >> '.$data->sub_cat.' >> '.$data->sub_sub_cat}}</td>
                                            <td><a href="" class="btn btn-default">View Images</a></td>
                                            <td>No reviews</td>
                                            <td>{{$data->stock}}  </td>
                                            <td><span class="badge badge-{{$data->stock < 10 ? 'danger' : 'info' }} ">{{$data->stock < 10 ? 'Poor' : 'Good' }}  </span></td>
                                            <td>

                                                <form action="/admin/make_featured" method="post">
                                                    <a class="btn btn-xs btn-info" href="/admin/add_product_page/{{$data->id}}">+</a>
                                                    <a class="btn btn-success"  href="/admin/product_edit/{{$data->id}}"><i class="zmdi zmdi-edit"></i></a> 
                                                    <a class="btn btn-danger delete_btn" href="#" data-p_name={{$data->p_name}}  data-id="{{$data->id}}"  data-toggle="modal" data-target="#defaultModal"><i class="zmdi zmdi-delete"></i></a>
                                                    @csrf
                                                    <input value={{$data->id}} type="hidden" name="p_id">
                                                    <button class="btn btn-primary {{ $data->is_featured == 1 ? 'ti-arrow-down' : 'ti-arrow-up' }} " type="submit"></button>
                                                    
                                                </form>

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

<script>
    $(".delete_btn").click(function(){
        $spec_name = $(this).attr('data-p_name');
        $spec_id = $(this).attr('data-id');
        $(".spec_name").text($spec_name);
        $('.delete_field').val($spec_id);
    })

</script>
@endsection