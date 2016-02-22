<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Todo;
use App\Tag;
use App\Offer;
use App\Review;
use App\Message;
use App\User;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;
use Session;

class TodosController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $news_feed = Todo::latest()->newsfeed()->get();
    	
    	return view('todos.index', compact('news_feed'));
    }
    
    public function search(Request $request) {
        $query = $request->input("search_word");
        $sql = "todo LIKE '%".$query."%' OR location LIKE '%".$query."%' OR benefit LIKE '%".$query."%' OR owner_id IN (SELECT id FROM users WHERE first_name LIKE '%".$query."%' OR last_name LIKE '%".$query."%') OR provider_id IN (SELECT id FROM users WHERE first_name LIKE '%".$query."%' OR last_name LIKE '%".$query."%')";
        $news_feed = Todo::latest()->whereRaw($sql)->get();
    	
    	return view('todos.searchresult', compact('news_feed', 'query'));
    }
    
    public function mytodos() {
        $mytodos = Todo::latest()->mytodos()->get();
    	
    	return view('todos.mytodos', compact('mytodos'));
    }
    
    public function myjobs() {
        $myjobs = Todo::latest()->myjobs()->get();
    	
    	return view('todos.myjobs', compact('myjobs'));
    }
    
    public function create() {
        return view('todos.create');
    }

    public function store(TodoRequest $request) {
        $todo = new Todo;
        $todo->todo = $request->input('todo');
        $todo->todo_time = $request->input('todo_time');
        $todo->benefit = $request->input('benefit');
        $todo->location = $request->input('location');
        $todo->owner_id = Auth::user()->id;
        $todo->is_price = ($request->input('is_price') == 1) ? 1 : 0;

        $todo->save();
        
        $tags_ids = array();
        $tags = explode(',', $request->input('tags'));
        foreach($tags as $tag_name) {
            $tag_name = trim($tag_name);
            $tag = Tag::whereRaw("name = '".$tag_name."'")->first();
            if($tag == null) {
                $tag = new Tag;
                $tag->name = $tag_name;
                $tag->save();
            }
            $tags_ids[] = $tag->id;
        }
        
        $todo->tags()->sync($tags_ids);
            
        return redirect('/todos');
    }
    
    public function offer($todo_id) {
        $offer = new Offer;
        $offer->provider_id = Auth::user()->id;
        $offer->todo_id = $todo_id;
        
        $offer->save();
            
        return redirect('/');
    }
    
    public function review(ReviewRequest $request) {
        $review = new Review;
        $review->review = $request->input('review');
        $review->rate = $request->input('rate');
        $review->reviewed_id = $request->input('user_id');
        $review->reviewer_id = Auth::user()->id;

        $review->save();
        
        $todo = Todo::find($request->input('todo_id'));
        $todo->progress = "finished";

        $todo->save();
            
        return redirect('/todos');
    }
    
    public function accept_offer($todo_id, $provider_id) {
        $todo = Todo::find($todo_id);
        $todo->provider_id = $provider_id;
        $todo->progress = "started";
        
        $todo->save();
        
        $provider = User::find($provider_id);
        
        $message = new Message;
        $message->message = "This is an automated message from the System, Contacts of '".$provider->first_name." ".$provider->last_name."' are : <br />".$provider->contacts;
        $message->from_user_id = $provider->id;
        $message->to_user_id = Auth::user()->id;
        $message->save();
        
        $message = new Message;
        $message->message = "This is an automated message from the System, Congratulations, you won the job '".$todo->todo."'. Contacts of '".Auth::user()->first_name." ".Auth::user()->last_name."' are : <br />".Auth::user()->contacts;
        $message->to_user_id = $provider->id;
        $message->from_user_id = Auth::user()->id;
        $message->save();
            
        Session::flash('success', 'Contacts have been shared, Please check your inbox.');
        return redirect('/todos');
    }
}
