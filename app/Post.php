<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['thread_id','user_id','post'];
    protected $touches = array('thread');

    /**
     * A post is owned by a user
     *
     * @return  array
     */
    public function author() {
    	return $this->belongsTo('App\User','user_id');
    }

    /**
     * A post belongs inside a thread
     * 
     * @return array
     */
    public function thread() {
    	return $this->belongsTo('App\Thread');
    }
}
