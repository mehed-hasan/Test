@extends('admin.layout')

@section('head')
<link rel="stylesheet" href="{{asset('plugins/jquery-adatatable/adataTables.bootstrap4.min.css')}}">
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
                Admin " <span class="spec_name"> </span> " will be delete and it will never overcome.
            </div>
            <div class="modal-footer">
                <form action="{{route('admin.admin_delete')}}" method="POST">
                    @csrf
                    <input class="delete_field"  value="" type="hidden" name="delete_id">
                    <button type="submit" name="delete" class="btn btn-default btn-round waves-effect">YES DELETE</button>
                </form>
                
                <button type="button" class="btn btn-danger waves-effect" adata-dismiss="modal">NO</button>
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
                            <h2><strong>Admin</strong> Lists </h2>
                        </div>
                        <div class="body">

                            @if (session()->has('message'))
                                <p class="alert alert-success">{{session('message')}}</p>                                
                            @endif

                        @if (session()->has('error_message'))
                            <p class="alert alert-success">{{session('error_message')}}</p>                                
                        @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover adataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Admin Email</th>
                                            <th>Pass</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($adatas as $adata )

                                        <tr>
                                            <td>{{$adata->email}} </td>
                                            <td>{{$adata->password}}</td>
                                            <td><a href="#" data-id="{{$adata->id}}" class="delete_btn btn btn-danger" data-toggle="modal" data-target="#defaultModal">
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

<!-- Jquery adataTable Plugin Js --> 
<script src="{{asset('bundles/adatatablescripts.bundle.js')}}"></script>
<script src="{{asset('plugins/jquery-adatatable/buttons/adataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/jquery-adatatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jquery-adatatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('plugins/jquery-adatatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('plugins/jquery-adatatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/jquery-adatatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('js/pages/tables/jquery-adatatable.js')}}"></script>

{{-- Deleting script --}}

<script>
    $(".delete_btn").click(function(){
        $spec_name = $(this).attr('data-email');
        $spec_id = $(this).attr('data-id');
        $(".spec_name").text($spec_name);
        $('.delete_field').val($spec_id);
    })

</script>
@endsection