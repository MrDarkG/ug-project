<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group(function(){
	Route::get('/', function () {
    	return view('chat',["endtime"=>App\Ideas_deadline::first()]);
	});	
	Route::get('/getMessage', function () {
    	return App\Messages::with("user")->get();
	});	
	Route::get('/ideas', function () {
    	/*return App\Ideas::leftJoin("votes","ideas.id","ideas_id")
    	->join("users","users.id","ideas.user_id")
    	->selectRaw("title,ideas.id,count(ideas_id) as count,name")
    	->groupBy("ideas.id")->get();*/
    	$datenow=date("Y-m-d h:i:sa");
    	$expdate=App\Ideas_deadline::firstOrFail();
    	if ($datenow<$expdate["end_date"]) {
    		
    		return App\Ideas::withCount("votes")->with("user")->orderBy("votes_count","DESC")->get();
    	}
    	else{
    		return App\Ideas::withCount("votes")->with("user")->orderBy("votes_count","DESC")->take(3)->get();

    	}
	});	
    Route::middleware(["CheckDate"])->group(function(){

    	Route::post('/messages/store', "CommentController@store");	
    	Route::post('/idea/store', "IdeaController@store");	
    	Route::post('/idea/vote', "IdeaController@vote");	
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
