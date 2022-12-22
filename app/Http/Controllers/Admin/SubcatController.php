<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class SubcatController extends Controller
{
    public function create_sub_cat(){
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        // $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $catDatas= DB::table('cats')->orderBy('id','desc')->get();
        return view('admin/create_sub_cat')->withCatDatas($catDatas);
    }

    
    public function sub_cat_list(){
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        // $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $datas= DB::table('subcats')->orderBy('id','desc')->get();
        return view('/admin/sub_cat_list')->withDatas($datas);
    }

    public function insert_sub_cat (Request $request){

        $today = Carbon::today();

         $request->validate([
            'sub_cat_name' => 'required|max:255|unique:subcats,sub_cat',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


                $image= $request->file('cover_img');
                $imageName = $image->getClientOriginalName();

                //path upload
                if($imageName){
                    $image->move(public_path('uploads/sub_cat_images'),$imageName);    
                    
                    DB::table('subcats')->insert([
                        'cat_name' => $request->input('cat_name'),
                        'sub_cat' => $request->input('sub_cat_name'),
                        'cover_img' => $imageName,
                        'created_at' => $today
                    ]);

                    
                  }else{
                      $imageName = 'Error image !!';
                     
                  }

        // Adding as all cat (This table is for margin all cats/ sub cats/ sub sub cats)
        $combine_cat_name = $request->input('cat_name').' >> '.$request->input('sub_cat_name');

        if(DB::table('all_cats')->where('all_cat_name',$combine_cat_name )->exists()){
            //Dont Add 
        }else{
            DB::table('all_cats')->insert([
                'all_cat_name' => $combine_cat_name,
            ]);
        }




        session()->flash('message', 'New Sub category successfully updated.');
        return redirect('/admin/create_sub_cat');

    }

    public function edit_sub_cat($id){
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $datas= DB::table('subcats')->where('id',$id)->first();
        $catDatas= DB::table('cats')->orderBy('id','desc')->get();
        return view('/admin/edit_sub_cat')->withDatas($datas)->withCatDatas($catDatas)->withQtyalarm($qtyalarm)->withTorders($torders );

    }

    public function update_sub_cat(Request $request, $id, $prev_img, $combine_cat_name ){

        $today = Carbon::today();

        $request->validate([
            'sub_cat_name' => "required|max:255|unique:subcats,sub_cat,$id",
            'cover_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);



        $image= $request->file('cover_img');
        if($image){
            // If everything change with image 
            $imageName = $image->getClientOriginalName();

            if(file_exists('uploads/sub_cat_images/'.$prev_img)){
                @unlink('uploads/sub_cat_images/'.$prev_img);
                $image->move('uploads/sub_cat_images/',$imageName);  
            }else{
                session()->flash('error_messege', 'No file on that path.');
                return redirect('/admin/edit_sub_cat/'.$id);
            }
            
            DB::table('subcats')->where('id',$id)->update([
                'cat_name' => $request->input('cat_name'),
                'sub_cat' => $request->input('sub_cat_name'),
                'cover_img' => $imageName,
                'updated_at' => $today
            ]);

        }
        

        else{
            DB::table('subcats')->where('id',$id)->update([
                'cat_name' => $request->input('cat_name'),
                'sub_cat' => $request->input('sub_cat_name'),
                'updated_at' => $today
            ]);
        }
                            //path upload   
                      
// /Updating allcats
        DB::table('all_cats')->where('all_cat_name', $combine_cat_name)->update([
            'all_cat_name' => $request->input('cat_name').' >> '.$request->input('sub_cat_name')
        ]);
             
            
        session()->flash('message', 'sub_category updated successfully updated.');
        return redirect('/admin/edit_sub_cat/'.$id);

    }


    public function delete_sub_cat(Request $request){
        $id = $request->input('delete_id');
        
        $datas= DB::table('subcats')->where('id',$id)->first();
        $cover_img = $datas->cover_img;
        $combine_cat_name = $datas->cat_name." >> ".$datas->sub_cat;

        @unlink('uploads/sub_cat_images/'.$cover_img );

        DB::table('subcats')->where('id',$id)->delete();
        DB::table('all_cats')->where('all_cat_name', $combine_cat_name )->delete();

        session()->flash('message', 'sub_category deleted successfully .');
        return redirect('/admin/sub_cat_list/');


    }
}
