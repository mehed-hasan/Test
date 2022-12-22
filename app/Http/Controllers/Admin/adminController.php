<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class adminController extends Controller
{



    public function create_admin_page(){
        return view('create_admin_page');
    }



    public function create_admin(Request $request){

        $request->validate([
            'email' => 'required|max:255',
            'pass' => 'required|max:255',
        ]);


        DB::table('admins')->insert([
            'email' => $request->input('email'),
            'password' =>Hash::make($request->input('pass')) 
        ]);

        
            
        session()->flash('message', 'New admin added successfully !');
        return redirect('/admin/create_admin_page');

    }


    public function delete_admin(Request $request){
        
        $id = $request->input('delete_id');
        DB::table('admins')->where('id',$id)->delete();
        session()->flash('message', 'Deleted successfully !');
        return redirect('/admin/admin_list');

    }
}
