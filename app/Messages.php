<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
        'message_text',"user_id"
    ];
    public function user()
    {
    	return $this->belongsTo("App\User");
    }
}
