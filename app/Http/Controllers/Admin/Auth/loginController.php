<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;


class loginController extends Controller
{
    //

    public function check(Request $request){
        $request->validate([
            'email' => 'required|max:500|',
            'password' => 'required|max:15|min:6'
        ]);

        $creds = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.login'); //Because done with rout name
        }else{
            session()->flash('message', 'Log in faild try again !.');
            return redirect()->route('admin.login');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
