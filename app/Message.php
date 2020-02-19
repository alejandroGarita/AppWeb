<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        return Storage::url($this->path);
    }

    public function getPath(){
        return 'storage/' . explode('/', $this->path)[1];
    }
    
}
