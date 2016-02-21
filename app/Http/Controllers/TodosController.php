<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Todo;
use App\Tag;
use App\Offer;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

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
}
