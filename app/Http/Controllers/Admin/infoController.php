<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class infoController extends Controller
{
    public function create_info(){
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        $datas= DB::table('infos')->orderBy('id','desc')->get();
        return view('admin/create_info')->withTorders($torders)->withQtyalarm($qtyalarm);
    }

    
    public function info_list(){
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();

        $datas= DB::table('infos')->orderBy('id','desc')->get();
        return view('/admin/info_list')->withDatas($datas)->withTorders($torders)->withQtyalarm($qtyalarm);
    }

    public function insert_info (Request $request){

        $today = Carbon::today();

         $request->validate([
            'contact_no'=>'required|max:34|min:11',
            'email'=>'required|max:100|min:8',
            'address'=>'required|max:200',
            'open_hour'=>'required|max:200',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

                $image= $request->file('logo');
                $imageName = uniqid().$image->getClientOriginalName();

                //path upload
                if($imageName){
                    $image->move(public_path('uploads/logo'),$imageName);    
                    
                    DB::table('infos')->insert([
                        'email'=> $request->input('email'),
                        'address'=>$request->input('address'),
                        'open_hour'=>$request->input('open_hour'),
                        'logo' => $imageName,
                        'created_at' => $today
                    ]);

                    
                  }else{
                      $imageName = 'Error image !!';
                     
                  }



        session()->flash('message', 'Info successfully created.');
        return redirect('/admin/create_info');

    }

    public function edit_info($id){
        $datas= DB::table('infos')->where('id',$id)->first();
        $qtyalarm = DB::table('products')->where('stock','>',10)->count();
        $torders = DB::table('invoices')->where('is_ordered',1)->count();
        return view('/admin/edit_info')->withDatas($datas)->withTorders($torders)->withQtyalarm($qtyalarm);

    }

    public function update_info(Request $request, $id, $prev_img ){
        $today = Carbon::today();

        $request->validate([
            'contact_no'=>'required|max:34|min:11',
            'email'=>'required|max:100|min:8',
            'address'=>'required|max:200',
            'open_hour'=>'required|max:200',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);



        $image= $request->file('logo');
        if($image){
            // If everything change with image 

            $imageName = uniqid().$image->getClientOriginalName();

            if(file_exists('uploads/logo/'.$prev_img)){
                @unlink('uploads/logo/'.$prev_img);
                $image->move('uploads/logo/',$imageName);  
            }else {
                $image->move('uploads/logo/',$imageName); 
            }
            
            DB::table('infos')->where('id',$id)->update([
                'contact_no'=>$request->input('contact_no'),
                'email'=> $request->input('email'),
                'address'=>$request->input('address'),
                'open_hour'=>$request->input('open_hour'),
                'logo' => $imageName,
                'updated_at' => $today
            ]);


        }
        

        else{
            DB::table('infos')->where('id',$id)->update([
                'contact_no'=>$request->input('contact_no'),
                'email'=> $request->input('email'),
                'address'=>$request->input('address'),
                'open_hour'=>$request->input('open_hour'),
                'updated_at' => $today
            ]);
        }



            
        session()->flash('message', 'Info updated successfully.');
        return redirect('/admin/edit_info/'.$id);

    }


    public function delete_info(Request $request){
        $id = $request->input('delete_id');
        
        $datas= DB::table('infos')->where('id',$id)->first();
        $logo = $datas->logo;
        @unlink('uploads/logo/'.$logo );

        DB::table('infos')->where('id',$id)->delete();

        session()->flash('message', 'Info deleted successfully .');
        return redirect('/admin/info_list/');


    }
}
