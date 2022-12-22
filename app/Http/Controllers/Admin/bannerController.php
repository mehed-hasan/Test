<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class bannerController extends Controller
{
    
    public function create_banner(){
        $datas= DB::table('banners')->orderBy('id','desc')->get();
        return view('admin/create_banner');
    }

    
    public function banner_list(){

        $datas= DB::table('banners')->orderBy('id','desc')->get();
        return view('/admin/banner_list')->withDatas($datas);
    }

    public function insert_banner (Request $request){

        $today = Carbon::today();

         $request->validate([
            'heading_name'=>'required|max:34|min:5',
            'short_desc'=>'required|max:100|min:15',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

                $image= $request->file('cover_img');
                $imageName = uniqid().$image->getClientOriginalName();

                //path upload
                if($imageName){
                    $image->move(public_path('uploads/banner_images'),$imageName);    
                    
                    DB::table('banners')->insert([
                        'heading'=>$request->input('heading_name'),
                        'short_desc'=> $request->input('short_desc'),
                        'cover_img' => $imageName,
                        'created_at' => $today
                    ]);

                    
                  }else{
                      $imageName = 'Error image !!';
                     
                  }



        session()->flash('message', 'Banner successfully crated.');
        return redirect('/admin/create_banner');

    }

    public function edit_banner($id){
        $datas= DB::table('banners')->where('id',$id)->first();
        return view('/admin/edit_banner')->withDatas($datas);

    }

    public function update_banner(Request $request, $id, $prev_img ){

        $today = Carbon::today();

        $request->validate([
            'heading_name'=>'required|max:34|min:5',
            'short_desc'=>'required|max:100|min:15',
            'cover_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);



        $image= $request->file('cover_img');
        if($image){
            // If everything change with image 

            $imageName = uniqid().$image->getClientOriginalName();

            if(file_exists('uploads/banner_images/'.$prev_img)){
                @unlink('uploads/banner_images/'.$prev_img);
                $image->move('uploads/banner_images/',$imageName);  
            }else{
                session()->flash('error_message', 'No file on that path.');
                return redirect('/admin/edit_banner/'.$id);
            }
            
            DB::table('banners')->where('id',$id)->update([
                'heading'=>$request->input('heading_name'),
                'short_desc'=> $request->input('short_desc'),
                'cover_img' => $imageName,
                'updated_at' => $today
            ]);


        }
        

        else{
            DB::table('banners')->where('id',$id)->update([
                'heading'=>$request->input('heading_name'),
                'short_desc'=> $request->input('short_desc'),
                'updated_at' => $today
            ]);
        }



            
        session()->flash('message', 'Banner updated successfully.');
        return redirect('/admin/edit_banner/'.$id);

    }


    public function delete_banner(Request $request){
        $id = $request->input('delete_id');
        
        $datas= DB::table('banners')->where('id',$id)->first();
        $cover_img = $datas->cover_img;
        @unlink('uploads/banner_images/'.$cover_img );

        DB::table('banners')->where('id',$id)->delete();

        session()->flash('message', 'Banner deleted successfully .');
        return redirect('/admin/banner_list/');


    }
}
