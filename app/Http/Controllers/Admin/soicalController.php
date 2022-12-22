<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class soicalController extends Controller
{
    public function edit_social(){
            $socialDatas  = DB::table('socials')->first();
            return view('admin/edit_social')->withSocialDatas($socialDatas);
    }


    public function update_soial(Request $request, $id){
        $today = Carbon::today();

            DB::table('socials')->where('id',$id)->update([
                'fb'=>$request->input('fb_link'),
                'insta'=> $request->input('insta_link'),
                'printer'=>$request->input('printer_link'),
                'twitter'=>$request->input('twitter_link'),
                'yt'=>$request->input('yt_link')
            ]);

        session()->flash('message', 'Social link updated successfully.');
        return redirect('/admin/edit_social/');

    }
}
