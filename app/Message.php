<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user(){
        return belongsTo(User::class);
    }

    public function contact(){
        return belongsTo(Contact::class);
    }
    
}
