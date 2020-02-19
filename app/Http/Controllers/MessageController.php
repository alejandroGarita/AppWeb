<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

        $user = User::findOrFail(auth()->id());
        $contacts = $user->contacts;

        if($contacts->count() > 0)
            return view('message.addFiles', ['messages' => User::findOrFail(auth()->id())->messages]);
        else return redirect('contact/')->withErrors(['Agregue algún contacto antes de seleccionar los archivos']);
    
    }
    public function storageFiles(Request $request){

        $user = User::findOrFail(auth()->id());
        $contacts = $user->contacts;
        
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
            return redirect('messages/addFiles')->withErrors([ 'Upps! ' . $filesWithoutContact . ' archivo(s) fueron ignorados por no tener el contacto registrado']);
        else  return redirect('messages/addFiles')->with('ok', 'Archivos subidos exitosamente');
    }

    public function deleteMessage($messageToDelete){
        $messages = Message::all();

        $duplicate = false;

        foreach($messages as $message){

            if($message->name == $messageToDelete->name && $message->id != $messageToDelete->id){
                $duplicate = true;
            }
        }
        
        // Delete file if not used with another message
        if($duplicate == false){
            unlink($messageToDelete->getPath());
        }

        $messageToDelete->delete();
    }

    public function delete($id){
        
        $this->deleteMessage(Message::findOrFail($id));

        return redirect('messages/addFiles')->with('ok', 'El mensaje se eliminó de la cola de envío');
    }

    public function sendMails(){

        $user = User::findOrFail(auth()->id());
        $messages = $user->messages;

        foreach($messages as $message){
            
            //require '../vendor/autoload.php';	

            $mail = new PHPMailer(true); // Passing `true` enables exceptions

			try {
				// Server settings
	    	    $mail->SMTPDebug = 0; // Enable verbose debug output
				$mail->isSMTP(); // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';	// Specify main and backup SMTP servers
				$mail->SMTPAuth = true; // Enable SMTP authentication
				$mail->Username = 'appweb.laravel@gmail.com'; // SMTP username
				$mail->Password = 'miyvmophdypcfhyj'; // SMTP password
				$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587; // TCP port to connect to

                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
				//Recipients
				$mail->setFrom('appweb.laravel@gmail.com', 'Admin');
				$mail->addAddress($message->contact->mail, $message->contact->name);// Add a recipient
				$mail->addReplyTo('appweb.laravel@gmail.com', 'Admin');

				//Attachments (optional)
				$mail->addAttachment($message->getPath(), $message->name); // Add attachments

				//Content
				$mail->isHTML(true); // Set email format to HTML
				$mail->Subject = 'Envio de comprobantes';
				$mail->Body = 'Por favor no responda a este correo.'; // message

				$mail->send();
                
			} catch (Exception $e) {
				return redirect('messages/addFiles')->withErrors('No se pudieron enviar los correos.');
			}

                // End of PHPMailer

                // Delete message file

                $this->deleteMessage($message);

        }

        return redirect('messages/addFiles')->with('ok', 'Los mensajes se enviaron correctamente');
    }

    // Delete all messages of an user
    public function clear(){
        $messages = User::findOrFail(auth()->id())->messages;

        foreach($messages as $message){
            $this->deleteMessage($message);
        }
        return redirect('messages/addFiles')->with('ok', 'La cola de envío se vació correctamente');
    }


}
