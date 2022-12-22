<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class subbannerController extends Controller
{
    public function create_sub_banner(){
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();
        // $torders = DB::table('invoices')->where('is_ordered',1)->count();

        $datas= DB::table('subbanners')->orderBy('id','desc')->get();
        return view('admin/create_sub_banner')->withTorders($torders)->withQtyalarm($qtyalarm);
    }

    
    public function sub_banner_list(){
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();
        // $torders = DB::table('invoices')->where('is_ordered',1)->count();

        $datas= DB::table('subbanners')->orderBy('id','desc')->get();
        return view('/admin/sub_banner_list')->withDatas($datas)->withTorders($torders)->withQtyalarm($qtyalarm);
    }

    public function insert_sub_banner (Request $request){

        $today = Carbon::today();

         $request->validate([
            'heading_name'=>'required|max:34|min:5',
            'short_desc'=>'required|max:100|min:15',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link'=>'required'
        ]);

                $image= $request->file('cover_img');
                $imageName = uniqid().$image->getClientOriginalName();

                //path upload
                if($imageName){
                    $image->move(public_path('uploads/sub_banner_images'),$imageName);    
                    
                    DB::table('subbanners')->insert([
                        'heading'=>$request->input('heading_name'),
                        'short_desc'=> $request->input('short_desc'),
                        'cover_img' => $imageName,
                        'link' =>$request->input('link'),
                        'created_at' => $today
                    ]);

                    
                  }else{
                      $imageName = 'Error image !!';
                     
                  }



        session()->flash('message', 'Sub banner successfully crated.');
        return redirect('/admin/create_sub_banner');

    }

    public function edit_sub_banner($id){
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $datas= DB::table('subbanners')->where('id',$id)->first();
        return view('/admin/edit_sub_banner')->withDatas($datas)->withTorders($torders)->withQtyalarm($qtyalarm);;

    }

    public function update_sub_banner(Request $request, $id, $prev_img ){

        $today = Carbon::today();

        $request->validate([
            'heading_name'=>'required|max:34|min:5',
            'short_desc'=>'required|max:100|min:15',
            'cover_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link'=>'required'
        ]);



        $image= $request->file('cover_img');
        if($image){
            // If everything change with image 

            $imageName = uniqid().$image->getClientOriginalName();

            if(file_exists('uploads/sub_banner_images/'.$prev_img)){
                @unlink('uploads/sub_banner_images/'.$prev_img);
                $image->move('uploads/sub_banner_images/',$imageName);  
            }else{
                session()->flash('error_message', 'No file on that path.');
                return redirect('/admin/edit_sub_banner/'.$id);
            }
            
            DB::table('subbanners')->where('id',$id)->update([
                'heading'=>$request->input('heading_name'),
                'short_desc'=> $request->input('short_desc'),
                'cover_img' => $imageName,
                'link' =>$request->input('link'),
                'updated_at' => $today
            ]);


        }
        

        else{
            DB::table('subbanners')->where('id',$id)->update([
                'heading'=>$request->input('heading_name'),
                'short_desc'=> $request->input('short_desc'),
                'link' =>$request->input('link'),
                'updated_at' => $today
            ]);
        }



            
        session()->flash('message', 'Sub banner updated successfully.');
        return redirect('/admin/edit_sub_banner/'.$id);

    }


    public function delete_sub_banner(Request $request){
        $id = $request->input('delete_id');
        
        $datas= DB::table('subbanners')->where('id',$id)->first();
        $cover_img = $datas->cover_img;
        @unlink('uploads/sub_banner_images/'.$cover_img );

        DB::table('subbanners')->where('id',$id)->delete();

        session()->flash('message', 'Sub banner deleted successfully .');
        return redirect('/admin/sub_banner_list/');


    }
}
