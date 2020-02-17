<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactFormRequest;
use App\Contact;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('contact.index', ['contacts' => Contact::all()]);
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(ContactFormRequest $request)
    {
        $contact = new Contact();

        $contact->dni = $request->get('dni');
        $contact->name = $request->get('name');
        $contact->lastName1 = $request->get('lastName1');
        $contact->lastName2 = $request->get('lastName2');
        $contact->mail = $request->get('mail');

        $contact->save();

        return redirect('/contact/')->with('ok', 'Contacto registrado exitosamente');
    }

    public function show($id)
    {
        return view('contact.show', ['contact' => Contact::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('contact.edit', ['contact' => Contact::findOrFail($id)]);
    }

    public function update(ContactFormRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->dni = $request->get('dni');
        $contact->name = $request->get('name');
        $contact->lastName1 = $request->get('lastName1');
        $contact->lastName2 = $request->get('lastName2');
        $contact->mail = $request->get('mail');

        $contact->update();

        return redirect('/contact/')->with('ok', 'Contacto actualizado exitosamente');;

    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect('/contact/')->with('ok', 'Contacto eliminado exitosamente');;
    }
}
