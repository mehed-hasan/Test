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
                unit " <span class="spec_name"> </span> " will be delete and it will never overcome.
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.unit_delete')}}" method="POST">
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
                            <h2><strong>unit</strong> Lists </h2>
                        </div>
                        <div class="body">
                            @if (session()->has('message'))
                                <p class="alert alert-success"> {{session('message')}}</p>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>unit Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
       
                                    <tbody>
                                        @foreach ($datas as $data )
                                        <tr>
                                            <td>{{$data->unit_name}}</td>
                                            <td><a href="#" data-unit_name={{$data->unit_name}}  data-id="{{$data->id}}" class="delete_btn btn btn-danger" data-toggle="modal" data-target="#defaultModal">
                                                Delete
                                            </a></td>
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


{{-- Deleting script --}}

<script>
    $(".delete_btn").click(function(){
        $spec_name = $(this).attr('data-unit_name');
        $spec_id = $(this).attr('data-id');
        $(".spec_name").text($spec_name);
        $('.delete_field').val($spec_id);
    })

</script>
@endsection