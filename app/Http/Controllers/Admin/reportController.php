<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class reportController extends Controller
{
    
    public function delivered($invoice_no, $userid){
        

        // Add money to admin 
        $get_bill = DB::table('orders')->where('invoice_no', $invoice_no)->sum('t_selling_price');
         $get_bill; 

        $bal_infos = DB::table('accounts')->first();
        $prev_bal = $bal_infos->bal;
        $update_bal= $prev_bal + $get_bill;

        DB::table('accounts')->update([
            'bal' => $update_bal
        ]);
        // update everything as is_orders  == 1 in carts table

        $point =0; 
        DB::table('invoices')->where('is_ordered',1)->update([
            'is_ordered'=>2
        ]);

        DB::table('orders')->where('invoice_no',$invoice_no)->where('user_id', $userid)->update([
            'is_reviewed'=>1
        ]);

        ///update stoxck 
        $orderinfos = DB::table('orders')->where('invoice_no',$invoice_no)->where('user_id',$userid)->get();

        foreach ($orderinfos as $orderinfo) {
            $brought_qty = $orderinfo->qty;
            $p_id = $orderinfo->p_id;
            
            $stockinfo =  DB::table('products')->where('id',$p_id)->first();
            $stocked_qty = $stockinfo->stock;
            $point = $stockinfo->point * $brought_qty ;

            $updatestock = $stocked_qty - $brought_qty;

            //Updating stock
            DB::table('products')->where('id',$p_id)->update([
                'stock'=> $updatestock
            ]);

            //Adding points with user table
            $user_infos = DB::table('users')->where('id',$userid)->first();
            $prev_point = $user_infos->point;
            $update_point = $prev_point + $point;

            DB::table('users')->where('id',$userid)->update([
                'point'=> $update_point 
            ]);

        }
        session()->flash('message', 'Thanks for completing order  !');
        return redirect("/admin/home");
    }
        public function inprocess($invoice_no, $userid){
    
            // update everything as is_orders  == 1 in carts table
    
            DB::table('orders')->where('invoice_no',$invoice_no)->where('user_id', $userid)->update([
                'is_reviewed'=>3
            ]);


        
        session()->flash('message', 'Thanks for updating status  !');
        return redirect("/admin/home");
    }



    public function reports(){
        $today = Carbon::today();
        $yesterday = Carbon::yesterday(); 

        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        
        $todaySold = DB::table('reports')->where('created_at', $today)->sum('sold');
        $todaySoldQty = DB::table('reports')->where('created_at', $today)->sum('qty');
        $todayProfit  = DB::table('reports')->where('created_at', $today)->sum('profit');
        $todayInvested = DB::table('reports')->where('created_at', $today)->sum('invested');


        $yesterdaySold = DB::table('reports')->where('created_at', $yesterday)->sum('sold');
        $yesterdaySoldQty = DB::table('reports')->where('created_at', $yesterday)->sum('qty');
        $yesterdayProfit  = DB::table('reports')->where('created_at', $yesterday)->sum('profit');
        $yesterdayInvested = DB::table('reports')->where('created_at', $yesterday)->sum('invested');
        // Fetch Bal 
        $acInfo = DB::table('accounts')->first();
        $bal = $acInfo->bal;
        $lastSold = $acInfo->created_at;
        $lastWithdrawn = $acInfo->updated_at;

        return view('admin/reports')->withTorders($torders )->withQtyalarm($qtyalarm)->withTodaySold($todaySold)->withTodaySoldQty($todaySoldQty)
        ->withYesterdaySold($yesterdaySold)->withYesterdaySoldQty($yesterdaySoldQty)->withYesterdayProfit($yesterdayProfit)->withYesterdayInvested($yesterdayInvested)
        ->withTodayProfit($todayProfit)->withTodayInvested($todayInvested)->withBal($bal)->withLastWithdrawn($lastWithdrawn)->withLastSold($lastSold) ;
        
    }

        
}
