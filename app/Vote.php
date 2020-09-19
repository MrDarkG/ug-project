<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable=[
    	"user_id","ideas_id"
    ];
    public function ideas()
    {
    	return $this->belongsTo("App\Ideas");
    }
}
