<?php

namespace App\Http\Controllers;

use App\Models\ville;
use App\Models\garde;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function pharmaciesGardeNuit(Request $request){
        if($request->ville){
            
            $pharmacies= garde::whereDate('date',date('Y/m/d'))->where('type','Nuit')->whereHas('pharmacies.ville',function($query) use ($request){
                $query->where('nom',Str::ascii($request->ville));
            })->get();
            /*$pharmacies=ville::where('nom',$request->ville)->first()->pharmacies()->whereHas('gardes',function($q){
                $q::where('type','Nuit')->where('date',date("Y-m-d"));
            })->get();*/
            
            return response()->json(['pharmacies'=>$pharmacies]);
        }

    }
    function pharmaciesGardeJour(Request $request){
        if($request->ville){
            
            $pharmacies= garde::whereDate('date',date('Y/m/d'))->where('type','Jour')->whereHas('pharmacies.ville',function($query) use ($request){
                $query->where('nom',Str::ascii($request->ville));
            })->get();
            
            return response()->json(['pharmacies'=>$pharmacies]);
            
        }   
    }
    function pharmaciesGardeAllDay(Request $request){
        if($request->ville){
            
            $pharmacies= garde::whereDate('date',date('Y/m/d'))->where('type','24h/24')->whereHas('pharmacies.ville',function($query) use ($request){
                $query->where('nom',Str::ascii($request->ville));
            })->get();
            
            return response()->json(['pharmacies'=>$pharmacies]);
            
        }   
    }
    function pharmaciesVille(Request $request){
        if($request->ville){
            
            /*$pharmacies= garde::whereDate('date',date('Y/m/d'))->whereHas('pharmacies.ville',function($query){
                $query->where('nom',$request->ville);
            })->get();*/
            $pharmacies=ville::where('nom',Str::ascii($request->ville))->first()->pharmacies;
           
            if($pharmacies->isNotEmpty())
            return response()->json(['pharmacies'=>$pharmacies]);
        }else{
            return response()->json(['pharmacies'=>"error"]);
        }
    }
}
