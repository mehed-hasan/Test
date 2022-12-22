<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;
class FrontController extends Controller
{
    public function index(){

        $datas= DB::table('banners')->orderBy('id','desc')->get();
        $subBanners= DB::table('subbanners')->orderBy('id','desc')->get();
        $pdatas = DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->paginate(8);
        $fpdatas = DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->get();
        $vpdatas = DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->orderBy('viewed','desc')->limit(10)->get();
        $hotDatas = DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')
        ->where('tag','Hot')->orderBy('viewed','desc')->limit(10)->get();
        $productsCats =DB::Table('products')->select('cat_name')->get();  
        $spOffer = DB::table('spoffers')->first();
  
        $spOfferRow = DB::table('spoffers')->get();


        $fulldate;
        if(count($spOfferRow) >  0){
            $expired_date = DB::table('spoffers')->first();
            $ex_date = explode("-",$expired_date->offer_ended_at);
            $ex_year = $ex_date[0];
            $ex_month = $ex_date[1];
            $ex_day = $ex_date[2];
    
            $fulldate = Carbon::now();
            $date = explode("-", $fulldate);
            $year =  $date[0];
            $month = $date[1];
            $day = $date[2];
            $day = explode(" ",$day);
            $day = $day[0];

            $fulltime = explode(":", $fulldate);

            $hour = explode(" ",$fulltime[0]);
            $remain =  Carbon::create(0, $ex_month, $ex_day, 0, 0, 0)->longRelativeDiffForHumans(Carbon::create(0, $month, $day, 0, 0, 0), 6);
        }else{

            $fulldate = '00:00';
            $remain ='00:00';

        }



 


        return view('/welcome')->withDatas($datas)->withPdatas($pdatas)->withSubBanners($subBanners)->withFpdatas($fpdatas)
        ->withVpdatas($vpdatas)->withHotDatas($hotDatas)->withProductsCats($productsCats)->withRemain($remain)->withSpOffer($spOffer );
        //Fetching from sub cats 

    }


    public function load_more(Request $request){
        $pdatas = DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->paginate(4);
        $html='';
        if ($request->ajax()) {
            $test = csrf_token();
            foreach ($pdatas as $pdata) {

                $html.=
                "<li class='product-item col-lg-3 col-md-3 col-sm-4 col-xs-6'>
                <div class='contain-product layout-default'>
                    <div class='product-thumb'>
                    <h4 style='font-weight:bold; color:orange;position:absolute'> $pdata->tag  </h4>

                       <a href='single_product_view/$pdata->p_code'class='link-to-product'>
                            <img src='/uploads/product_images/$pdata->image1' alt='Vegetables' width='270' height='270' class='product-thumnail'>
                        </a>
                    </div>
                    <div class='info'>
                        <b class='categories'>$pdata->cat_name</b>
                        <h4 class='product-title'><a href='single_product_view/$pdata->p_code' class='pr-name'>$pdata->p_name</a></h4>
                        <div class='price '>
                            <ins><span class='price-amount'><span class='currencySymbol'>Tk</span>$pdata->recent_price</span></ins>
                            <del><span class='price-amount'><span class='currencySymbol'>Tk</span>$pdata->before_price</span></del>
                        </div>
                        <div class='slide-down-box'>
                        

                        <div class='slide-down-box'>
                            <div class='all_btns text-center'>
                            <a class='btn btn-default btn-sm '><i class='fa fa-bullseye'></i> $pdata->point </a>
                                <a  href='/add_to_wish/$pdata->p_code' type='button' class='btn btn-default btn-sm  wishlist-btn'><i class='fa fa-heart' aria-hidden='true'></i></a>
                                <a   type='button' class='btn btn-default btn-sm ' onclick='add_to_cart_once($pdata->p_code)'>Add To Bag <i class='fa fa-shopping-bag'></i></a></a>
                            </div>
                         </div>
                        </div>
                    </div>
                </div>
                </li>";
    
            }


            return $html;
        }

        return view('welcome');
    }

