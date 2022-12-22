<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class SetupController extends Controller
{

 // Crud for brand ---------------------------------------------------------
    public function create_brand(){
        return view('/admin/create_brand');
    }


    public function insert_brand(Request $request){
        $today = Carbon::today();

        $request->validate([
           'brand_name' => 'required|max:255|unique:brands,brand_name',
           'cover_img' => 'required'
       ]);

       $image= $request->file('cover_img');
       $imageName = $image->getClientOriginalName();
                                   
                       //path upload
       if($imageName){
       $image->move(public_path('uploads/brand_images'),$imageName);  
        
       DB::table('brands')->insert([
        'brand_name' => $request->input('brand_name'),
        'cover_img' => $imageName,
        'created_at' => $today
       ]);
    }else{
        $imageName ="Error Image";
    }
    
    session()->flash('message', 'New brand successfully created.');
    return redirect('/admin/create_brand');
    }


    public function brand_list(){

        $datas= DB::table('brands')->orderBy('id','desc')->get();
        return view('/admin/brand_list')->withDatas($datas);
    }

    
    public function delete_brand(Request $request){
        $id = $request->input('delete_id');
        DB::table('brands')->where('id',$id)->delete();
        session()->flash('message', 'Brand deleted successfully .');
        return redirect('/admin/brand_list/');


    }




 // Crud for color ---------------------------------------------------------
    public function create_color(){
        return view('/admin/create_color');
    }


    public function insert_color(Request $request){
        $today = Carbon::today();

        $request->validate([
           'color_name' => 'required|max:255|unique:colors,color_name',
       ]);

                                   
       DB::table('colors')->insert([

        'color_name' => $request->input('color_name'),
        'created_at' => $today
       ]);

    
    session()->flash('message', 'New color successfully created.');
    return redirect('/admin/create_color');
    }


    public function color_list(){

        $datas= DB::table('colors')->orderBy('id','desc')->get();
        return view('/admin/color_list')->withDatas($datas);
    }

    
    public function delete_color(Request $request){
        $id = $request->input('delete_id');
        DB::table('colors')->where('id',$id)->delete();
        session()->flash('message', 'color deleted successfully .');
        return redirect('/admin/color_list/');


    }





    // Crud for size ---------------------------------------------------------
    public function create_size(){
        return view('/admin/create_size');
    }


    public function insert_size(Request $request){
        $today = Carbon::today();

        $request->validate([
           'size_name' => 'required|max:255|unique:sizes,size_name',
       ]);

                                   
       DB::table('sizes')->insert([

        'size_name' => $request->input('size_name'),
        'created_at' => $today
       ]);

    
    session()->flash('message', 'New size successfully created.');
    return redirect('/admin/create_size');
    }


    public function size_list(){

        $datas= DB::table('sizes')->orderBy('id','desc')->get();
        return view('/admin/size_list')->withDatas($datas);
    }

    
    public function delete_size(Request $request){
        $id = $request->input('delete_id');
        DB::table('sizes')->where('id',$id)->delete();
        session()->flash('message', 'size deleted successfully .');
        return redirect('/admin/size_list/');


    }

// Crud for unit ---------------------------------------------------------
public function create_unit(){
    return view('/admin/create_unit');
}


public function insert_unit(Request $request){
    $today = Carbon::today();

    $request->validate([
       'unit_name' => 'required|max:255|unique:units,unit_name',
   ]);

                               
   DB::table('units')->insert([
    'unit_name' => $request->input('unit_name')
   ]);


session()->flash('message', 'New unit successfully created.');
return redirect('/admin/create_unit');
}


public function unit_list(){

    $datas= DB::table('units')->orderBy('id','desc')->get();
    return view('/admin/unit_list')->withDatas($datas);
}


public function delete_unit(Request $request){
    $id = $request->input('delete_id');
    DB::table('units')->where('id',$id)->delete();
    session()->flash('message', 'unit deleted successfully.');
    return redirect('/admin/unit_list/');


}


// Crud for tag ---------------------------------------------------------
public function create_tag(){
    return view('/admin/create_tag');
}


public function insert_tag(Request $request){
    $today = Carbon::today();

    $request->validate([
       'tag_name' => 'required|max:255|unique:tags,tag_name',
   ]);

                               
   DB::table('tags')->insert([

    'tag_name' => $request->input('tag_name'),
   ]);


session()->flash('message', 'New tag successfully created.');
return redirect('/admin/create_tag');
}


public function tag_list(){

    $datas= DB::table('tags')->orderBy('id','desc')->get();
    return view('/admin/tag_list')->withDatas($datas);
}


public function delete_tag(Request $request){
    $id = $request->input('delete_id');
    DB::table('tags')->where('id',$id)->delete();
    session()->flash('message', 'tag deleted successfully .');
    return redirect('/admin/tag_list/');
}



}
