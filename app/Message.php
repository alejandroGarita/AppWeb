<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user(){
        return belongsTo(User::class);
    }

    public function contact(){
        return $this->belongsTo('App\Contact');
    }

    public function getUrlPath(){
        return \Storage::url($this->path);
    }
    
}
