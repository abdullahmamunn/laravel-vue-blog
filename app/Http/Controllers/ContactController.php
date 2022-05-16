<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
         ]);

        //$agent = new Agent;

        Contact::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'message'  => $request->message,
            //'os'       => $agent->platform(),
            'ip'       => request()->ip(),
            //'device'   => $agent->device(),
            //'browser'  => $agent->browser(),
        ]);
    }
}
