@extends('layout')
@section('main_content')
<style>
    .paginate a{
        background: orange;
        color: white;
        padding: 5px 8px;
        margin-right: 10px;
    }
</style>
    <div class="container">
        <h1 class="text-center"> Search Results</h1>
        @if ($foundResult > 0 )
        <div class="main-content col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="product-category grid-style">
                <div class="row">
                    <ul class="products-list">
                        @foreach ($getResults as $getResult )
                        <li class="product-item col-lg-3 col-md-4 col-sm-4 col-xs-6">
                            <div class="contain-product layout-default">
                                <div class="product-thumb">
                                    <h4 style="font-weight:bold; color:orange;position:absolute"> {{$getResult->tag }} </h4>
                                    <a href="/single_product_view/{{$getResult->p_code}}" class="link-to-product">
                                        <img  src="{{asset('')}}uploads/product_images/{{$getResult->image1}}" alt="dd" width="270" height="270" class="product-thumnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <b class="categories">{{$getResult->cat_name }} </b>
                                    <h4 class="product-title"><a href="/single_product_view/{{$getResult->p_code}}" class="pr-name">{{$getResult->p_name }}</a></h4>
                                    <div class="price">
                                        <ins><span class="price-amount"><span class="currencySymbol">Tk</span>{{$getResult->before_price}}</span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">Tk</span>{{$getResult->recent_price}}</span></del>
                                    </div>
                                    <div class="slide-down-box">
                                        <div class="all_btns text-center">
                                            <a class="btn btn-default btn-sm "><i class="fa fa-bullseye"></i> {{$getResult->point}} </a>
                                            <a  href="/add_to_wish/{{$getResult->p_code}}" type="button" class="btn btn-default btn-sm  wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                            <a   type="button" class="btn btn-default btn-sm " onclick="add_to_cart_once('{{$getResult->p_code}}')">Add To Bag <i class="fa fa-shopping-bag"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="d-flex justify-content-center paginate text-center">
                    {!! $getResults->render() !!}
                </div>

            </div>

        </div>
            
        @else
                <div style="text-align: center;" style="margin:auto;">
                    <br>
                    <h1><strong>Sorry !! Product Not Found !</strong></h1>
                    <a href="#"><img style="max-width: 450px; width:100%;" class=" img-fliud" src="https://cliply.co/wp-content/uploads/2020/03/392001500_EYES_EMOJI_400px.gif" alt="" srcset="">
                    </a>
                    
                    
                </div>
        @endif
    </div>
@endsection