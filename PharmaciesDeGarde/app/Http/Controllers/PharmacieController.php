<?php

namespace App\Http\Controllers;

use App\Models\pharmacie;
use App\Models\ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(){
        $pharmacies = pharmacie::all()->where('user_id',Auth::user()->id);;
    }
     public function pharmaciesVille($ville)
    {
        $pharmacies=ville::find($ville)->pharmacies();
    }
    public function pharmaciesProche($ville){
        $pharmacies=ville::find($ville)->pharmacies();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $villes = ville::all();
        return view('pharmacies.create',compact('villes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    $request->validate([
            'name'=> 'required',
            'phone'=>'required',
            'address'=>'required',
            'longitude'=>'required|decimal:2,20',
            'lattitude'=>'required|decimal:2,20',
            'city'=>'required',
            
        ]);
        $city = ville::where('nom',$request->city)->first();
        
        $pharmacie = new pharmacie();
        $pharmacie->nom = $request->name;
        $pharmacie->adresse= $request->address;
        $pharmacie->longitude = $request->longitude;
        $pharmacie->lattitude=$request->lattitude;
        $pharmacie->telephone=$request->phone;
        if($request->has('district'))
        $pharmacie->quartier=$request->district;
        $pharmacie->ville_id=$city->idVille;
        $pharmacie->user_id=Auth::user()->id;
        $pharmacie->save();
        return redirect('/pharmacie/create')->with('success','Pharmacie ajoutée avec succés');
    }

    /**
     * Display the specified resource.
     */
    public function show(pharmacie $pharmacie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pharmacie $pharmacie)
    {
        $pharmacie=pharmacie::with("ville")->find($pharmacie->idPharmacie);
        $villes=ville::all();
        return view('pharmacies.edit',compact('pharmacie','villes'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pharmacie $pharmacie)
    {
        $request->validate([
            'name'=> 'required',
            'phone'=>'required',
            'address'=>'required',
            'longitude'=>'required|decimal:2,20',
            'lattitude'=>'required|decimal:2,20',
            'city'=>'required',
            
        ]);
        
        $pharmacie=pharmacie::where('idPharmacie',$pharmacie->idPharmacie)->first();
        $city = ville::where('nom',$request->city)->first();
        
       
        $pharmacie->nom = $request->name;
        $pharmacie->adresse= $request->address;
        $pharmacie->longitude = $request->longitude;
        $pharmacie->lattitude=$request->lattitude;
        $pharmacie->telephone=$request->phone;
        if($request->has('district'))
        $pharmacie->quartier=$request->district;
        $pharmacie->ville_id=$city->idVille;
        $pharmacie->user_id=Auth::user()->id;
        $pharmacie->save();
        return redirect('/pharmacie/edit/'.$pharmacie->idPharmacie)->with('success','Pharmacie modifiée avec succés');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pharmacie $pharmacie)
    {
        $pharmacie=pharmacie::where('idPharmacie',$pharmacie->idPharmacie)->first();
        $pharmacie->delete();
        return redirect('pharmacie/list');
    }
}
