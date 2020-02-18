<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;

    // Return all the messages of a contact
    public function messages(){
        return $this->hasMany('App\Message');
    }

    // Return the user to whom the contact belongs
    public function user(){
        return $this->belongsTo('App\User');
    }
}
