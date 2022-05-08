<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function create()
    {

        return view('iletisim');
    }

    public function store(Contact $contact)
    {
        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'subject'    => 'nullable|min:5|max:50',
            'message'    => 'required|min:5|max: 500'
        ]);

        Contact::create($attributes);
        Mail::to('bicakcioguz@gmail.com')->send(new \App\Mail\ContactMail(
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['email'],
            $attributes['subject'],
            $attributes['message']
        ));
        return redirect()->route('iletisim')->with('succes', 'Mesajınız Başarıyla iletilmiştir.');
    }
}
