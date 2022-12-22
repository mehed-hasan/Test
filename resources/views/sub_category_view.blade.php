@extends('layout')
        <!--Hero Section-->
@section('main_content')
<div class="hero-section hero-background">
    <input class="subcat_name" value="{{$subCatDatas->sub_cat}} " type="hidden" name="">
    <h1 class="page-title">Category >> {{$subCatDatas->cat_name}} >> {{$subCatDatas->sub_cat}} </h1></div>

<div class="container sm-margin-top-37px">
    <div class="row">
       <aside id="sidebar" class="sidebar col-lg-3 col-md-4 col-sm-12 col-xs-12">
          <div class="biolife-mobile-panels">
             <span class="biolife-current-panel-title">Sidebar</span>
             <a class="biolife-close-btn" href="#" data-object="open-mobile-filter">×</a>
          </div>
          <div class="sidebar-contain">
             <div class="widget biolife-filter">
                <h4 class="wgt-title">Filter By  Category</h4>
                <div class="wgt-content">
                    <ul class="cat-list">
                        @foreach ($allCats as $allCat )
                        <li class="cat-list-item"><a href="/sub_sub_category_view/{{$allCat->id}}/{{$allCat->sub_sub_cat}}" class="cat-link"> {{$allCat->sub_sub_cat}} </a></li>
                        @endforeach
                     </ul>
                </div>
             </div>
             <div class="widget price-filter biolife-filter">
                <h4 class="wgt-title">Price</h4>
                <div class="wgt-content">
                   <div class="frm-contain">
                      <form action="#" name="price-filter" id="price-filter" method="get">
                         <p class="f-item">
                            <label for="pr-from">Tk </label>
                            <input class="input-number given_price1" type="number" id="pr-from" value="" name="price-from">
                         </p>
                         <p class="f-item">
                            <label for="pr-to">to Tk</label>
                            <input class="input-number given_price2" type="number" id="pr-to" value="" name="price-from">
                         </p>
                         <p class="f-item"><button class="btn-submit price" type="button">go</button></p>
                      </form>
                   </div>
                   {{-- 
                   <ul class="check-list bold single">
                      <li class="check-list-item"><a href="#" class="check-link">$0 - $5</a></li>
                      <li class="check-list-item"><a href="#" class="check-link">$5 - $10</a></li>
                      <li class="check-list-item"><a href="#" class="check-link">$15 - $20</a></li>
                   </ul>
                   --}}
                </div>
             </div>
             <div class="widget biolife-filter">
                <h4 class="wgt-title">Brand</h4>
                <div class="wgt-content">
                   <ul class="check-list multiple">
                      @foreach ($fBrands as $fBrand)
                      <li class="check-list-item "><input class="brand" value="{{$fBrand->brand}}" type="checkbox" name="" id=""> {{$fBrand->brand}}</li>
                      @endforeach
                   </ul>
                </div>
             </div>
             <div class="widget biolife-filter">
                <h4 class="wgt-title">Color</h4>
                <div class="wgt-content">
                   <ul class="color-list">
                      @foreach ($fColors as $fColor )
                      <li class="color-item "><input class="color"  value="{{$fColor->color}}" type="checkbox" name="" id=""> {{$fColor->color}}</li>
                      @endforeach
                   </ul>
                </div>
             </div>
             <div class="widget biolife-filter">
                <h4 class="wgt-title"> Size</h4>
                <div class="wgt-content">
                   <ul class="check-list bold multiple">
                      @foreach ($fSizes as $fSize)
                      <li><input class="size" value="{{$fSize->size}}" type="checkbox" name="" id=""> {{$fSize->size}}</li>
                      @endforeach
                   </ul>
                </div>
             </div>
             {{-- <div class="widget biolife-filter">
                <h4 class="wgt-title">Recently Viewed</h4>
                <div class="wgt-content">
                   <ul class="products">
                      <li class="pr-item">
                         <div class="contain-product style-widget">
                            <div class="product-thumb">
                               <a href="#" class="link-to-product" tabindex="0">
                               <img src="{{asset('')}}front/images/products/p-13.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                               </a>
                            </div>
                            <div class="info">
                               <b class="categories">Fresh Fruit</b>
                               <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                               <div class="price">
                                  <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                  <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                               </div>
                            </div>
                         </div>
                      </li>
                      <li class="pr-item">
                         <div class="contain-product style-widget">
                            <div class="product-thumb">
                               <a href="#" class="link-to-product" tabindex="0">
                               <img src="{{asset('')}}front/images/products/p-14.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                               </a>
                            </div>
                            <div class="info">
                               <b class="categories">Fresh Fruit</b>
                               <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                               <div class="price">
                                  <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                  <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                               </div>
                            </div>
                         </div>
                      </li>
                      <li class="pr-item">
                         <div class="contain-product style-widget">
                            <div class="product-thumb">
                               <a href="#" class="link-to-product" tabindex="0">
                               <img src="{{asset('')}}front/images/products/p-10.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                               </a>
                            </div>
                            <div class="info">
                               <b class="categories">Fresh Fruit</b>
                               <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                               <div class="price">
                                  <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                  <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                               </div>
                            </div>
                         </div>
                      </li>
                   </ul>
                </div>
             </div> --}}
          </div>
       </aside>
       <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
          <div class="product-category grid-style ">
             <div class="row">
                <ul class="products-list">
                   @foreach ($allProducts as $allProduct )
                   <li class="product-item col-lg-3 col-md-4 col-sm-4 col-xs-6 queried">
                      <div class="contain-product layout-default">
                         <div class="product-thumb">
                           <h4 style="font-weight:bold; color:orange;position:absolute"> {{$allProduct->tag }} </h4>

                            <a href="/single_product_view/{{$allProduct->p_code}}" class="link-to-product">
                            <img src="{{asset('')}}uploads/product_images/{{$allProduct->image1}}" alt="dd" width="270" height="270" class="product-thumnail">
                            </a>
                         </div>
                         <div class="info">
                            <b class="categories">{{$allProduct->cat_name }}  </b>
                            <h4 class="product-title"><a href="/single_product_view/{{$allProduct->p_code}}" class="pr-name">{{$allProduct->p_name }}</a></h4>
                            <div class="price">
                               <ins><span class="price-amount"><span class="currencySymbol">Tk</span>{{$allProduct->before_price}}</span></ins>
                               <del><span class="price-amount"><span class="currencySymbol">Tk</span>{{$allProduct->recent_price}}</span></del>
                            </div>
                            <div class="slide-down-box">
                              <div class="all_btns text-center">
                                 <a class="btn btn-default btn-sm "><i class="fa fa-bullseye"></i> {{$allProduct->point}} </a>
                                  <a  href="/add_to_wish/{{$allProduct->p_code}}" type="button" class="btn btn-default btn-sm  wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                  <a   type="button" class="btn btn-default btn-sm " onclick="add_to_cart_once('{{$allProduct->p_code}}')">Add To Bag <i class="fa fa-shopping-bag"></i></a>
                              </div>
                          </div>
                         </div>
                      </div>
                   </li>
                   @endforeach
                   <div id="data-wrapper">
                      <!-- Results -->
                   </div>
                   <!-- Data Loader -->
                   <div class="auto-load text-center">
                      <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                         <path fill="#000"
                            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                               from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                         </path>
                      </svg>
                   </div>
                </ul>
             </div>
 
 
             <div  class="load_btn text-center">
                 <br><br>
                 <button class="btn btn-warning  load">Load More</button>
             </div>
 
 
       </div>
    </div>
 </div>
