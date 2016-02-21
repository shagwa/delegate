<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * Get the Reviews on a Specific User
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reviewer() {
        return $this->BelongsTo('App\User', 'reviewer_id');
    }
}
