@extends('layout')
@section('main_content')
                    <!--Hero Section-->
                    <div class="hero-section hero-background">
                        <h1 class="page-title">Cart</h1>
                    </div>
        
                    <div class="container sm-margin-top-37px">
                        <!--Cart Table-->
                        <div class="shopping-cart-container">
                            <div class="row">
                             
                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                    
                                    @if (session()->has('message'))
                                        <p class="alert alert-success">{{session('message')}}</p>                                
                                    @endif
                                    <h3 class="box-title">Your cart items</h3>
                                    <form class="shopping-cart-form" action="#" method="post">
                                        <table class="shop_table cart-form">
                                            <thead>
                                            <tr>
                                                <th class="product-name">Product Name</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                                <th>Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody class="cart_data">
                                                @foreach ($cartDatas as  $cartData)
                                                <tr class="cart_item">
                                                    <td class="product-thumbnail" data-title="Product Name">
                                                        <a class="prd-thumb" href="#">
                                                            <figure><img width="113" height="113" src="{{asset('')}}uploads/product_images/{{$cartData->image1}}" alt="shipping cart"></figure>
                                                        </a>
                                                        <a class="prd-name" href="#">{{$cartData->p_name}}</a>
                                                        <div class="action">
                                                            {{-- <a href="/edit_cart/{{$cartData->p_id}}" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> --}}
                                                        </div>
                                                    </td>
                                                    <td class="product-price" data-title="Price">
                                                        <div class="price price-contain">
                                                            <ins><span class="price-amount"><span class="currencySymbol">Tk </span>{{$cartData->recent_price}}</span></ins>
                                                            <del><span class="price-amount"><span class="currencySymbol">Tk </span>{{$cartData->before_price}}</span></del>
                                                        </div>
                                                    </td>
                                                    <td class="product-quantity" data-title="Quantity">
                                                        <span>{{$cartData->qty}}</span>
                                                    </td>
                                                    <td class="product-subtotal" data-title="Total">
                                                        <div class="price price-contain">
                                                            <ins><span class="price-amount"><span class="currencySymbol">Tk </span>{{$cartData->t_selling_price}}</span></ins>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="all_btns text-center">
                                                            <a style="width:20%"  type="button" class="btn btn-default btn-sm " onclick="remove_from_cart('{{$cartData->p_code}}')"><i class="fa fa-minus"></i></a>
                                                            <a style="width:20%"  type="button" class="btn btn-default btn-sm " onclick="add_to_cart('{{$cartData->p_code}}')"><i class="fa fa-plus"></i></a>
                                                            <a href="/delete_cart/{{$cartData->p_id}}" class="remove btn btn-default "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </form>

                                    <div class="text-center">
                                        <br>
                                        <br>
                                        <h2>Cart is empty !</h2>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <div class="shpcart-subtotal-block">
                                        <div class="subtotal-line">
                                            <b class="stt-name">Subtotal <span class="sub">( <span class="sub_no"> {{$carteds}}</span> )</span></b>
                                             <span class="stt-price">Tk {{$iprice}}</span>
                                        </div>
                                        <div class="subtotal-line">
                                            {{-- <b class="stt-name">Shipping</b>
                                            <span class="stt-price">£0.00</span> --}}
                                        </div>
                                        {{-- <div class="tax-fee">
                                            <p class="title">Est. Taxes & Fees</p>
                                            <p class="desc">Based on 56789</p>
                                        </div> --}}
                                        <div class="btn-checkout">
                                            <a href="/checkout" class="btn checkout">Check out</a>
                                        </div>
                                        <br>
                                        <h3 class="text-center">Or</h3>

                                        <div class="btn-checkout">
                                            <a href="/" class="btn checkout">Back to shop</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
        
                        <!--Related Product-->
                        {{-- <div class="product-related-box single-layout">
                            <div class="biolife-title-box lg-margin-bottom-26px-im">
                                <span class="biolife-icon icon-organic"></span>
                                <span class="subtitle">All the best item for You</span>
                                <h3 class="main-title">Related Products</h3>
                            </div>
                            <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>
                                <li class="product-item">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="{{asset('')}}front/images/products/p-13.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                            <div class="price ">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="{{asset('')}}front/images/products/p-14.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="{{asset('')}}front/images/products/p-15.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="{{asset('')}}front/images/products/p-10.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="{{asset('')}}front/images/products/p-08.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="{{asset('')}}front/images/products/p-21.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="product-item">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="{{asset('')}}front/images/products/p-18.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> --}}
        
                    </div>

@endsection



