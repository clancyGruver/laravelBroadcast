<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUS;
use Mail;

class SpaController extends Controller
{
    public function index()
    {
        return view('spa');
    }

    public function sendmessage(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
    
        ContactUS::create($request->all());

        Mail::send('layouts.email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ), function($message)
        {
            $address = 'cuksmail@gmail.com';    
            $name = 'Evgenyi';    
            $subject = 'Email по Скрапу';    
            $message    
                ->from($address, $name)    
                ->subject($subject);
        });

        return back()->with('success', 'Спасибо, что написали нам!');
    }
}