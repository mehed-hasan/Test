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
                            <h2><strong>Create </strong> Admin</h2>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                     
                            @if (count($errors) > 0)
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li >{{ $error }}</li>
                                        @endforeach
                                    </ul>
                            @endif

                            @if (session()->has('message'))
                            
                                <p class="alert alert-success">
                                    {{ session('message') }}
                                </p>
                             @endif

                            <form action="/admin/create_admin" enctype="multipart/form-data" method="POST">
                               @csrf
                                <div class="form-group form-float">
                                    <input type="email" placeholder="Name "   class="form-control"  name="email" >
                                </div>
                                <div class="form-group form-float">
                                    <input Type="pass" placeholder="Password "  minlength="8" maxlength="100"  type="text" class="form-control"   name="pass" >
                                </div>
      

                                <input name="submit" class="btn btn-primary" type="submit" value="Create New Banner">
                            </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
@endsection
