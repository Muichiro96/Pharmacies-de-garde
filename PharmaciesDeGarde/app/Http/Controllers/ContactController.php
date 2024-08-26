<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;
class ContactController extends Controller
{
    function contact_form(){
        return view('contact');
    }
    function contact_us(Request $request)
    {
         
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required|min:50',
        ]);
        $contact = new contact();
        $contact->nom = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;

        return back()->with(['success' =>'Merci pour votre message']);
    }
}
