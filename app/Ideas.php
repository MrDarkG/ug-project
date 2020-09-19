<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ideas extends Model
{
    protected $fillable=[
    	"title","user_id"
   	];
     
    public function user()
    {
        return $this->belongsTo("App\User");
    }
    public function votes(){
        return $this->hasMany("App\Vote");

    }

}