    public function cat_load(Request $request){

        $given_price1=  $_GET['given_price1'];
        $given_price2=  $_GET['given_price2'];
        $colors=  $_GET['colors'];
        $sizes=  $_GET['sizes'];
        $brands=  $_GET['brands'];
        $requiredCat = $_GET['cat_name'];


        $pdatas= DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')
        ->whereIn('color', $colors)->whereIn('brand', $brands)->whereIn('size', $sizes)->whereBetween('recent_price', [$given_price1, $given_price2])
        ->where('cat_name',$requiredCat)->orderBy('products.id','desc')->paginate(12);

        $html='';
        if ($request->ajax()) {
            foreach ($pdatas as $pdata) {

                $html.=
                "<li class='product-item col-lg-3 col-md-3 col-sm-4 col-xs-6'>
                <div class='contain-product layout-default'>
                    <div class='product-thumb'>
                    <h4 style='font-weight:bold; color:orange;position:absolute'> $pdata->tag  </h4>

                        <a href='/single_product_view/$pdata->p_code'class='link-to-product'>
                            <img src='/uploads/product_images/$pdata->image1' alt='Vegetables' width='270' height='270' class='product-thumnail'>
                        </a>
                    </div>
                    <div class='info'>
                        <b class='categories'>$pdata->cat_name</b>
                        <h4 class='product-title'><a href='single_product_view/$pdata->p_code' class='pr-name'>$pdata->p_name</a></h4>
                        <div class='price '>
                            <ins><span class='price-amount'><span class='currencySymbol'>Tk</span>$pdata->recent_price</span></ins>
                            <del><span class='price-amount'><span class='currencySymbol'>Tk</span>$pdata->before_price</span></del>
                        </div>
                        <div class='slide-down-box'>
                            <div class='all_btns text-center'>
                                <a class='btn btn-default btn-sm '><i class='fa fa-bullseye'></i> $pdata->point </a>
                                <a  href='/add_to_wish/$pdata->p_code' type='button' class='btn btn-default btn-sm  wishlist-btn'><i class='fa fa-heart' aria-hidden='true'></i></a>
                                <a   type='button' class='btn btn-default btn-sm ' onclick='add_to_cart_once($pdata->p_code)'>Add To Bag <i class='fa fa-shopping-bag'></i></a>
                            </div>
                         </div>
                    </div>
                </div>
                </li>";
    
            }
            return $html;
        }

        return view('category_view');
    }


    public function subcat_load(Request $request){
        $given_price1=  $_GET['given_price1'];
        $given_price2=  $_GET['given_price2'];
        $colors=  $_GET['colors'];
        $sizes=  $_GET['sizes'];
        $brands=  $_GET['brands'];
        $requiredCat = $_GET['subcat_name'];

        $pdatas= DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')
        ->whereIn('color', $colors)->whereIn('brand', $brands)->whereIn('size', $sizes)->whereBetween('recent_price', [$given_price1, $given_price2])
        ->where('sub_cat',$requiredCat)->orderBy('products.id','desc')->paginate(12);

        $html='';
        if ($request->ajax()) {
            foreach ($pdatas as $pdata) {

                $html.=
                "<li class='product-item col-lg-3 col-md-3 col-sm-4 col-xs-6'>
                <div class='contain-product layout-default'>
                    <div class='product-thumb'>
                    <h4 style='font-weight:bold; color:orange;position:absolute'> $pdata->tag  </h4>

                        <a href='/single_product_view/$pdata->p_code'class='link-to-product'>
                            <img src='/uploads/product_images/$pdata->image1' alt='Vegetables' width='270' height='270' class='product-thumnail'>
                        </a>
                    </div>
                    <div class='info'>
                        <b class='categories'>$pdata->cat_name</b>
                        <h4 class='product-title'><a href='single_product_view/$pdata->p_code' class='pr-name'>$pdata->p_name</a></h4>
                        <div class='price '>
                            <ins><span class='price-amount'><span class='currencySymbol'>Tk</span>$pdata->recent_price</span></ins>
                            <del><span class='price-amount'><span class='currencySymbol'>Tk</span>$pdata->before_price</span></del>
                        </div>
                        <div class='slide-down-box'>
                            <div class='all_btns text-center'>
                                <a class='btn btn-default btn-sm '><i class='fa fa-bullseye'></i> $pdata->point </a>
                                <a  href='/add_to_wish/$pdata->p_code' type='button' class='btn btn-default btn-sm  wishlist-btn'><i class='fa fa-heart' aria-hidden='true'></i></a>
                                <a   type='button' class='btn btn-default btn-sm ' onclick='add_to_cart_once($pdata->p_code)'>Add To Bag <i class='fa fa-shopping-bag'></i></a>
                            </div>
                         </div>
                    </div>
                </div>
                </li>";
    
            }
            return $html;
        }

        return view('category_view');
    }


