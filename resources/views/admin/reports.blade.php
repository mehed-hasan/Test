@extends('admin.layout')
@section('content');
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                                                @if (session()->has('message'))
                            
                                <p class="alert alert-success">
                                    {{ session('message') }}
                                </p>
                             @endif
                    <h2>Reports</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">

                <div class="col-lg-4 col-md-4 col-sm-6 col-6 text-center">
                    <div class="card">
                        <div class="body">                            
                            <p>Total Earned </p>
                            <h4>{{$bal }} Tk</h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-6 text-center">
                    <div class="card">
                        <div class="body">                            
                            <p>Todays Earned</p>
                            <h4>{{$todaySold }} Tk</h4>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-6 text-center">
                    <div class="card">
                        <div class="body">                            
                            <p>Last wothdrawn</p>
                            <h4>{{$lastWithdrawn }} </h4>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card product-report">
                        <div class="header">
                            <div class="container">
                                <h2 >Todays Analysis</h2>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon xl-amber m-b-15"><i class="zmdi zmdi-chart-donut"></i></div>
                                    <div class="col-in">
                                        <small class="text-muted mt-0"> Total Invested </small>
                                        <h4 class="mt-0">{{$todayInvested}}</h4>                                        
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon xl-blue m-b-15"><i class="zmdi zmdi-chart"></i></div>
                                    <div class="col-in">
                                        <small class="text-muted mt-0">Sold Of</small>
                                        <h4 class="mt-0">{{$todaySold}}</h4>                                        
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon xl-amber m-b-15"><i class="zmdi zmdi-chart-donut"></i></div>
                                    <div class="col-in">
                                        <small class="text-muted mt-0"> Sold Quantity </small>
                                        <h4 class="mt-0">{{$todaySoldQty}}</h4>                                        
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon xl-purple m-b-15"><i class="zmdi zmdi-card"></i></div>
                                    <div class="col-in">
                                        <small class="text-muted mt-0">Total Profit</small>
                                        <h4 class="mt-0">{{$todayProfit}}</h4>                                        
                                    </div>
                                </div>
                            </div>
                            <div id="area_chart"></div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card product-report">
                        <div class="header">
                            <div class="container">
                                <h2 >Last Day  Analysis</h2>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon xl-amber m-b-15"><i class="zmdi zmdi-chart-donut"></i></div>
                                    <div class="col-in">
                                        <small class="text-muted mt-0"> Total Invested </small>
                                        <h4 class="mt-0">{{$yesterdayInvested}}</h4>                                        
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon xl-blue m-b-15"><i class="zmdi zmdi-chart"></i></div>
                                    <div class="col-in">
                                        <small class="text-muted mt-0">Sold Of</small>
                                        <h4 class="mt-0">{{$yesterdaySold}}</h4>                                        
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon xl-amber m-b-15"><i class="zmdi zmdi-chart-donut"></i></div>
                                    <div class="col-in">
                                        <small class="text-muted mt-0"> Sold Quantity </small>
                                        <h4 class="mt-0">{{$yesterdaySoldQty}}</h4>                                        
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="icon xl-purple m-b-15"><i class="zmdi zmdi-card"></i></div>
                                    <div class="col-in">
                                        <small class="text-muted mt-0">Total Profit</small>
                                        <h4 class="mt-0">{{$yesterdayProfit}}</h4>                                        
                                    </div>
                                </div>
                            </div>
                            <div id="area_chart"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container">
                <div class="row clearfix">
                    Genarate Custom report
                    <div class="row">
                        <div class="col-md-4">
                            input
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

