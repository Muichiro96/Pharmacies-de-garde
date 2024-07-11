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
        $gardes=garde::all();
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
       return redirect('/pharmacie/garde/add')->with('success','Garde ajoutée avec succés');
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
        //
    }
}
