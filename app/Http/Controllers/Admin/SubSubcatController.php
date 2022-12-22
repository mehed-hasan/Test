<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class SubSubcatController extends Controller
{

    public function create_sub_sub_cat(){
        $subCatDatas= DB::table('subcats')->orderBy('id','desc')->get();
        return view('admin/create_sub_sub_cat')->withSubCatDatas($subCatDatas);
    }

    
    public function sub_sub_cat_list(){

        $datas= DB::table('subsubcats')->orderBy('id','desc')->get();
        return view('/admin/sub_sub_cat_list')->withDatas($datas);
    }

    public function insert_sub_sub_cat (Request $request){

        $today = Carbon::today();

         $request->validate([
            'sub_sub_cat_name' => 'required|max:255|unique:subsubcats,sub_sub_cat',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


                $image= $request->file('cover_img');
                $imageName = $image->getClientOriginalName();

                //path upload
                if($imageName){
                    $image->move(public_path('uploads/sub_sub_cat_images'),$imageName);    
                
                    DB::table('subsubcats')->insert([
                        'cat_name' => $request->input('cat_name'),
                        'sub_cat' => $request->input('sub_cat_name'),
                        'sub_sub_cat' => $request->input('sub_sub_cat_name'),
                        'cover_img' => $imageName,
                        'created_at' => $today
                    ]);

                    
                  }else{
                      $imageName = 'Error image !!';
                     
                  }


        // Adding as all cat (This table is for margin all cats/ sub cats/ sub sub cats)
        $combine_cat_name = $request->input('cat_name').' >> '.$request->input('sub_cat_name').' >> '.$request->input('sub_sub_cat_name');

        if(DB::table('all_cats')->where('all_cat_name',$combine_cat_name )->exists()){
            //Dont Add 
        }else{
            DB::table('all_cats')->insert([
                'all_cat_name' => $combine_cat_name,
            ]);
        }




        session()->flash('message', 'New sub_sub_category successfully updated.');
        return redirect('/admin/create_sub_sub_cat');

    }

    public function edit_sub_sub_cat($id){

        $subCatDatas= DB::table('subcats')->orderBy('id','desc')->get();
        $datas= DB::table('subsubcats')->where('id',$id)->first();
        return view('/admin/edit_sub_sub_cat')->withDatas($datas)->withSubCatDatas($subCatDatas);
    }




    public function update_sub_sub_cat(Request $request, $id, $prev_img, $combine_cat_name ){
        // echo $combine_cat_name; exit();
        $today = Carbon::today();
        $request->validate([
            'sub_sub_cat_name' => "required|max:255|unique:subsubcats,sub_sub_cat,$id",
            'cover_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);



        $image= $request->file('cover_img');
        if($image){
            // If everything change with image 
            $imageName = $image->getClientOriginalName();

            if(file_exists('uploads/sub_sub_cat_images/'.$prev_img)){
                @unlink('uploads/sub_sub_cat_images/'.$prev_img);
                $image->move('uploads/sub_sub_cat_images/',$imageName);  
            }else{
                session()->flash('error_messege', 'No file on that path.');
                return redirect('/admin/edit_sub_sub_cat/'.$id);
            }
            

            DB::table('subsubcats')->where('id',$id)->update([
                'cat_name' => $request->input('cat_name'),
                'sub_cat' => $request->input('sub_cat_name'),
                'sub_sub_cat' => $request->input('sub_sub_cat_name'),
                'cover_img' => $imageName,
                'updated_at' => $today
            ]);

        }
        

        else{
            DB::table('subsubcats')->where('id',$id)->update([
                'cat_name' => $request->input('cat_name'),
                'sub_cat' => $request->input('sub_cat_name'),
                'sub_sub_cat' => $request->input('sub_sub_cat_name'),
                'updated_at' => $today
            ]);
        }


        // /Updating allcats
        DB::table('all_cats')->where('all_cat_name', $combine_cat_name)->update([
            'all_cat_name' => $request->input('cat_name').' >> '.$request->input('sub_cat_name').' >> '.$request->input('sub_sub_cat_name')
        ]);
            
        session()->flash('message', 'sub_sub_category updated successfully updated.');
        return redirect('/admin/edit_sub_sub_cat/'.$id);

    }


    public function delete_sub_sub_cat(Request $request){
        $id = $request->input('delete_id');
        
        $datas= DB::table('subsubcats')->where('id',$id)->first();
        $cover_img = $datas->cover_img;
        $combine_cat_name = $datas->cat_name." >> ".$datas->sub_cat." >> ".$datas->sub_sub_cat;
        @unlink('uploads/sub_sub_cat_images/'.$cover_img );

        DB::table('subsubcats')->where('id',$id)->delete();
        DB::table('all_cats')->where('all_cat_name', $combine_cat_name )->delete();
        session()->flash('message', 'sub_sub_category deleted successfully .');
        return redirect('/admin/sub_sub_cat_list/');
    }
}
