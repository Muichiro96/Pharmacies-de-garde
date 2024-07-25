<?php

namespace App\Http\Controllers;

use App\Models\garde;
use Illuminate\Http\Request;
use App\Models\pharmacie;

class GardeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $gardes=garde::paginate(10);
        return view('gardes.list',compact('gardes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $pharmacies=pharmacie::all();
       return view('gardes.create',compact('pharmacies'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type'=> 'required',
            'date'=>'required',
            'pharmacies'=>'required|array',
            
            
        ]);
        $garde = new garde();
        $garde->type = $request->type;
        $garde->date = $request->date;
        
        $garde->save();

        foreach( $request->pharmacies as $pharmacie){
            $ph = pharmacie::where('nom',$pharmacie)->first();
        
                $garde->pharmacies()->attach($ph->idPharmacie);
           
        }
       return redirect('/garde/add')->with('success','Garde ajoutée avec succés');
    }
    public function gardesParDate(Request $request){
        if(!empty($request->date)){
            $gardes = garde::where('date','=',$request->date)->get();
            $html="";
            foreach($gardes as $garde){
                $html.='<div class="row">
    
                <div class="col">
                <div class="card">
                    <div class="card-body">
                <h3 class="text-danger">
                   <i class="fas fa-shield-alt"></i> Garde
                </h3>
                
                <label><i class="fas fa-list"></i> &emsp;Type :</label>&emsp; ';
                 if($garde->type=="Jour") 
                 $html.=$garde->type.'
                <i class="fas fa-sun text-warning"></i>';
                elseif($garde->type=='Nuit')
                $html.=$garde->type.'
                <i class="fas fa-moon"></i>';
                else
                $html.='<span class="right badge badge-success">24h/24</span>';
              
                $html.='<br/>
                
                <label><i class="fas fa-calendar-day"></i> &emsp;Date : </label> &emsp;'.$garde->date.' 
                <br/><i class="fas fa-hospital"></i>&emsp;<label>Pharmacies :</label>&emsp;   <div class="select2-success" style="display:inline;">
                                <select  class=" pharmacies form-control select2 select2-hidden-accessible"  multiple=""  data-dropdown-css-class="select2-success" style="width: 100%;"  tabindex="-1" aria-hidden="true" disabled>';
                                foreach($garde->pharmacies as $pharmacie){
                                    $html.='<option selected>'. $pharmacie->nom.'</option>';
                                }
                                $html.='</select>
                                </div>
                <br/>
                </div>
                <div class="card-footer">
                <a href="/garde/delete/'.$garde->idGarde.'"><button  class="btn btn-danger float-right"><i class="fas fa-trash"></i></button></a>
                <a href="/garde/edit/'.$garde->idGarde.'"><button  class="btn btn-warning float-right mr-4"><i class="fas fa-pen"></i></button></a>
                
                </div>
                </div>
                </div></div>';
            }
            return response()->json(['gardes' => $html]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(garde $garde)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(garde $garde)
    {
        $excludedPharmacies=[];
        foreach($garde->pharmacies as $pharmacie){
            $excludedPharmacies[]=$pharmacie->nom;
        }
        $pharmacies=pharmacie::whereNotIN('nom',$excludedPharmacies)->get();
        return view("gardes.edit",compact('garde','pharmacies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, garde $garde)
    {
        
        $request->validate([
            'type'=> 'required',
            'date'=>'required',
            'pharmacies'=>'required|array',
            
            
        ]);
        $garde->pharmacies()->sync([]);
        $garde->type = $request->type;
        $garde->date = $request->date;
        
        $garde->save();

        foreach( $request->pharmacies as $pharmacie){
            $ph = pharmacie::where('nom',$pharmacie)->first();
        
                $garde->pharmacies()->attach($ph->idPharmacie);
           
        }
        return redirect('/garde/edit/'.$garde->idGarde)->with('success','Garde modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(garde $garde)
    {
        $garde->delete();
        return redirect('garde/list');
    }
}
