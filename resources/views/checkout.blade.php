@extends('layout')
@section('main_content')
                    <!--Hero Section-->
                    <div class="hero-section hero-background">
                        <h1 class="page-title">Checkout</h1>
                    </div>
                    
                    @if ($carteds > 0)
                    <div class="container sm-margin-top-37px">
                        <form action="" method="get">
                        <div class="row">
                            <!--checkout progress box-->
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                <div class="checkout-progress-wrap">
                                    <ul class="steps" id="addr">
                                        <li class="step 1st">
                                            <div class="checkout-act active">
                                                <h3 class="title-box"><span class="number">#</span>Hello ! {{Auth::user()->name}} </h3>
                                                <div class="box-content">
                                                    <h4 style="text-decoration: underline" class="text-danger">check your shipping address before order.</h4>

                                                    <p >Please have look before making a final order ! Dont forget to set your shipping address. Check out your address and then place order. you are free to change your shipping address</p>
                                                    <p class="alert alert-danger alert"> Please fill the shipping address and delivery time !</p>
                                                    <textarea value="{{Auth::user()->addr}}" placeholder="Current Shipping Address " class="form-control addr"  cols="10" rows="10">{{Auth::user()->addr}}</textarea>
                                                    <br>
                                                    <label for=""> Your delivery reciving time :</label> <br>
                                                    <input class="d_time" data-check ="0" type="radio" name="dlvry_time" value="10 AM - 12 PM" id=""> 10 AM - 12 PM <br>
                                                    <input class="d_time" data-check ="0" type="radio" name="dlvry_time" value="12 PM - 3 PM " id=""> 12 PM - 3 PM <br>
                                                    <input class="d_time" data-check ="0" type="radio" name="dlvry_time" value="4 PM - 7 PM " id=""> 4 PM - 7 PM <br> 
                                                    <input class="d_time" data-check ="0" type="radio" name="dlvry_time" value="Any time " id=""> Any time  <br> 

                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
        
                            <!--Order Summary-->
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                                <div class="order-summary sm-margin-bottom-80px">
                                    <div class="title-block">
                                        <h3 class="title">Order Summary</h3>
                                    </div>
                                    <div class="cart-list-box short-type">
                                        <span class="number">{{$titem}} items / {{$carteds}} Products </span>
                                        <ul class="cart-list">
                                            @foreach ($checkouts as $checkout )
                                            <li class="cart-elem">
                                                <div class="cart-item">
                                                    <div class="product-thumb">
                                                        <a class="prd-thumb" href="#">
                                                            <figure><img src="{{asset('')}}uploads/product_images/{{$checkout->image1}}" width="113" height="113" alt="shop-cart" ></figure>
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <span class="txt-quantity">1X {{$checkout->qty}}</span>
                                                        <a href="#" class="pr-name">{{$checkout->p_name}}</a>
                                                    </div>
                                                    <div class="price price-contain">
                                                        <ins><span class="price-amount"><span class="currencySymbol">Tk </span>{{$checkout->t_selling_price}}</span></ins>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach

                                        </ul>
                                        <ul class="subtotal">
                                            {{-- <li>
                                                <div class="subtotal-line">
                                                    <b class="stt-name">Subtotal</b>
                                                    <span class="stt-price">£170.00</span>
                                                </div>
                                            </li> --}}
                                            {{-- <li>
                                                <div class="subtotal-line">
                                                    <b class="stt-name">Shipping</b>
                                                    <span class="stt-price">£20.00</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="subtotal-line">
                                                    <b class="stt-name">Tax</b>
                                                    <span class="stt-price">£0.00</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="subtotal-line">
                                                    <a href="#" class="link-forward">Promo/Gift Certificate</a>
                                                </div>
                                            </li> --}}
                                            <li>
                                                <div class="subtotal-line">
                                                    <b class="stt-name">total:</b>
                                                    <span class="stt-price">Tk {{$iprice}}</span>
                                                    <input class="total_bill" type="hidden" name="" value="{{$iprice}}">
                                                </div>
                                            </li>
                                            <br>
                                            <a  class="btn btn-warning form-control buy" >Cash On Delivery </a>
                                            <br>
                                            @if (Auth::user()->shopable > $iprice)
                                            <h4 class="text-center"> Or</h4>
                                            <a  class="btn btn-warning form-control pay_buy" >Pay From Shop Balace <strong> (Cur Bal : {{Auth::user()->shopable }} Tk )</strong></a>

                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                      </form> 
                    </div>
                    @else
                        <div style="min-height: 250px;" class="text-center">

                            <h2 style="margin-top: 75px;">You need to select at least 1 product to checkout</h2>
                        </div>
                    @endif
@endsection


@section('scripts')
    <script>
        $is_chceked = 0;
        $(".d_time").click(function(){
            $(".d_time").attr("data-check", "0");
            $(this).attr("data-check", "1");

        });


        $(".alert").hide();
        // $(".check_alert").hide();

        $(".buy").click(function(){
            $is_filled = $(".addr").val();

            // Check box validating 
            $(".d_time").each(function () {
            $val = $(this).attr('data-check');
            $val = parseInt($val);
            $is_chceked +=  $val ;
            });


            if($is_filled == '' || $is_chceked == 0){
                window.location.href = "#addr";
                $(".alert").show();
            }else{
                $addr = $(".addr").val();
                $dlv_time = $("input[type='radio']:checked").val();
                window.location.href = "/buy/"+$addr+"/"+$dlv_time;
            }

        });


        $(".pay_buy").click(function(){
            $is_filled = $(".addr").val();

            // Check box validating 
            $(".d_time").each(function () {
            $val = $(this).attr('data-check');
            $val = parseInt($val);
            $is_chceked +=  $val ;
            });


            if($is_filled == '' || $is_chceked == 0){
                window.location.href = "#addr";
                $(".alert").show();
            }else{
                $addr = $(".addr").val();
                $dlv_time = $("input[type='radio']:checked").val();
                $total_price = $(".total_bill").val();
                window.location.href = "/pay_buy/"+$addr+"/"+$total_price+"/"+$dlv_time ;
            }
        });
        
    </script>
@endsection