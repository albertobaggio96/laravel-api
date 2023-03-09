<?php

namespace App\Http\Controllers;

use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{

    public function create(){
        return view('guest.contacts');
    }

    public function store(Request $request){
        $data = $request->validate(
            [
               'name' => 'string|required|min:2|max:50',
               'email' => 'email|required|max:100|min:5',
               'message' => 'required|string|min:10'
            ]

        ); 
        
        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        Mail::to('albi1313@hotmail.it')->send(new NewContact($newLead));
        
        return redirect()->route('guest.contacts.create');
    }
}
