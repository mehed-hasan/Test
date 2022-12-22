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
                            <h2><strong>Withdraw </strong> Balance</h2>
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

                            <form action="/admin/withdraw" method="POST">
                               @csrf
                                <div class="form-group form-float">
                                    <input required maxlength="255"  type="number" class="form-control" placeholder="Withdraw Amount " name="amount" >
                                </div>

                                
                                <br>
                                <input name="submit" class="btn btn-primary" type="submit" value="Withdraw">
                            </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
@endsection
