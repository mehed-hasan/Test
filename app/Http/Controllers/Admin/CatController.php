<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class CatController extends Controller
{
 
    
    public function create_cat(){
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        return view('admin/create_cat')->withQtyalarm($qtyalarm)->withTorders($torders );
    }

    
    public function cat_list(){
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();

        $datas= DB::table('cats')->orderBy('id','desc')->get();
        return view('/admin/cat_list')->withDatas($datas)->withQtyalarm($qtyalarm)->withTorders($torders );
    }

    public function insert_cat (Request $request){

        $today = Carbon::today();

         $request->validate([
            'cat_name' => 'required|max:255|unique:cats,cat_name',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

                $image= $request->file('cover_img');
                $imageName = $image->getClientOriginalName();

                //path upload
                if($imageName){
                    $image->move(public_path('uploads/cat_images'),$imageName);    
                    
                    DB::table('cats')->insert([

                        'cat_name' => $request->input('cat_name'),
                        'cover_img' => $imageName,
                        'created_at' => $today
                    ]);

                    
                  }else{
                      $imageName = 'Error image !!';
                     
                  }

                  
        // Adding as all cat (This table is for margin all cats/ sub cats/ sub sub cats)
        $cat_name = $request->input('cat_name');

        if(DB::table('all_cats')->where('all_cat_name',$cat_name)->exists()){
            //Dont Add 
        }else{
            DB::table('all_cats')->insert([
                'all_cat_name' => $cat_name,
            ]);
        }




        session()->flash('message', 'New category successfully updated.');
        return redirect('/admin/create_cat');

    }

    public function edit_cat($id){
        $qtyalarm = DB::table('products')->where('stock','<',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();

        $datas= DB::table('cats')->where('id',$id)->first();
        return view('/admin/edit_cat')->withDatas($datas)->withQtyalarm($qtyalarm)->withTorders($torders );

    }

    public function update_cat(Request $request, $id, $prev_img, $prev_name ){

        $today = Carbon::today();

        $request->validate([
            'cat_name' => "required|max:255|unique:cats,cat_name,$id",
            'cover_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);



        $image= $request->file('cover_img');
        if($image){
            // If everything change with image 
            $imageName = $image->getClientOriginalName();

            if(file_exists('uploads/cat_images/'.$prev_img)){
                @unlink('uploads/cat_images/'.$prev_img);
                $image->move('uploads/cat_images/',$imageName);  
            }else{
                session()->flash('error_messege', 'No file on that path.');
                return redirect('/admin/edit_cat/'.$id);
            }
            
            DB::table('cats')->where('id',$id)->update([
                'cat_name' => $request->input('cat_name'),
                'cover_img' => $imageName,
                'created_at' => $today
            ]);


        }
        

        else{
            DB::table('cats')->where('id',$id)->update([
                'cat_name' => $request->input('cat_name'),
                'created_at' => $today
            ]);
        }

        //Updating allcats
        DB::table('all_cats')->where('all_cat_name', $prev_name)->update([
            'all_cat_name' => $request->input('cat_name')
        ]);
                            //path upload   
                      

            
        session()->flash('message', 'Category updated successfully updated.');
        return redirect('/admin/edit_cat/'.$id);

    }


    public function delete_cat(Request $request){
        $id = $request->input('delete_id');
        
        $datas= DB::table('cats')->where('id',$id)->first();
        $cover_img = $datas->cover_img;
        $cat_name = $datas->cat_name;
        @unlink('uploads/cat_images/'.$cover_img );

        DB::table('cats')->where('id',$id)->delete();
        DB::table('all_cats')->where('all_cat_name',$cat_name )->delete();

        session()->flash('message', 'Category deleted successfully .');
        return redirect('/admin/cat_list/');


    }
}
