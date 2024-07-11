<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function create(Request $request){
        if(Auth::check()){
            return redirect('home');
        }
        return view("auth.login");
    }
    function check(Request $request){
       
        $credentials= $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember_me=$request->has('remember_me');
        
        if(Auth::attempt($credentials,$remember_me)){
          
          $request->session()->regenerate();
          return redirect('home');
            
        }else{
            return back()->withErrors(['User Not Found !']);
        }
            
    }
}
