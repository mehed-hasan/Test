@extends('layout')

@section('main_content')
<div class="axil-main-slider-area main-slider-style-2">
    <div class="container">
        <div class="slider-offset-left">
            <div class="row row--20">
                <div class="col-lg-9">
                    <div class="slider-box-wrap">
                        <div class="slider-activation-one axil-slick-dots">
                            <div class="single-slide slick-slide">
                                <div class="main-slider-content">
                                    <span class="subtitle"><i class="fal fa-watch"></i> Smartwatch</span>
                                    <h1 class="title">Bloosom Smat Watch</h1>
                                    <div class="shop-btn">
                                        <a href="shop.html" class="axil-btn">Shop Now <i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="main-slider-thumb">
                                    <img src="{{asset('front/images/product/product-40.png')}}" alt="Product">
                                </div>
                            </div>
                            <div class="single-slide slick-slide">
                                <div class="main-slider-content">
                                    <span class="subtitle"><i class="fal fa-watch"></i> Smartwatch</span>
                                    <h1 class="title">Delux Brand Watch</h1>
                                    <div class="shop-btn">
                                        <a href="shop.html" class="axil-btn">Shop Now <i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="main-slider-thumb">
                                    <img src="{{asset('front/images/product/product-46.png')}}" alt="Product">
                                </div>
                            </div>
                            <div class="single-slide slick-slide">
                                <div class="main-slider-content">
                                    <span class="subtitle"><i class="fal fa-watch"></i> Smartwatch</span>
                                    <h1 class="title">Bloosom Smat Watch</h1>
                                    <div class="shop-btn">
                                        <a href="shop.html" class="axil-btn">Shop Now <i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="main-slider-thumb">
                                    <img src="{{asset('front/images/product/product-40.png')}}" alt="Product">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="slider-product-box">
                        <div class="product-thumb">
                            <a href="single-product.html">
                                <img src="{{asset('front/images/product/product-41.png')}}" alt="Product">
                            </a>
                        </div>
                        <h6 class="title"><a href="single-product.html">Yantiti Leather Bags</a></h6>
                        <span class="price">$29.99</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('front_partials.service_area')
@include('front_partials.new_arrivals')
@include('front_partials.best_seller')
@include('front_partials.offer');
@include('front_partials.all_products')


@include('front_partials.searchmodal')
@include('front_partials.viewmodal')
@endsection


@section('scripts')


<script>

    var ENDPOINT = "{{ url('/') }}";
    var page = 3;
      
    infinteLoadMore(page);

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() +200 >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "/products?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
            .done(function (response) {
                if (response.length == 0) {
                    $('.auto-load').html("");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper").append(response);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }



</script>


@endsection