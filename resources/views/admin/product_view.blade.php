@extends('admin.layout')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Product Detail</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-md-12">
                                    <div class="preview preview-pic tab-content">
                                        <div class="tab-pane active" id="product_1"><img src="{{asset('')}}images/ecommerce/1.png" class="img-fluid" alt="" /></div>
                                        <div class="tab-pane" id="product_2"><img src="{{asset('')}}images/ecommerce/2.png" class="img-fluid" alt=""/></div>
                                        <div class="tab-pane" id="product_3"><img src="{{asset('')}}images/ecommerce/3.png" class="img-fluid" alt=""/></div>
                                        <div class="tab-pane" id="product_4"><img src="{{asset('')}}images/ecommerce/4.png" class="img-fluid" alt=""/></div>
                                    </div>
                                    <ul class="preview thumbnail nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#product_1"><img src="{{asset('')}}images/ecommerce/1.png" alt=""/></a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#product_2"><img src="{{asset('')}}images/ecommerce/2.png" alt=""/></a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#product_3"><img src="{{asset('')}}images/ecommerce/3.png" alt=""/></a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#product_4"><img src="{{asset('')}}images/ecommerce/4.png" alt=""/></a></li>                                    
                                    </ul>                
                                </div>
                                <div class="col-xl-9 col-lg-8 col-md-12">
                                    <div class="product details">
                                        <h3 class="product-title mb-0">Simple Black Clock</h3>
                                        <h5 class="price mt-0">Current Price: <span class="col-amber">$180</span></h5>
                                        <div class="rating">
                                            <div class="stars">
                                                <span class="zmdi zmdi-star col-amber"></span>
                                                <span class="zmdi zmdi-star col-amber"></span>
                                                <span class="zmdi zmdi-star col-amber"></span>
                                                <span class="zmdi zmdi-star col-amber"></span>
                                                <span class="zmdi zmdi-star-outline"></span>
                                            </div>
                                            <span class="m-l-10">41 reviews</span>
                                        </div>
                                        <hr>
                                        <p class="product-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        <p class="vote"><strong>78%</strong> of buyers enjoyed this product! <strong>(23 votes)</strong></p>
                                        <h5 class="sizes">Sizes:
                                            <span class="size" title="small">s</span>
                                            <span class="size" title="medium">m</span>
                                            <span class="size" title="large">l</span>
                                            <span class="size" title="xtra large">xl</span>
                                        </h5>
                                        <h5 class="colors">colors:
                                            <span class="color bg-amber not-available"  title="Not In store"></span>
                                            <span class="color bg-green"></span>
                                            <span class="color bg-blue"></span>
                                        </h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
