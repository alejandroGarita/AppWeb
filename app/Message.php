<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Return the user to whom the message belongs
    public function user(){
        return belongsTo(User::class);
    }

    // Return the contact to whom the message belongs
    public function contact(){
        return $this->belongsTo('App\Contact');
    }

    public function getUrlPath(){
        return \Storage::url($this->path);
    }
    
}
