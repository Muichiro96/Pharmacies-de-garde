<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ville;
use App\Models\pharmacie;
use App\Models\suggestion;
use Illuminate\Support\Facades\Auth;
class SuggestionController extends Controller
{
   
    function storeSuggestion(Request $request){
        $request->validate([
            'name'=> 'required',
            'phone'=>'required',
            'address'=>'required',
            'longitude'=>'required|decimal:2,20',
            'lattitude'=>'required|decimal:2,20',
            'city'=>'required',
            
        ]);
        
        
        $suggestion = new suggestion();
        $suggestion->nom = $request->name;
        $suggestion->adresse= $request->address;
        $suggestion->longitude = $request->longitude;
        $suggestion->lattitude=$request->lattitude;
        $suggestion->telephone=$request->phone;
        if($request->has('district'))
        $suggestion->quartier=$request->district;
        $suggestion->nom_ville=$request->city;
        $suggestion->user_id=Auth::user()->id;
        $suggestion->save();
        return back()->with(['success' =>'Merci pour votre suggestion']);
    }
    function suggestionList(){
        $suggestions= suggestion::where('status',"Pending")->paginate(10);
        return view("suggestions.list",compact('suggestions'));
    }
    function approuver(Request $request){
        if(!empty($request->suggestion)){
        $suggestion=suggestion::where("idSuggestion",$request->suggestion)->first();
        $suggestion->status="Approved";
        $suggestion->save();
        $city=ville::where("nom",$suggestion->nom_ville)->value('idVille');
        $pharmacie=new pharmacie();
        $pharmacie->nom=$suggestion->nom;
        $pharmacie->adresse=$suggestion->adresse;
        $pharmacie->telephone=$suggestion->telephone;
        $pharmacie->quartier=$suggestion->quartier;
        $pharmacie->lattitude=$suggestion->lattitude;
        $pharmacie->longitude=$suggestion->longitude;
        $pharmacie->ville_id=$city;
        $pharmacie->user_id=Auth::user()->id;
        $pharmacie->save();
        
            return response()->json(['success'=>"approved"]);
        }else{
            return response()->json(['error'=>'something is wrong']);
        }
    
    }
    function desapprouver(Request $request){
        if(!empty($request->suggestion)){
            $suggestion=suggestion::where("idSuggestion",$request->suggestion)->first();
            $suggestion->status="Disapproved";
            $suggestion->save();
            return response()->json(['success'=>"disapproved"]);
        }
    }
    function userList(){
        $userList=suggestion::where('user_id',Auth::user()->id)->paginate(7);
        return view('suggestions.userlist',['list'=> $userList]);
    }
}
