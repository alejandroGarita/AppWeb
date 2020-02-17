<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Contact;

class MessageController extends Controller
{
    
    public function addFiles(){

        return view('message.addFiles', ['messages' => User::findOrFail(auth()->id())->messages]);
    
    }
    public function storageFiles(Request $request){

        $contacts = Contact::all();

        $filesWithoutContact = false;

        foreach($request->file('files') as $file){
            
            // Procesando archivo

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

                        // Crear nuevo mensaje para el contacto
                       
                        $message = new Message();
                        $message->user_id = auth()->id();
                        $message->mailTo = $contact->mail;
                        $message->name = $file->getClientOriginalName();
                        $message->path = $file->store('upload');

                        $message->save();

                    }else $filesWithoutContact = true;

                }else $filesWithoutContact = true;
                

            }
            
        }

        if($filesWithoutContact)
            return redirect('messages/addFiles')->withErrors(['Algunos archivos fueron ignorados por no tener el contacto registrado']);
        else  return redirect('messages/addFiles');
    }

    public function delete($id){
        $message = Message::findOrFail($id);

        $message->delete();

        return redirect('messages/addFiles')->withErrors(['El mensaje se elimino de la cola de envío']);
    }

    public function sendMails(){
        
    }
}
