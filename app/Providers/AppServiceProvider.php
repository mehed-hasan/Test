<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Auth;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */



    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){

        view()->composer('*', function($view)
        {
            //Auto distribute balance  ???DAILY UPGRADE --------
            $today = Carbon::today();
            $nextday = Carbon::tomorrow(); //next_update
            $schedule = DB::table('schedules')->get();

            $updating_day  ;
            if(count($schedule) > 0){
                $schedule = DB::table('schedules')->first();

                $updating_day = $schedule->updating_day;
                if($updating_day == ''){
                    $updating_day = $today;
                    
                    DB::table('schedules')->where('updating_day', '')->update([
                        "updating_day" => $today
                    ]);
                }
                $is_updated = $schedule->is_updated;
            }else{
                $updating_day = '00:00';
            }


            if($today == $updating_day){
                // Excess updating balance form basic and premium package 
                $basic_excess_balancer_datas_no =DB::table('users')->where('type','!=', '')->where('updating_bal', '>', 500)->where('updating_bal', '<', 2500)->count();
                $basic_excess_balancer_datas =DB::table('users')->where('type','!=', '')->where('updating_bal', '>', 500)->where('updating_bal', '<', 2500)->get();

                $premium_excess_balancer_datas_no =DB::table('users')->where('type','!=', '')->where('updating_bal', '>', 2500)->count();
                $premium_excess_balancer_datas =DB::table('users')->where('type','!=', '')->where('updating_bal', '>', 2500)->get();


                $is_any_excess_balancer = $basic_excess_balancer_datas_no + $premium_excess_balancer_datas_no;
              
                if($is_any_excess_balancer > 0 ){

                    $total_excess_bal = ($basic_excess_balancer_datas_no * 500 ) + ($premium_excess_balancer_datas_no * 2500);
                    $total_packager_no = DB::table('users')->where('type','!=', '')->count(); 
                    $each_get = $total_excess_bal / $total_packager_no;

                         
                          // Chargin money wo has more than 500 tk in u.balance for basic 
                          if($basic_excess_balancer_datas_no > 0 ){
                            foreach ( $basic_excess_balancer_datas as $basic_excess_balancer_data) {

                                $basic_excess_balancer_updating_bal = $basic_excess_balancer_data->updating_bal;
                                $basic_excess_balancer_id = $basic_excess_balancer_data->id;
                                $update_updating_bal = $basic_excess_balancer_updating_bal - 500;
                                DB::table('users')->where('id',$basic_excess_balancer_id)->update([
                                    'updating_bal'=>  $update_updating_bal 
                                ]);
  
                            }
                          }


                          // Chargin money wo has more than 2500 tk in u.balance for premium
                          if($premium_excess_balancer_datas_no > 0 ){
                            foreach ( $premium_excess_balancer_datas as $premium_excess_balancer_data) {

                                $premium_excess_balancer_updating_bal = $premium_excess_balancer_data->updating_bal;
                                $premium_excess_balancer_id = $premium_excess_balancer_data->id;
                                $update_updating_bal = $premium_excess_balancer_updating_bal - 2500;
                                DB::table('users')->where('id',$premium_excess_balancer_id)->update([
                                    'updating_bal'=>  $update_updating_bal 
                                ]);
                            }

                          }


                  
                          // Distributing money
                          $packager_datas = DB::table('users')->where('type','!=', '')->get(); 
                          foreach ( $packager_datas as $packeger_data) {
                              $get_packager_updating_bal = $packeger_data->updating_bal;
                              $get_packager_dis_bal = $packeger_data->dis_bal;
                              $get_packager_id = $packeger_data->id;
                              $get_packager_ref_bonus = $packeger_data->ref_bonus;
                              $update_dis_bal =  $get_packager_dis_bal + $get_packager_ref_bonus + $each_get;
                              DB::table('users')->where('id',$get_packager_id)->update([
                                  'dis_bal'=> 0,
                                  'ref_bonus'=>0,
                                  'withdrawable' => $update_dis_bal 
                              ]);
                          }



                }
                

                DB::table('schedules')->where('updating_day', $updating_day)->update([
                    "last_updated" => $today,
                    "updating_day" => $nextday,
                ]);

            }else{

            }
        //Auto distribute balance  ???DAILY UPGRADE -------- Ended 






//******************************************************************************************************* */
        // Sharing variable to all views ---------------------------------------------------------------------------------*******

        if (Auth::guard('web')->check()) {
            $user_id = Auth::guard('web')->id();
        }else {
            $user_id = 0;
        }
                    // Cart datas 
        $cartDatas = DB::table('carts')->join('products', 'carts.p_id', '=', 'products.id')
        ->join('products_img', 'products.id', '=', 'products_img.p_code')->where('carts.user_id', $user_id)
        ->orderBy('carts.id','desc')->get();
        $carteds = DB::table('carts')->where('user_id', $user_id)->sum('qty');
        $cartedbill = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');
        $socialDatas= DB::table('socials')->orderBy('id','desc')->first(); 
        $linkDatas = DB::table('links')->orderBy('id','desc')->get();
        $catDatas= DB::table('cats')->orderBy('id','desc')->get();
        $infoDatas= DB::table('infos')->orderBy('id','desc')->first();
        $cats =DB::Table('products')->select('cat_name')->get();  
        $brands =DB::Table('brands')->get();  
        $subCats= DB::table('subcats')->orderBy('id','desc')->get();
        $subsubCats= DB::table('subsubcats')->orderBy('id','desc')->get();
        $point = 0;
       




        if ($user_id !== 0) {
            $carteds = DB::table('carts')->where('user_id', $user_id)->sum('qty');
            $cartedbill = DB::table('carts')->where('user_id', $user_id)->sum('t_selling_price');
            $user_id = Auth::user()->id;
            $wishDatas = DB::table('wishlists')->where('user_id',$user_id);
            $totalWishlist = $wishDatas->count();
            $userInfos = DB::table('users')->where('id', $user_id)->count(); 
            

        }else {
            $totalWishlist=0;
            $wishDatas=0;
            $cartedbill=0;
            $carteds = 0;
            $point =0;
        }

        view()->share('user_id', $user_id);
        view()->share('carteds', $carteds);
        view()->share('cartDatas', $cartDatas);
        view()->share('cartedbill', $cartedbill);
        view()->share('socialDatas', $socialDatas);
        view()->share('linkDatas', $linkDatas);
        view()->share('catDatas', $catDatas);
        view()->share('infoDatas', $infoDatas);
        view()->share('wishDatas ', $wishDatas );
        view()->share('totalWishlist', $totalWishlist);
        view()->share('subCats', $subCats);
        view()->share('subsubCats', $subsubCats);
        view()->share('cats', $cats);
        view()->share('subCats', $subCats);
        view()->share('subsubCats', $subsubCats);
        view()->share('brands', $brands);
        view()->share('point', $point);

        });

                // Admin---------------------------------------------------
                $torders = DB::table('invoices')->where('is_ordered',1)->count();
                $qtyalarm = DB::table('products')->where('stock','<',10)->count();
                view()->share('torders',  $torders );
                view()->share('qtyalarm',$qtyalarm);

    }




}
