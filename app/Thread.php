<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['forum_id','user_id','title','slug'];

    /**
     * A thread is owned by a user
     * 
     * @return array
     */
    public function author() {
    	return $this->belongsTo('App\User','user_id');
    }

    /**
     * A thread has many posts
     * 
     * @return array
     */
    public function posts() {
    	return $this->hasMany('App\Post');
    }

}
