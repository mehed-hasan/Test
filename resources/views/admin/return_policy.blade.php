@extends('admin.layout')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Write </strong> Return Policy</h2>

                            @if (count($errors) > 0)
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li >{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif

                            @if (session()->has('message'))
                                <p class="alert alert-success">{{session('message')}}</p>                                
                            @endif

                            @if (session()->has('error_message'))
                            <p class="alert alert-danger">{{session('error_message')}}</p>                                
                        @endif
                            
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form action="/admin/return_policy_update" enctype="multipart/form-data"  method="post">
                                @csrf


                                <label for="">Write Privacy Policy </label>
                                <div class="form-group form-float editor">
                                   <textarea placeholder="Write prodduct description here ..." class="form-control " name="text" id="" cols="15" rows="5">{{$text}}</textarea>
                                </div>

                                <button class="btn btn-raised btn-primary waves-effect" type="submit">Save  </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



@section('scripts')
<script src="{{asset('plugins/ckeditor/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('text')
</script>

@endsection