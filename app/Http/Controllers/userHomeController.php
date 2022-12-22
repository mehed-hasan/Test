<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
class userHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function wishlist(){

    


        $wishDatas = DB::table('wishlists')->join('products', 'wishlists.p_id', '=', 'products.id')
                    ->join('products_img', 'products.id', '=', 'products_img.p_code')->where('user_id',Auth::user()->id)
                    ->orderBy('wishlists.id','desc')->get();

        return view ('wishlist')->withWishDatas($wishDatas);
    }


    public function cart(){

        $infoDatas= DB::table('infos')->orderBy('id','desc')->first();
        $catDatas= DB::table('cats')->orderBy('id','desc')->get();
        $socialDatas= DB::table('socials')->orderBy('id','desc')->first(); 
        $linkDatas = DB::table('links')->orderBy('id','desc')->get();
        
   
            $user_id = Auth::user()->id;
            $carteds = DB::table('carts')->where('user_id', $user_id)->sum('qty');
            $cartedbill = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');
            $wishDatas = DB::table('wishlists')->where('user_id',$user_id);
            $totalWishlist = $wishDatas->count();
 

        $cartDatas = DB::table('carts')->join('products', 'carts.p_id', '=', 'products.id')
        ->join('products_img', 'products.id', '=', 'products_img.p_code')->where('carts.user_id', Auth::user()->id )
        ->orderBy('carts.id','desc')->get();
  
        $iprice = DB::table('carts')->where('user_id', Auth::user()->id)->sum('t_selling_price');

        return view ('cart')->withInfoDatas($infoDatas)->withSocialDatas($socialDatas)->withLinkDatas($linkDatas)->withCatDatas($catDatas)
        ->withTotalWishlist($totalWishlist)
        ->withCartDatas($cartDatas)->withIprice($iprice)->withCarteds($carteds)->withCartedbill($cartedbill);
    }


    public function checkout(){

   
            $user_id = Auth::user()->id;
            $carteds = DB::table('carts')->where('user_id', $user_id)->sum('qty');
            $cartedbill = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');
            $wishDatas = DB::table('wishlists')->where('user_id',$user_id);
            $totalWishlist = $wishDatas->count();

        $catDatas= DB::table('cats')->orderBy('id','desc')->get();
        $infoDatas= DB::table('infos')->orderBy('id','desc')->first();
        $socialDatas= DB::table('socials')->orderBy('id','desc')->first(); 
        $linkDatas = DB::table('links')->orderBy('id','desc')->get();
        $checkouts = DB::table('carts')->join('products', 'carts.p_id', '=', 'products.id')
        ->join('products_img', 'products.id', '=', 'products_img.p_code')->where('user_id',$user_id)
        ->orderBy('carts.id','desc')->get();
        $titem= $checkouts->count();
        $iprice = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');
        return view ('checkout')->withInfoDatas($infoDatas)->withSocialDatas($socialDatas)->withLinkDatas($linkDatas)->withCatDatas($catDatas)
        ->withTotalWishlist($totalWishlist)->withTitem($titem)->withCheckouts($checkouts)->withIprice($iprice)->withCarteds($carteds)->withCartedbill($cartedbill) ;
    }




