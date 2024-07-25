<?php

namespace App\Http\Controllers;
use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $users=User::paginate(20);
        return view('users.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 
        $isAdmin=$request->has('isAdmin');
        $user->isAdmin= $isAdmin;
        $user->save();
        

        return redirect('/user/add')->with('success',"Utilisateur ajouté avec succés");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        
        return view('users.edit',compact('user'));
    
      }  
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',
        ]);

        
        $user->name = $request->name;
        $user->email = $request->email;
        if(empty($request->password)){
        
        
    }else{
        $user->password = Hash::make($request->password);
    }
        $isAdmin=$request->has('isAdmin');
        $user->isAdmin= $isAdmin;
        $user->save();
        

        return redirect('/user/edit/'.$user->id)->with('success',"Utilisateur modifié avec succés");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('user/list');
    }
}
