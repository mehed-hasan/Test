@extends('admin.layout')
@section('content');
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Dashboard</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">


            @if (session()->has('message'))
                            
            <p class="alert alert-success">
                {{ session('message') }}
            </p>
         @endif
         
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="card">
                        <div class="body">                            
                            <p>All products </p>
                            <h4>{{$allProducts }} </h4>
                        </div>
                    </div>
                </div>


    
                <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="card">
                        <div class="body">                            
                            <p>Active products </p>
                            <h4>{{$activeProducts }} </h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="card">
                        <div class="body">                            
                            <p>Inactive products</p>
                            <h4>{{$inactiveProducts }} </h4>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="card">
                        <div class="body">                            
                            <p>Featured Products</p>
                            <h4>{{$featuredProducts }} </h4>
                        </div>
                    </div>
                </div>

            </div>




            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Popular</strong> Products</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover theme-color c_table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>#SKU</th>
                                        <th>Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vpdatas as $vpdata)
                                    <tr>
                                        <td ><img class="w50" src="{{asset('')}}uploads/product_images/{{$vpdata->image1}}" alt=""></td>
                                        <td>{{$vpdata->sku}}</td>
                                        <td>{{$vpdata->viewed}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>              
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <h5> Recent Reviews </h5>
                        <div class="body">
                            <ul class="row list-unstyled c_review">
                                @foreach ($recentreviews as $recentreview )
                                <li class="col-12">
                                    <div class="avatar">
                                        {{-- <a href="javascript:void(0);"><img class="rounded" src="{{asset('images/sm/avatar2.jpg')}}" alt="user" width="60"></a> --}}
                                    </div>                                
                                    <div class="comment-action">
                                        <h6 class="c_name">{{$recentreview->user_name}}</h6>
                                        <p class="c_msg m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. </p>
                                        <div class="badge badge-info">Product Id {{$recentreview ->p_id}}</div>
                                        <span class="m-l-10">
                                            {{$recentreview->star}}<a href="javascript:void(0);"><i class="zmdi zmdi-star col-amber"></i></a>
                                        </span>
                                    </div>                                
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{asset('bundles/morrisscripts.bundle.js')}}"></script> <!-- Morris Plugin Js -->
<script src="{{asset('bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{asset('bundles/sparkline.bundle.js')}}"></script> <!-- Sparkline Plugin Js -->
<script src="{{asset('bundles/knob.bundle.js')}}  "></script> <!-- Jquery Knob Plugin Js -->
<script src="{{asset('js/pages/charts/chartjs.js')}}"></script>
<script src="{{asset('plugins/chartjs/Chart.bundle.js')}}"></script> <!-- Chart Plugins Js --> 
<script src="{{asset('js/pages/charts/jquery-knob.min.js') }}"></script>
@endsection

