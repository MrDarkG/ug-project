<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ideas;
use App\Vote;
use App\Events\NewLike;

use Auth;
use App\Events\IdeaPosted;

class IdeaController extends Controller
{
	public function index()
	{
		
	}
    public function store(Request $requst)
    {
    	$this->validate($requst,[
    		"title"=>"required|string"
    	]);

    	$idea=Ideas::create([
    		"title"=>$requst->input("title"),
    		"user_id"=>Auth::id(),
    	]);
    	event(new IdeaPosted($idea,Auth::user()));
    	return $idea->toJson();
    }
    public function vote(Request $requst)
    {
    	$this->validate($requst,[
    		"id"=>"required|integer"
    	]);
        $filter=[
                ["ideas_id",$requst->input("id")],
                ["user_id",Auth::id()]
            ];
        //check if user has voted
        $voted=Vote::where($filter)->count();
        if ($voted) {
            $votes=Vote::where($filter)->delete();
        }
        else{
        	$votes=Vote::create([
        		"ideas_id"=>$requst->input("id"),
        		"user_id"=>Auth::id()
        	]);
        }
        // retrive data with new likes
        //$newstats=Ideas::withCount("votes")->with("user")->get();
        event(new NewLike($votes));
        if ($voted) {
            return ["message"=>"unliked","status"=>0];
        }
        else{
            return ["message"=>"liked","status"=>1];

        }

    }
}