// Testing purpose started *******---------------------------------------------------------------
    public function reset(){
        DB::table('users')->delete();
        DB::table('invoices')->delete();
        DB::table('carts')->delete();
        DB::table('accounts')->update([
            'bal' => 0
        ]);
        DB::table('official_ids')->update([
            'is_used' => 0
        ]);
    }
     public function factory(){
        $starting_digit = 0;
        $name = 'p';
        $ending_digit =20;
        
        for($i = $starting_digit; $i < $ending_digit; $i++) {
            $starting_digit += 1;
            $user_name = $name.$starting_digit;
            $email = 'p'.$starting_digit.'@gmail.com';
            $pass = '123';
            $ref_id = '017'.$starting_digit;

            if($starting_digit == 1){
                DB::table('users')->insert([
                    'type' => 'premium',
                    'who_refered' =>'null',
                    'who_ref_name' => 'null',
                    'name' => $user_name,
                    'email' => $email,
                    'ref_id' => $ref_id,
                    'point' => 20000,
                    'password' =>'$2y$10$8no9Gb8E57QIeYVyvK52SutYGwLoNHgXplcm/7REvzCAD9iOmihKy'
                ]);
            }else {
                DB::table('users')->insert([
                    'name' => $user_name,
                    'email' => $email,
                    'ref_id' => $ref_id,
                    'point' => 20000,
                    'password' =>'$2y$10$8no9Gb8E57QIeYVyvK52SutYGwLoNHgXplcm/7REvzCAD9iOmihKy'
                ]);
            }


        }
        echo $ending_digit. ' person registerred !';
        exit();
     }
     public function test(){
         $info ='';
         $packageName ='premium';
        $refferer_data = DB::table('users')->where('type','!=', '')->where('hand','<', 3)->count();
        $taker_data = DB::table('users')->where('type','')->orderBy('id','desc')->count(); 

         if($refferer_data > 0 and $taker_data > 0){
            $refferer_data = DB::table('users')->where('type','basic')->where('hand','<', 3)->orWhere('type','premium')->orderBy('id','asc')->first();
            $taker_data = DB::table('users')->where('type','')->orderBy('id','asc')->first();

            $refferer_user_name = $refferer_data->name;
            $refferer_id = $refferer_data->ref_id;
            $user_name = $taker_data->name;
            $loop_no = 0;

        
            if( $refferer_user_name == 'null'){

                DB::table('users')->where('name',$user_name)->update([
                    'type'=> 'premium',
                    'who_refered' => $refferer_id,
                    'who_ref_name' =>$refferer_user_name
                ]);


            }
            else {
                DB::table('users')->where('name',$user_name)->update([
                    'type'=> 'premium',
                    'who_refered' => $refferer_id,
                    'who_ref_name' =>$refferer_user_name
                ]);

                return redirect('/package'.'/'.$packageName.'/'.$user_name.'/'.$refferer_user_name.'/'.$loop_no);
            }
         } 
         
         else {
             echo "All done";
         }
     }

// Testing purpose ended *******---------------------------------------------------------------
//_-_______--_-_______----_----_-_-_-_------_______________-----------________------------




    public function index(){
        if(Auth::user()){
            $user_id = Auth::user()->id;
        }else {
            $user_id =0;

        }
        $linkDatas = DB::table('links')->orderBy('id','desc')->get();
        $infoDatas= DB::table('infos')->orderBy('id','desc')->first();
        $socialDatas= DB::table('socials')->orderBy('id','desc')->first();
        $catDatas= DB::table('cats')->orderBy('id','desc')->get();
        $cartedbill = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');
        $userdata = DB::table('users')->where('id', $user_id)->first();
        $treeOnes = DB::table('users')->where('who_ref_name',Auth::user()->name)->get();
        $queues = DB::table('assigners')->where('assigner_name', Auth::user()->name)->get();
        $queue = DB::table('assigners')->where('assigner_name', Auth::user()->name)->first();
        $torder = DB::table('orders')->where('user_id',Auth::user()->id)->count();
        $activeOrder = DB::table('orders')->where('user_id',Auth::user()->id)->where('is_reviewed',0)->count();
        $orderStatus = DB::table('orders')->where('user_id', Auth::user()->id)->distinct()->get();
        $addr = DB::table('users')->where('id',Auth::user()->id)->first();
        $addr = $addr->addr;


        $treeAlls = DB::table('users')->where('type','!=', '' )->get();
        // Cart datas 
        $carteds = DB::table('carts')->where('user_id', $user_id)->sum('qty');

        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $wishDatas = DB::table('wishlists')->where('user_id',$user_id);
            $totalWishlist = $wishDatas->count();
        }else {
            $totalWishlist=0;
        }


        return view('/home')->withInfoDatas($infoDatas)->withAddr($addr ) 
        ->withSocialDatas($socialDatas)->withLinkDatas($linkDatas)->withTotalWishlist($totalWishlist)
        ->withCarteds($carteds)->withCatDatas($catDatas)->withCartedbill($cartedbill)->withUserdata($userdata)->withTreeOnes($treeOnes)->withTreeAlls($treeAlls)
        ->withQueues($queues)->withQueue($queue)->withTorder($torder)->withActiveOrder($activeOrder)->withOrderStatus($orderStatus);
    
        //Fetching from sub cats 
    }







}

