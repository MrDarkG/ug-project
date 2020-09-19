<?php

namespace App\Http\Controllers;
use App\Events\MessagePosted;
use Illuminate\Http\Request;
use App\Messages;
use Auth;
// use App\Events\NewComment;

class CommentController extends Controller
{
  public function index(Post $post)
  {
    return response()->json($post->comments()->with('user')->latest()->get());
  }

  public function store(Request $request)
  {
    $this->validate($request,[
        "message_text"=>"required|string"
      ]);
    $messages = Messages::create([
      "message_text"=>$request->input("message_text"),
      "user_id"=>Auth::user()->id
    ]);

    event(new MessagePosted($messages,Auth::user()));
    return $messages->toJson();
  }
}

