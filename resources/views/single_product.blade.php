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
                            <!-- summary info -->
                            <div class="sumary-product single-layout">
                                <div class="media">
                                    <ul class="biolife-carousel slider-for" data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".slider-nav"}'>
                                        <li><img src="{{ $image1 == 'null' ? 'https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg' : asset('uploads/product_images/'.$image1) }}" alt="" width="500" height="500"></li>
                                        <li><img src="{{ $image2 == 'null' ? 'https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg' : asset('uploads/product_images/'.$image2) }}" alt="" width="500" height="500"></li>
                                        <li><img src="{{ $image3 == 'null' ? 'https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg' : asset('uploads/product_images/'.$image3) }}" alt="" width="500" height="500"></li>
                                        <li><img src="{{ $image4 == 'null' ? 'https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg' : asset('uploads/product_images/'.$image4) }}" alt="" width="500" height="500"></li>
                                    </ul>
                                    <ul class="biolife-carousel slider-nav" data-slick='{"arrows":false,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":4,"slidesToScroll":1,"asNavFor":".slider-for"}'>
                                        <li><img src="{{ $image1 == 'null' ? 'https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg' : asset('uploads/product_images/'.$image1) }}" alt="" width="88" height="88"></li>
                                        <li><img src="{{ $image2 == 'null' ? 'https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg' : asset('uploads/product_images/'.$image2) }}" alt="" width="88" height="88"></li>
                                        <li><img src="{{ $image3 == 'null' ? 'https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg' : asset('uploads/product_images/'.$image3) }}" alt="" width="88" height="88"></li>
                                        <li><img src="{{ $image4 == 'null' ? 'https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg' : asset('uploads/product_images/'.$image4) }}" alt="" width="88" height="88"></li>
                                    </ul>
                                </div>
                                <form action="/add_to_cart" method="post">
                                    @csrf
                                    <div class="product-attribute">
                                        <input value="{{$pDetails->id}}" type="hidden" name="p_id">
                                        <h3 class="title">{{$pDetails->p_name }}</h3>
                                        <div class="rating">
                                            <p class="star-rating"><span class="width-{{$avgreview * 20}}percent"></span></p>
                                            <span class="review-count">({{$treview}}  Reviews)</span>
                                        </div>
                                        <span class="sku">Sku: #{{$pDetails->sku}}</span>
                                        <p>Points : {{$pDetails->point}}</p>
                                        <p class="excerpt">{{$pDetails->short_desc}}</p>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">Tk</span>{{$pDetails->recent_price}}</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">Tk</span>{{$pDetails->before_price}}</span></del>
                                        </div>
                                        @if ($pDetails->color == 'null')
                                            
                                        @else
                                        <div class="product-atts">
                                            <div class="atts-item">
                                                <span class="title">Color:</span>
                                                <ul class="color-list">
                                                    <input value={{$pDetails->color}} type="hidden" name="color" id="">
                                                    <li class="color-item"><a href="#" class="c-link"><span style="background-color:{{$pDetails->color}}" class="symbol hex-code"></span>{{$pDetails->color}}</a></li>
                                                    {{-- <li class="color-item"><a href="#" class="c-link"><span class="symbol hex-code color-02"></span>Orrange</a></li>
                                                    <li class="color-item"><a href="#" class="c-link"><span class="symbol hex-code color-03"></span>Other</a></li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="shipping-info">
                                            <p class="shipping-day">{{$pDetails->shiping_day}}-Day Shipping</p>
                                            {{-- <p class="for-today">Pree Pickup Today</p> --}}
                                        </div>
                                    </div>

                                    <div class="action-form">
                                        {{-- <div class="quantity-box">
                                            <span class="title">Quantity:</span>
                                            <div class="qty-input">
                                                <input class="quantity" type="text" name="qty" value="1" data-max_value="{{$pDetails->stock}}" data-min_value="1" data-step="1">
                                                <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                                <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                            </div>
                                        </div> --}}
                                        <div class="total-price-contain">
                                            <span class="title">Product Price:</span>

                                            <input class="tbp" type="hidden" name="t_buying_price" value="{{$pDetails->buying_price}}">
                                            <input class="buying_price" type="hidden"  value="{{$pDetails->buying_price}}">

                                            <input class="dtv" type="hidden" name="t_selling_price" value="{{$pDetails->recent_price}}">
                                            <input class="selling_price" type="hidden"  value="{{$pDetails->recent_price}}">

                                            <p class="price ">Tk <span class="dt">{{$pDetails->recent_price}}</span> </p>
                                        </div>
                                        <div class="buttons">
                                            <a onclick="add_to_cart_once('{{$pDetails->id}}')"class="btn btn-warning form-control" href="#"> Add To Cart </a>
                                        </div>

                                        {{-- <div class="social-media">
                                            <ul class="social-list">
                                                <li><a href="#" class="social-link"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                <li><a href="#" class="social-link"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                <li><a href="#" class="social-link"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                                <li><a href="#" class="social-link"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                                <li><a href="#" class="social-link"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div> --}}
                                        {{-- <div class="acepted-payment-methods">
                                            <ul class="payment-methods">
                                                <li><img src="{{asset('')}}front/images/card1.jpg" alt="" width="51" height="36"></li>
                                                <li><img src="{{asset('')}}front/images/card2.jpg" alt="" width="51" height="36"></li>
                                                <li><img src="{{asset('')}}front/images/card3.jpg" alt="" width="51" height="36"></li>
                                                <li><img src="{{asset('')}}front/images/card4.jpg" alt="" width="51" height="36"></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="action-form">
                                        <div class="quantity-box">
                                            <span class="title">Quantity:</span>
                                            <div class="qty-input">
                                                <input class="quantity" type="text" name="qty" value="1" data-max_value="{{$pDetails->stock}}" data-min_value="1" data-step="1">
                                                <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                                <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="total-price-contain">
                                            <span class="title">Total Price:</span>

                                            <input class="buying_price" type="hidden"  value="{{$pDetails->recent_price}}">
                                            <input class="selling_price" type="hidden"  value="{{$pDetails->recent_price}}">

                                            <p class="price ">Tk <span class="dt">{{$pDetails->recent_price}}</span> </p>
                                        </div>
                                        <div class="buttons">
                                            <input class="btn btn-warning form-control" type="submit" value="Add to cart">
                                        </div>

                                        <div class="social-media">
                                            <ul class="social-list">
                                                <li><a href="#" class="social-link"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                <li><a href="#" class="social-link"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                <li><a href="#" class="social-link"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                                <li><a href="#" class="social-link"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                                <li><a href="#" class="social-link"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                        {{-- <div class="acepted-payment-methods">
                                            <ul class="payment-methods">
                                                <li><img src="{{asset('')}}front/images/card1.jpg" alt="" width="51" height="36"></li>
                                                <li><img src="{{asset('')}}front/images/card2.jpg" alt="" width="51" height="36"></li>
                                                <li><img src="{{asset('')}}front/images/card3.jpg" alt="" width="51" height="36"></li>
                                                <li><img src="{{asset('')}}front/images/card4.jpg" alt="" width="51" height="36"></li>
                                            </ul>
                                        </div> --}}
                                    {{-- </div>  --}}
                                </form>
                            </div>
            
                            <!-- Tab info -->
                            <div class="product-tabs single-layout biolife-tab-contain">
                                <div class="tab-head">
                                    <ul class="tabs">
                                        <li class="tab-element active"><a href="#tab_1st" class="tab-link">Products Descriptions</a></li>
                                        <li class="tab-element" ><a href="#tab_2nd" class="tab-link">Addtional information</a></li>
                                        {{-- <li class="tab-element" ><a href="#tab_3rd" class="tab-link">Shipping & Delivery</a></li> --}}
                                        <li class="tab-element" ><a href="#tab_4th" class="tab-link">Customer Reviews <sup>( {{$treview}} )</sup></a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div id="tab_1st" class="tab-contain desc-tab active">
                                        <div class="desc-expand">
                                            <span class="title">{{$pDetails->p_name}}</span><br> <br>
                                            {!! $pDetails->long_desc !!}
                                        </div>
                                    </div>
                                    <div id="tab_2nd" class="tab-contain addtional-info-tab">
                                        <table class="tbl_attributes">
                                            <tbody>
                                            <tr>
                                                <th>Color</th>
                                                <td><p> {{$pDetails->color =='null' ? '----' : $pDetails->color  }} </p></td>
                                            </tr>
                                            <tr>
                                                <th>Size</th>
                                                <td><p>{{$pDetails->size =='null' ? '----' : $pDetails->size  }} </p></td>
                                            </tr>
                                            <tr>
                                                <th>Brand</th>
                                                <td><p>{{$pDetails->brand =='null' ? '----' : $pDetails->brand  }} </p></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="tab_3rd" class="tab-contain shipping-delivery-tab">
                                        <div class="accodition-tab biolife-accodition">
                                            <ul class="tabs">
                                                <li class="tab-item">
                                                    <span class="title btn-expand">How long will it take to receive my order?</span>
                                                    <div class="content">
                                                        <p>Orders placed before 3pm eastern time will normally be processed and shipped by the following business day. For orders received after 3pm, they will generally be processed and shipped on the second business day. For example if you place your order after 3pm on Monday the order will ship on Wednesday. Business days do not include Saturday and Sunday and all Holidays. Please allow additional processing time if you order is placed on a weekend or holiday. Once an order is processed, speed of delivery will be determined as follows based on the shipping mode selected:</p>
                                                        <div class="desc-expand">
                                                            <span class="title">Shipping mode</span>
                                                            <ul class="list">
                                                                <li>Standard (in transit 3-5 business days)</li>
                                                                <li>Priority (in transit 2-3 business days)</li>
                                                                <li>Express (in transit 1-2 business days)</li>
                                                                <li>Gift Card Orders are shipped via USPS First Class Mail. First Class mail will be delivered within 8 business days</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="tab-item">
                                                    <span class="title btn-expand">How is the shipping cost calculated?</span>
                                                    <div class="content">
                                                        <p>You will pay a shipping rate based on the weight and size of the order. Large or heavy items may include an oversized handling fee. Total shipping fees are shown in your shopping cart. Please refer to the following shipping table:</p>
                                                        <p>Note: Shipping weight calculated in cart may differ from weights listed on product pages due to size and actual weight of the item.</p>
                                                    </div>
                                                </li>
                                                <li class="tab-item">
                                                    <span class="title btn-expand">Why Didn’t My Order Qualify for FREE shipping?</span>
                                                    <div class="content">
                                                        <p>We do not deliver to P.O. boxes or military (APO, FPO, PSC) boxes. We deliver to all 50 states plus Puerto Rico. Certain items may be excluded for delivery to Puerto Rico. This will be indicated on the product page.</p>
                                                    </div>
                                                </li>
                                                <li class="tab-item">
                                                    <span class="title btn-expand">Shipping Restrictions?</span>
                                                    <div class="content">
                                                        <p>We do not deliver to P.O. boxes or military (APO, FPO, PSC) boxes. We deliver to all 50 states plus Puerto Rico. Certain items may be excluded for delivery to Puerto Rico. This will be indicated on the product page.</p>
                                                    </div>
                                                </li>
                                                <li class="tab-item">
                                                    <span class="title btn-expand">Undeliverable Packages?</span>
                                                    <div class="content">
                                                        <p>Occasionally packages are returned to us as undeliverable by the carrier. When the carrier returns an undeliverable package to us, we will cancel the order and refund the purchase price less the shipping charges. Here are a few reasons packages may be returned to us as undeliverable:</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="tab_4th" class="tab-contain review-tab">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                                    <div class="rating-info">
                                                        <p class="index"><strong class="rating">{{$avgreview}}</strong>out of 5</p>
                                                        <div class="rating"><p class="star-rating"><span class="width-{{$avgreview * 20}}percent"></span></p></div>
                                                        <p class="see-all">See all reviews</p>
                                                        <ul class="options">
                                                            <li>
                                                                <div class="detail-for">
                                                                    <span class="option-name">5stars</span>
                                                                    <span class="progres">
                                                                        <span class="line-100percent"><span class="percent width-{{$fivestars}}percent"></span></span>
                                                                    </span>
                                                                    <span class="number">{{$fivestars}}</span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail-for">
                                                                    <span class="option-name">4stars</span>
                                                                    <span class="progres">
                                                                        <span class="line-100percent"><span class="percent width-{{$fourestars}}percent"></span></span>
                                                                    </span>
                                                                    <span class="number">{{$fourestars}}</span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail-for">
                                                                    <span class="option-name">3stars</span>
                                                                    <span class="progres">
                                                                        <span class="line-100percent"><span class="percent width-{{$threestars}}percent"></span></span>
                                                                    </span>
                                                                    <span class="number">{{$threestars}}</span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail-for">
                                                                    <span class="option-name">2stars</span>
                                                                    <span class="progres">
                                                                        <span class="line-100percent"><span class="percent width-{{$twostars}}percent"></span></span>
                                                                    </span>
                                                                    <span class="number">{{$twostars}}</span>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail-for">
                                                                    <span class="option-name">1star</span>
                                                                    <span class="progres">
                                                                        <span class="line-100percent"><span class="percent width-{{$onestars}}percent"></span></span>
                                                                    </span>
                                                                    <span class="number">{{$onestars}}</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                                    @if ($reviewd == 1 )
                                                    <div class="review-form-wrapper">
                                                        <span class="title">Submit your review</span>
                                                        <form action="/review" name="frm-review" method="post">
                                                            @csrf
                                                            <div class="comment-form-rating">
                                                                <label>1. Your rating of this products:</label>
                                                                <p class="stars">
                                                                    <input value="{{$pDetails->id}}" type="hidden" name="p_id">
                                                                    <input  value="{{Auth::user()->name}}" type="hidden" name="user">
                                                                    <input class="star" value="" type="hidden" name="star">
                                                                    <span>
                                                                        <a class="btn-rating" data-value="1" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                                        <a class="btn-rating" data-value="2" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                                        <a class="btn-rating" data-value="3" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                                        <a class="btn-rating" data-value="4" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                                        <a class="btn-rating" data-value="5" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                                    </span>
                                                                </p>
                                                            </div>
 
                                                            <p class="form-row">
                                                                <textarea name="comment" id="txt-comment" cols="30" rows="10" placeholder="Write your review here..."></textarea>
                                                            </p>
                                                            <p class="form-row">
                                                                <button type="submit" name="submit">submit review</button>
                                                            </p>
                                                        </form>
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>
                                            <div id="comments">
                                                <ol class="commentlist">
                                                    @foreach ($reviews as $review)
                                                    <li class="review">
                                                        <div class="comment-container">
                                                            <div class="row">
                                                                <div class="comment-content col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <p class="comment-in"><span class="post-name">{{$review->user_name}}</span>
                                                                        {{-- <span class="post-date">01/04/2018</span> --}}
                                                                    </p>
                                                                    <div class="rating"><p class="star-rating"><span class="width-{{$review->star * 20}}percent"></span></p></div>
                                                                    <p class="comment-text">
                                                                        {{$review->comment}}
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ol>
                                                {{-- <div class="biolife-panigations-block version-2">
                                                    <ul class="panigation-contain">

                                                        <li><span class="current-page">1</span></li>
                                                        <li><a href="#" class="link-page">2</a></li>
                                                        <li><a href="#" class="link-page">3</a></li>
                                                        <li><span class="sep">....</span></li>
                                                        <li><a href="#" class="link-page">20</a></li>
                                                        <li><a href="#" class="link-page next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                    <div class="result-count">
                                                        <p class="txt-count"><b>1-5</b> of <b>126</b> reviews</p>
                                                        <a href="#" class="link-to">See all<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                                    </div>
                                                </div> --}}
                                                <div class="d-flex justify-content-center paginate">
                                                    {!! $reviews->links() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <!-- related products -->
                            <div class="product-related-box single-layout">
                                <div class="biolife-title-box lg-margin-bottom-26px-im">
                                    {{-- <span class="biolife-icon icon-organic"></span>
                                    <span class="subtitle">All the best item for You</span> --}}
                                    <h3 class="main-title">Related Products</h3>
                                </div>
                                <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>
                                    @foreach ($relatedProducts as $relatedProduct )
                                    <li class="product-item">
                                        <div class="contain-product layout-default">
                                            <div class="product-thumb">
                                                <a href="/single_product_view/{{$relatedProduct->p_code}}" class="link-to-product">
                                                    <img src="{{asset('')}}uploads/product_images/{{$relatedProduct->image1}}" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories">Fresh Fruit</b>
                                                <h4 class="product-title"><a href="/single_product_view/{{$relatedProduct->p_code}}" class="pr-name">{{$relatedProduct->p_name}}</a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">Tk</span>{{$relatedProduct->recent_price}}</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">Tk</span>{{$relatedProduct->before_price}}</span></del>
                                                </div> 

                                                <div class="slide-down-box">
                                                    <div class="all_btns text-center">
                                                        <a  href="/add_to_wish/{{$relatedProduct->p_code}}" type="button" class="btn btn-default btn-sm  wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                        <a   type="button" class="btn btn-default btn-sm " onclick="add_to_cart_once('{{$relatedProduct->p_code}}')">Add To Bag <i class="fa fa-shopping-bag"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
    </div>
@endsection

@section('scripts')
<script>
//       $fixed_selling_price = parseInt($(".selling_price").val());
//       $fixed_buying_price = parseInt($(".buying_price").val());

//       $t_buying_price = parseInt($(".tbp").val());
//       $max_qty = $(".quantity").attr('data-max_value');

//     $(".fa-caret-up").click(function(){
//         $quantity = parseInt($(".quantity").val())+1;
//         if($quantity  > $max_qty  ){

//         }else{
//             $t_selling_price = $quantity * $fixed_selling_price;
//             $t_buying_price = $quantity * $fixed_buying_price;
//             $(".dtv").val($t_selling_price);
//             $(".tbp").val($t_buying_price);
//             $(".dt").text($t_selling_price);
//         }

//     })

    
//     $(".fa-caret-down").click(function(){
//         $quantity = parseInt($(".quantity").val())-1;
//         if($quantity  > $max_qty  ){

//         }else{
//             $t_selling_price = $quantity * $fixed_selling_price;
//             $t_buying_price = $quantity * $fixed_buying_price;
//             $(".dtv").val($t_selling_price);
//             $(".tbp").val($t_buying_price);
//             $(".dt").text($t_selling_price);
//         }

//     })

$(".btn-rating").click(function(){
    $val = $(this).attr('data-value');
    $(".star").val($val);
})

</script>
@endsection