@endsection


@section('scripts')
@section('scripts')
<script>

//Initializing   ------------------------------------------

var ENDPOINT = "{{ url('/') }}";
var page = 0;
var subcat_name = $(".subcat_name").val();
$('.auto-load').hide();
$(".load_btn_filter").hide();
$(".load_btn").show();

// -----------------------------



// Sidebar filster has been started -------------------------------------
$brands =[];
$colors=[];
$sizes =[];
$brandMax =0;
$colorMax=0;
$sizeMax=0;   

$(".brand").each(function () {
    $brands.push($(this).val());
    $brandMax +=1;
});



$(".color").each(function () {
    $colors.push($(this).val());
    $colorMax+=1;
});

$(".size").each(function () {
    $sizes.push($(this).val());
    $sizeMax+=1;
});

// Set default values --------------------



// Taking data from check boxes using push pull ----------------------------
$(".brand").click(function () {
            if($(this).is(":checked")) {
                    if($brands.length == $brandMax ){
                        while ($brands.length) { 
                        $brands.pop(); 
                        }
                    }
                    $brandData = $(this).val();
                    $brands.push($brandData);
            }else{
                $popper_index = $brands.indexOf($(this).val());
                $brands.splice($popper_index, 1); 
                
                //If array is empty then get all default values --
                if($brands.length == 0){
                    $(".brand").each(function () {
                        $brands.push($(this).val());
                    });
                }
            }
});


$(".size").click(function () {
        if ($(this).is(":checked")) {

            if($sizes.length == $sizeMax ){
                while ($sizes.length) { 
                $sizes.pop(); 
                 }
            }
                    $sizeData = $(this).val();
                    $sizes.push($sizeData);
            }else{
                $popper_index = $sizes.indexOf($(this).val());
                $sizes.splice($popper_index, 1); 
                if($sizes.length == 0){
                    $(".size").each(function () {
                        $sizes.push($(this).val());
                    });
                }
            }

});

$(".color").click(function(){


            if ($(this).is(":checked")) {
                     if($colors.length == $colorMax){
                        while ($colors.length) { 
                        $colors.pop(); 
                        }
                    }
                    $colorData = $(this).val();
                    $colors.push($colorData);
            }else{
                $popper_index = $colors.indexOf($(this).val());
                $colors.splice($popper_index, 1); 

                if($colors.length == 0){
                    $(".color").each(function () {
                        $colors.push($(this).val());
                    });
                }
                
            }
});
// Taking data from check boxes using push pull ----------------------------




// Gathering all  data to pass ------------------------- 
$(".load, .price, .brand, .color, .size").click(function(){
    $given_price1 = $(".given_price1").val();
    $given_price2 = $(".given_price2").val();

    if($given_price1 == ''){
        $given_price1 = 0;
    }
    if($given_price2 == ''){
        $given_price2 = 1000000;
    }
    
    if($(this).text() == 'Load More'){
        page++;
    }else{
        page =0;
    }
    
    infinteLoadMore(subcat_name, page,$given_price1, $given_price2, $colors, $sizes, $brands); //passing 
});



// Sending All daata to controller via ajax ------------------------------------------------------

function infinteLoadMore(subcat_name, page,$given_price1, $given_price2, $colors, $sizes, $brands) {
    $.ajax({
            url: ENDPOINT+"/subcat_load?page=" + page,
            datatype: "html",
            type: "get",
            data: {
                subcat_name: subcat_name, 
                given_price1: $given_price1,
                given_price2:$given_price2,
                colors : $colors,
                sizes : $sizes,
                brands: $brands
             },
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
            $('.queried').hide();
            $("#data-wrapper").empty();
            $("#data-wrapper").append(response);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
}


// ******************** Ended ***************************

</script>
@endsection





