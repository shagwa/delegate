<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;

class UsersController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function profile($user_id = null) {
        if(!is_numeric($user_id) || $user_id < 1) 
            $user_id = Auth::user()->id;
            
        $user = User::find($user_id);
        if($user == null) {
            Session::flash('error', 'Invalid user!');
            return redirect("/");
        }
            
        $reviews = $user->reviews_on;
        
        return view('user.profile', compact('user', 'reviews'));
    }
}
