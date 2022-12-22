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
                            <h2><strong>Add </strong> Methods</h2>
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

                            <form action="/admin/create_payment" method="POST">
                               @csrf
                                <div class="form-group form-float">
                                    <input type="text" placeholder="Mthods name"  minlength="5" maxlength="34"  type="text" class="form-control"  name="methods" >
                                </div>

                                <div class="form-group form-float">
                                    <input type="text" placeholder="No"  minlength="11" maxlength="12"  type="text" class="form-control" name="no" >
                                </div>

                                <input name="submit" class="btn btn-primary" type="submit" value="Add">
                            </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
@endsection

