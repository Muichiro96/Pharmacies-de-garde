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
        $pharmacies = pharmacie::paginate(9);
        $villes=ville::all();
        return view('pharmacies.list',compact('pharmacies','villes'));
    }
     public function pharmaciesVille(Request $request)
    {

            if(!empty($request->id)){
                $pharmacies=ville::find($request->id)->pharmacies;
                $html="";
                foreach($pharmacies as $pharmacie){
                    $html.='<div class="row">
    
<div class="col">
<div class="card" style="height: 230px">
    <div class="card-body">
<h3 class="text-success">
   <i class="fas fa-hospital"></i> '.$pharmacie->nom.'
</h3>

<i class="fas fa-building"></i> &emsp;<label>Adresse :</label>&emsp; '.$pharmacie->adresse.'
<br/>
<i class="fas fa-phone-alt"></i>&emsp;<label>Téléphone :</label>&emsp;'.$pharmacie->telephone.'
<br/>
<label><i class="fas fa-map-marker text-danger"></i> &emsp;Lattitude : </label> &emsp;'.$pharmacie->lattitude.' , &emsp;<label>Longitude :</label>&emsp; '.$pharmacie->longitude.' 
<br/><div class="float-right"><label>Ville :</label>&emsp; '.$pharmacie->ville->nom.'</div>
</div>
<div class="card-footer">
<a href="/pharmacie/delete/'.$pharmacie->idPharmacie.'"><button  class="btn btn-danger float-right"><i class="fas fa-trash"></i></button></a>
<a href="/pharmacie/edit/'.$pharmacie->idPharmacie.'"><button  class="btn btn-warning float-right mr-4"><i class="fas fa-pen"></i></button></a>

</div>
</div>
</div></div>';
                 } 
            return response()->json(['request'=>$html]);
            }else{
                return response()->json(['error'=>'something is wrong']);
            }
    }
    /**public function pharmaciesProche($ville){
       * $pharmacies=ville::find($ville)->pharmacies();
    }*/

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
        return redirect('/pharmacie/add')->with('success','Pharmacie ajoutée avec succés');
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
        
        $pharmacie->delete();
        return redirect('pharmacie/list');
    }
}
