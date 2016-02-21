<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Todo extends Model
{
    
    public function scopeNewsfeed($query) {
        return $query->whereRaw("status = '1'");
    }
    
    public function scopeMytodos($query) {
        return $query->whereRaw("owner_id = '".Auth::user()->id."' AND status = '1'");
    }
    
    public function scopeMyjobs($query) {
        return $query->whereRaw("provider_id = '".Auth::user()->id."' AND status = '1'");
    }
    
    public function provider() {
        return $this->belongsTo('App\User', 'provider_id');
    }
    
    public function owner() {
        return $this->belongsTo('App\User', 'owner_id');
    }
    
    public function tags() {
        return $this->belongsToMany('App\Tag', 'todos_tags', 'todo_id', 'tag_id');
    }
    
    public function offers() {
        return $this->belongsToMany('App\User', 'offers', 'todo_id', 'provider_id');
    }
}
