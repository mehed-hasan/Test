<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class specialOfferController extends Controller
{




    public function edit_special_offer(){
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $datas= DB::table('spoffers')->first();
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $customers = DB::table('users')->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $activeProducts = DB::table('products')->where('status','active')->count();
        $vpdatas = DB::table('products')->join('products_img', 'products.id', '=', 'products_img.p_code')->orderBy('viewed','desc')->limit(10)->get();
        $orderDatas = DB::table('users')->join('invoices', 'users.id', '=', 'invoices.user_id')
        ->orderBy('invoices.user_id','desc')->get();


        return view('/admin/edit_special_offer')->withOrderDatas($orderDatas)->withCustomers($customers)->withTorders($torders)->withVpdatas($vpdatas)
        ->withActiveProducts($activeProducts)->withQtyalarm($qtyalarm)->withDatas($datas);

    }

    public function update_special_offer(Request $request, $id, $prev_img ){

        $today = Carbon::today();

        $request->validate([
            'heading_name'=>'required|max:34|min:5',
            'cover_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link'=>'required',
            'expired_date'=> 'required'
        ]);



        $image= $request->file('cover_img');
        if($image){
            // If everything change with image 

            $imageName = uniqid().$image->getClientOriginalName();

            if(file_exists('uploads/special_offer_images/'.$prev_img)){
                @unlink('uploads/special_offer_images/'.$prev_img);
                $image->move('uploads/special_offer_images/',$imageName);  
            }else {
                $image->move('uploads/special_offer_images/',$imageName);  
            }
            
            DB::table('spoffers')->where('id',$id)->update([
                'heading'=>$request->input('heading_name'),
                'cover_img' => $imageName,
                'offer_ended_at' =>$request->input('expired_date'),
                'link' => $request->input('link'),
                'updated_at' => $today
            ]);


        }
        

        else{
            DB::table('spoffers')->where('id',$id)->update([
                'heading'=>$request->input('heading_name'),
                'offer_ended_at' =>$request->input('expired_date'),
                'link' => $request->input('link'),
                'updated_at' => $today
            ]);
        }



            
        session()->flash('message', 'Special updated successfully.');
        return redirect('/admin/edit_special_offer');

    }


}
