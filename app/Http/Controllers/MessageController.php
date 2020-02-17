<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\MessageMail;

use App\User;
use App\Message;
use App\Contact;

class MessageController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addFiles(){

        $contacts = Contact::all();

        if($contacts->count() > 0)
            return view('message.addFiles', ['messages' => User::findOrFail(auth()->id())->messages]);
        else return redirect('contact/')->withErrors(['Agregue algún contacto antes de seleccionar los archivos']);
    
    }
    public function storageFiles(Request $request){

        $contacts = Contact::all();
        $filesWithoutContact = 0;

        foreach($request->file('files') as $file){
            
            // Procesando archivo
            $contactsForFile = 0;

            $array = explode("-", $file->getClientOriginalName());

            if(isset($array[1])){
                $name = $array[0];
                $lastName =  explode(".", $array[1])[0];
            }else{
                $name = explode(".", $array[0])[0];
                $lastName = '';
            }

            // Verificar si el nombre del contacto coincide con el archivo

            foreach($contacts as $contact){

                if(strtolower($contact->name) == strtolower($name)){

                    if($lastName == '' || strtolower($lastName) == strtolower($contact->lastName1)){

                        $contactsForFile++;

                        // Crear nuevo mensaje para el contacto
                       
                        $message = new Message();
                        $message->user_id = auth()->id();
                        $message->contact_id = $contact->id;
                        $message->name = $file->getClientOriginalName();
                        $message->path = $file->store('public');

                        $message->save();

                    }

                }
            }

            if($contactsForFile == 0)
                $filesWithoutContact++;

        }

        if($filesWithoutContact != 0)
            return redirect('messages/addFiles')->withErrors([ 'Upps! ' . $filesWithoutContact . ' archivos fueron ignorados por no tener el contacto registrado']);
        else  return redirect('messages/addFiles')->with('ok', 'Archivos subidos exitosamente');
    }

    public function delete($id){
        $message = Message::findOrFail($id);

        $message->delete();

        return redirect('messages/addFiles')->with('ok', 'El mensaje se eliminó de la cola de envío');
    }

    public function sendMails(){

        $messages = Message::all();

        foreach($messages as $message){
            
            try{
                Mail::to($message->contact->mail)->send(new MessageMail($message));

                $message->delete();
            }catch(Exeption $e){
                return redirect('messages/addFiles')->withErrors(['El archivo ' . $message->name . ' no se pudo enviar correctamente, la cola de envío se detuvo' ]);
            }
        }

        return redirect('messages/addFiles')->with('ok', 'Los mensajes se enviaron correctamente');
    }

    public function clear(){
        $messages = Message::all();

        foreach($messages as $message){
            $message->delete();
        }

        return redirect('messages/addFiles')->with('ok', 'La cola de envío se vació correctamente');
    }


}