    public function subsubcat_load(Request $request){
        $given_price1=  $_GET['given_price1'];
        $given_price2=  $_GET['given_price2'];
        $colors=  $_GET['colors'];
        $sizes=  $_GET['sizes'];
        $brands=  $_GET['brands'];
        $requiredCat = $_GET['subsubcat_name'];

        $pdatas= DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')
        ->whereIn('color', $colors)->whereIn('brand', $brands)->whereIn('size', $sizes)->whereBetween('recent_price', [$given_price1, $given_price2])
        ->where('sub_sub_cat',$requiredCat)->orderBy('products.id','desc')->paginate(12);

        $html='';
        if ($request->ajax()) {
            foreach ($pdatas as $pdata) {

                $html.=
                "<li class='product-item col-lg-3 col-md-3 col-sm-4 col-xs-6'>
                <div class='contain-product layout-default'>
                    <div class='product-thumb'>
                    <h4 style='font-weight:bold; color:orange;position:absolute'> $pdata->tag  </h4>

                        <a href='/single_product_view/$pdata->p_code'class='link-to-product'>
                            <img src='/uploads/product_images/$pdata->image1' alt='Vegetables' width='270' height='270' class='product-thumnail'>
                        </a>
                    </div>
                    <div class='info'>
                        <b class='categories'>$pdata->cat_name</b>
                        <h4 class='product-title'><a href='single_product_view/$pdata->p_code' class='pr-name'>$pdata->p_name</a></h4>
                        <div class='price '>
                            <ins><span class='price-amount'><span class='currencySymbol'>Tk</span>$pdata->recent_price</span></ins>
                            <del><span class='price-amount'><span class='currencySymbol'>Tk</span>$pdata->before_price</span></del>
                        </div>
                        <div class='slide-down-box'>
                            <div class='all_btns text-center'>
                                <a class='btn btn-default btn-sm '><i class='fa fa-bullseye'></i> $pdata->point </a>
                                <a  href='/add_to_wish/$pdata->p_code' type='button' class='btn btn-default btn-sm  wishlist-btn'><i class='fa fa-heart' aria-hidden='true'></i></a>
                                <a   type='button' class='btn btn-default btn-sm ' onclick='add_to_cart_once($pdata->p_code)'>Add To Bag <i class='fa fa-shopping-bag'></i></a></a>
                            </div>
                         </div>
                    </div>
                </div>
                </li>";
    
            }
            return $html;
        }

        return view('category_view');
    }




    public function about(){

        return view ('about_us');
    }


