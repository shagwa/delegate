<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'dob', 'contacts', 'location', 'gender'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Get the User's reviews on
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews_on() {
        return $this->hasMany('App\Review', 'reviewed_id');
    }
    
    public function scopeAllchatwith($query) {
        return $query->whereRaw("id IN () = '".Auth::user()->id."' AND status = '1'")
        ->join('contacts', function($join)
        {
            $join->on('users.id', '=', 'message.from_user_id')
                 ->whereRaw("messages.to_user_id = '".Auth::user()->id."'");
        });
    }
}
