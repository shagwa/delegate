<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    
    public function scopeInbox($query) {
        return $query->whereRaw("from_user_id = '".Auth::user()->id."' OR to_user_id = '".Auth::user()->id."'");
    }
    
    public function sender() {
        return $this->belongsTo('App\User', 'from_user_id');
    }
    
    public function receiver() {
        return $this->belongsTo('App\User', 'to_user_id');
    }
}