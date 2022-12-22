<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class linkController extends Controller
{
     // Crud for link ---------------------------------------------------------
     public function create_link(){
        return view('/admin/create_link');
    }


    public function insert_link(Request $request){
        $today = Carbon::today();

        $request->validate([
           'link_name' => 'required|max:255',
           'url' => 'required|max:255',
       ]);

                                   
       DB::table('links')->insert([

        'link_name' => $request->input('link_name'),
        'url'=>$request->input('url')
       ]);

    
    session()->flash('message', 'New link successfully created.');
    return redirect('/admin/create_link');
    }


    public function link_list(){

        $datas= DB::table('links')->orderBy('id','desc')->get();
        return view('/admin/link_list')->withDatas($datas);
    }

    
    public function delete_link(Request $request){
        $id = $request->input('delete_id');
        DB::table('links')->where('id',$id)->delete();
        session()->flash('message', 'link deleted successfully .');
        return redirect('/admin/link_list/');


    }


}
