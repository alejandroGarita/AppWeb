<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactFormRequest;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index', ['contacts' => Contact::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactFormRequest $request)
    {
        $contact = new Contact();

        $contact->dni = $request->get('dni');
        $contact->name = $request->get('name');
        $contact->lastName1 = $request->get('lastName1');
        $contact->lastName2 = $request->get('lastName2');
        $contact->mail = $request->get('mail');

        $contact->save();

        return redirect('/contact/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('contact.edit', ['contact' => Contact::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactFormRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->dni = $request->get('dni');
        $contact->name = $request->get('name');
        $contact->lastName1 = $request->get('lastName1');
        $contact->lastName2 = $request->get('lastName2');
        $contact->mail = $request->get('mail');

        $contact->update();

        return redirect('/contact/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