    public function product(){

        $catDatas= DB::table('cats')->orderBy('id','desc')->get();
        $infoDatas= DB::table('infos')->orderBy('id','desc')->first();
        $socialDatas= DB::table('socials')->orderBy('id','desc')->first(); 
        $linkDatas = DB::table('links')->orderBy('id','desc')->get();
        
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $carteds = DB::table('carts')->where('user_id', $user_id)->sum('qty');
            $cartedbill = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');
            $wishDatas = DB::table('wishlists')->where('user_id',$user_id);
            $totalWishlist = $wishDatas->count();
        }else {
            $totalWishlist=0;
        }
        return view ('single_product')->withInfoDatas($infoDatas)->withCatDatas($catDatas)->withTotalWishlist($totalWishlist)->withCarteds($carteds)->withCartedbill($cartedbill);
    }


    public function contact(){
        return view ('contact');
    }


    public function search(Request $request){

        $main_cat = $request->input('main_cat_name');
        $searched_text = $request->input('searched_text');
    
        $getResults = DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->where('cat_name','LIKE', "%{$searched_text}%")->orWhere('p_name', 'LIKE', "%{$searched_text}%") ->paginate(8);
        $foundResult = $getResults->count();

        return view ('search_results')->withGetResults($getResults)->withFoundResult($foundResult);
    }


    public function add_to_wish($id){
           if (Auth::user()) {
            $user_id = Auth::user()->id;
            $carteds = DB::table('carts')->where('user_id', $user_id)->sum('qty');
            $cartedbill = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');
            
             
            DB::table('wishlists')->insert([
                'user_id'=> $user_id,
                'p_id' => $id
            ]);
            session()->flash('message', 'Added succesfully.');
            return redirect('/wishlist');
           }

           else {
            return redirect('login');
           }
    }

    public function delete_from_wish($p_id){
        $user_id = Auth::user()->id;
        $carteds = DB::table('carts')->where('user_id', $user_id)->sum('qty');
        $cartedbill = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');
        DB::table('wishlists')->where('p_id',$p_id)->where('user_id',$user_id)->delete();
        session()->flash('message', 'Product removed  successfully .');
        return redirect('/wishlist');
    }


    public function add_to_cart_once(){
        if (Auth::user()) {  

            $user_id = Auth::user()->id;
            $p_id = $_GET['p_id'];

            $product_datas = DB::table('products')->where('id',$p_id)->first();
            $in_stock = $product_datas->stock;


            $color = $product_datas->color;
            $selling_price= $product_datas->recent_price;
            $buying_price = $product_datas->buying_price;
            $qty = 1;
            
            // per price 
            // per price 

            $is_carted_this = DB::table('carts')->where('p_id',$p_id)->count();

            if($is_carted_this > 0 ){

                return  "carted";

            }else{

                DB::table('carts')->insert([
                    'user_id'=> $user_id,
                    'p_id' => $p_id,
                    'color' =>$color,
                    'qty' => $qty,
                    't_selling_price' => $selling_price,
                    't_buying_price' => $buying_price,
                    'created_at' => Carbon::today()
                ]);


            }


            $cartDatas = DB::table('carts')->join('products', 'carts.p_id', '=', 'products.id')
            ->join('products_img', 'products.id', '=', 'products_img.p_code')->where('carts.user_id', Auth::user()->id )
            ->orderBy('carts.id','desc')->get();




            $html2='';


                foreach ($cartDatas as  $cartData){
                    $html2.=
                    "
                    <li>
                        <div class='minicart-item'>
                            <div class='thumb'>
                                <a href='#'><img src='/uploads/product_images/$cartData->image1' width='90' height='90' alt='$cartData->p_name'></a>
                            </div>
                            <div class='left-info'>
                                <div class='product-title'><a href='#' class='product-name'>$cartData->p_name</a> <span>  ( Qty: $cartData->qty )</span></div>
                                <div class='price'>
                                    <ins><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->recent_price</span></ins>
                                    <del><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->before_price</span></del>
                                </div>
    
                            </div>
                        </div>
                    </li>
                    ";
                }


                //  Sending Data to java script on view [age ]
                $total_carted = DB::table('carts')->where('user_id',Auth::user()->id)->sum('qty');
                $total_bill = DB::table('carts')->where('user_id',Auth::user()->id)->sum('t_selling_price');
                return $total_carted.'@'.$total_bill.'@'.$html2;



           }

           

           else {
            return "redirect"; // If not logged in 
           }
    }







    public function add_to_cart(){
        if (Auth::user()) {  

            $user_id = Auth::user()->id;
            $p_id = $_GET['p_id'];

            $product_datas = DB::table('products')->where('id',$p_id)->first();
            $in_stock = $product_datas->stock;

            $color = $product_datas->color;
            $selling_price= $product_datas->recent_price;
            $buying_price = $product_datas->buying_price;
            $qty = 1;
            
            // per price 
            // per price 

            $is_carted_this = DB::table('carts')->where('p_id',$p_id)->count();

            if($is_carted_this > 0 ){
               $datas =  DB::table('carts')->where('p_id',$p_id)->first();
               $prev_qty = $datas->qty;
               $prev_t_buying_price = $datas->t_buying_price;
               $prev_t_selling_price = $datas->t_selling_price;
               
               $qty = $prev_qty+1;
               $buying_price =  $prev_t_buying_price + $buying_price;
               $selling_price = $prev_t_selling_price + $selling_price;
            

               DB::table('carts')->where('p_id',$p_id)->update([
                'qty' => $qty,
                't_selling_price' => $selling_price,
                't_buying_price' => $buying_price,
                'created_at' => Carbon::today()
                 ]);

            }else{

                DB::table('carts')->insert([
                    'user_id'=> $user_id,
                    'p_id' => $p_id,
                    'color' =>$color,
                    'qty' => $qty,
                    't_selling_price' => $selling_price,
                    't_buying_price' => $buying_price,
                    'created_at' => Carbon::today()
                ]);


            }


            $cartDatas = DB::table('carts')->join('products', 'carts.p_id', '=', 'products.id')
            ->join('products_img', 'products.id', '=', 'products_img.p_code')->where('carts.user_id', Auth::user()->id )
            ->orderBy('carts.id','desc')->get();




            $html='';
            $html2='';

                foreach ($cartDatas as  $cartData){
                    $html.=
                    "<tr class='cart_item'>
                        <td class='product-thumbnail' data-title='Product Name'>
                            <a class='prd-thumb' href='#'>
                                <figure><img width='113' height='113' src='/uploads/product_images/$cartData->image1' alt='shipping cart'></figure>
                            </a>
                            <a class='prd-name' href='#'>$cartData->p_name</a>
                            <div class='action'>
                            </div>
                        </td>
                        <td class='product-price' data-title='Price'>
                            <div class='price price-contain'>
                                <ins><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->recent_price</span></ins>
                                <del><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->before_price</span></del>
                            </div>
                        </td>
                        <td class='product-quantity' data-title='Quantity'>
                            <span>$cartData->qty</span>
                        </td>
                        <td class='product-subtotal' data-title='Total'>
                            <div class='price price-contain'>
                                <ins><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->t_selling_price</span></ins>
                            </div>
                        </td>
                        <td>
                            <div class='all_btns text-center'>
                            <a   type='button' class='btn btn-default btn-sm ' onclick='remove_from_cart($cartData->p_code)'><i class='fa fa-minus'></i></a>
                            <a   type='button' class='btn btn-default btn-sm ' onclick='add_to_cart($cartData->p_code)'><i class='fa fa-plus'></i></a>
                                <a href='/delete_cart/$cartData->p_id' class='remove btn btn-default '><i class='fa fa-trash-o' aria-hidden='true'></i></a>

                            </div>
                        </td>
                    </tr>
                    ";
              
                }

                foreach ($cartDatas as  $cartData){
                    $html2.=
                    "
                    <li>
                        <div class='minicart-item'>
                            <div class='thumb'>
                                <a href='#'><img src='/uploads/product_images/$cartData->image1' width='90' height='90' alt='$cartData->p_name'></a>
                            </div>
                            <div class='left-info'>
                                <div class='product-title'><a href='#' class='product-name'>$cartData->p_name</a> <span>  ( Qty: $cartData->qty )</span></div>
                                <div class='price'>
                                    <ins><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->recent_price</span></ins>
                                    <del><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->before_price</span></del>
                                </div>
    
                            </div>
                        </div>
                    </li>
                    ";
                }


                //  Sending Data to java script on view [age ]
                $total_carted = DB::table('carts')->where('user_id',Auth::user()->id)->sum('qty');
                $total_bill = DB::table('carts')->where('user_id',Auth::user()->id)->sum('t_selling_price');
                return $total_carted.'@'.$total_bill.'@'.$html.'@'.$html2;



           }

           

           else {
            return "redirect"; // If not logged in 
           }
    }

    
    public function remove_from_cart(){
        if (Auth::user()) {

            $user_id = Auth::user()->id;
            $p_id = $_GET['p_id'];

            $product_datas = DB::table('products')->where('id',$p_id)->first();

            $color = $product_datas->color;
            $selling_price= $product_datas->recent_price;
            $buying_price = $product_datas->buying_price;
            $qty = 1;
            

            $is_carted_this = DB::table('carts')->where('p_id',$p_id)->count();

            if($is_carted_this > 0 ){
               $datas =  DB::table('carts')->where('p_id',$p_id)->first();
               $prev_qty = $datas->qty;
               $prev_t_buying_price = $datas->t_buying_price;
               $prev_t_selling_price = $datas->t_selling_price;
               
               $qty = $prev_qty-1;

               if($qty == 0){
                DB::table('carts')->where('p_id',$p_id)->delete();
               }

               $buying_price =  $prev_t_buying_price - $buying_price;
               $selling_price = $prev_t_selling_price - $selling_price;
            

               DB::table('carts')->where('p_id',$p_id)->update([
                'qty' => $qty,
                't_selling_price' => $selling_price,
                't_buying_price' => $buying_price,
                'created_at' => Carbon::today()
                 ]);

                }


                $cartDatas = DB::table('carts')->join('products', 'carts.p_id', '=', 'products.id')
                ->join('products_img', 'products.id', '=', 'products_img.p_code')->where('carts.user_id', Auth::user()->id )
                ->orderBy('carts.id','desc')->get();
    
    
                $html='';
    
                    foreach ($cartDatas as  $cartData){
                        $html.=
                        "<tr class='cart_item'>
                            <td class='product-thumbnail' data-title='Product Name'>
                                <a class='prd-thumb' href='#'>
                                    <figure><img width='113' height='113' src='/uploads/product_images/$cartData->image1' alt='shipping cart'></figure>
                                </a>
                                <a class='prd-name' href='#'>$cartData->p_name</a>
                                <div class='action'>
                                </div>
                            </td>
                            <td class='product-price' data-title='Price'>
                                <div class='price price-contain'>
                                    <ins><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->recent_price</span></ins>
                                    <del><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->before_price</span></del>
                                </div>
                            </td>
                            <td class='product-quantity' data-title='Quantity'>
                                <span>$cartData->qty</span>
                            </td>
                            <td class='product-subtotal' data-title='Total'>
                                <div class='price price-contain'>
                                    <ins><span class='price-amount'><span class='currencySymbol'>Tk </span>$cartData->t_selling_price</span></ins>
                                </div>
                            </td>
                            <td>
                                <div class='all_btns text-center'>
                                <a   type='button' class='btn btn-default btn-sm ' onclick='remove_from_cart($cartData->p_code)'><i class='fa fa-minus'></i></a>
                                <a   type='button' class='btn btn-default btn-sm ' onclick='add_to_cart($cartData->p_code)'><i class='fa fa-plus'></i></a>
                                    <a href='/delete_cart/$cartData->p_id' class='remove btn btn-default '><i class='fa fa-trash-o' aria-hidden='true'></i></a>
    
                                </div>
                            </td>
                        </tr>
                        ";
                  
                    }
        
    
                    //  Sending Data 
                //  Sending Data to java script on view [age ]
                $total_carted = DB::table('carts')->where('user_id',Auth::user()->id)->sum('qty');
                $total_bill = DB::table('carts')->where('user_id',Auth::user()->id)->sum('t_selling_price');
                return $total_carted.'@'.$total_bill.'@'.$html;

                

            }

           else {
            return "redirect"; // If not logged in 
           }
    }




    public function delete_cart($p_id){
        if (Auth::user()) {
            $user_id = Auth::user()->id;

            DB::table('carts')->where('p_id',$p_id)->where('user_id',$user_id)->delete();

            session()->flash('message', 'Removed form cart');
            return redirect("/cart");
           }

           else {
            return redirect('login');
           }
    }

    public function buy($addr, $dlv_time){
        $today = Carbon::today();
       $user_id = Auth::user()->id; 
        // update shipping addr 
        DB::table('users')->where('id', Auth::user()->id)->update([
            'addr' => $addr,
            'dlv_time' => $dlv_time

        ]);

        DB::table('invoices')->insert([
            'user_id' =>$user_id,
            'created_at' => $today
           
        ]);

        $rows = DB::table('carts')->where('user_id',$user_id)->get();
        $get_invoice_id = DB::table('invoices')->where('user_id',$user_id)->where('is_ordered', 0)->first();
        $get_invoice_id = $get_invoice_id->id;
        
        foreach ($rows as $row) {
            
            DB::table('orders')->insert([
                'user_id'=> $user_id,
                'invoice_no'=> $get_invoice_id,
                'p_id' => $row->p_id,
                'color' =>$row->color,
                'qty' => $row->qty,
                't_selling_price' => $row->t_selling_price,
                't_buying_price' => $row->t_buying_price,
                'created_at' =>  $today 
            ]);

        };

         DB::table('invoices')->where('user_id',$user_id)->where('is_ordered', 0)->update([
             'is_ordered'=>1
         ]);

         DB::table('carts')->where('user_id',$user_id)->delete();

        session()->flash('message', 'You succesfully placed an order !');
        return redirect("/cart");        
    }


    public function pay_buy($addr, $total_bill, $dlv_time){
        $today = Carbon::today();
        // Generate_invoice 
        // Invoice no is table id no 
       $user_id = Auth::user()->id; 

       DB::table('users')->where('id', Auth::user()->id)->update([
        'addr' => $addr,
        'dlv_time' => $dlv_time
       ]);

        DB::table('invoices')->insert([
            'user_id' =>$user_id,
            'created_at' => $today,
            'order_type' => 1
        ]);

        $rows = DB::table('carts')->where('user_id',$user_id)->get();
        $get_invoice_id = DB::table('invoices')->where('user_id',$user_id)->where('is_ordered', 0)->first();
        $get_invoice_id = $get_invoice_id->id;
        
        foreach ($rows as $row) {
            
            DB::table('orders')->insert([
                'user_id'=> $user_id,
                'invoice_no'=> $get_invoice_id,
                'p_id' => $row->p_id,
                'color' =>$row->color,
                'qty' => $row->qty,
                't_selling_price' => $row->t_selling_price,
                't_buying_price' => $row->t_buying_price,
                'created_at' =>  $today 
            ]);

        };

        //Dischargre balance 
        $remai_shop_bal = Auth::user()->shopable - $total_bill;
        DB::table('users')->where('id', Auth::user()->id)->update([
            'shopable' => $remai_shop_bal
        ]);

        // In balance to admin;
        $admin_bal_info = DB::table('accounts')->first();
        $prev_bal = $admin_bal_info->bal;
        $update_bal = $prev_bal + $total_bill;

        DB::table('accounts')->update([
            'bal' =>$update_bal
        ]);



         DB::table('invoices')->where('user_id',$user_id)->where('is_ordered', 0)->update([
             'is_ordered'=>1
         ]);

         DB::table('carts')->where('user_id',$user_id)->delete();

        session()->flash('message', 'You succesfully placed an order !');
        return redirect("/cart");

        
    }




    public function review(Request $request){
        
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $p_id = $request->input('p_id');
            $user= $request->input('user');
            $star= $request->input('star');
            $text= $request->input('text');
    
            DB::table('reviews')->insert([
                'user_name' => $request->input('user'),
                'star'=>$request->input('star'),
                'p_id'=> $request->input('p_id'),
                'comment'=>$request->input('comment')
               ]);
    
               DB::table('orders')->where('user_id',$user_id)->update([
                'is_reviewed'=> 2
            ]);
    
               session()->flash('message', 'You place review!');
               return redirect("/cart");
        }
        else {
            return redirect('/login');
        }

    
    }
    public function order_details($invoice_no){
        $details = DB::table('orders')->where('invoice_no',$invoice_no)->get();
        return view('admin/order_details')->withDetails($details);
    }


    public function toc(){
        $details = DB::table('tocs')->first();
        $text = $details->text;
        return view('toc')->withText($text);
    }
    public function privacy_policy(){
        $details = DB::table('privacy_policies')->first();
        $text = $details->text;
        return view('privacy_policy')->withText($text);
    }

    public function return_policy(){
        $details = DB::table('return_policies')->first();
        $text = $details->text;
        return view('return_policy')->withText($text);
    }


    public function update_infos (Request $request){
        $addr = $request->input('addr');
        $name = $request->input('name');

        DB::table('users')->where('id', Auth::user()->id)->update([
            'name' => $name,
            'addr'=>$addr
        ]);

            
        session()->flash('message', 'Address updated successfully!');
        return redirect("/home");
    }
}