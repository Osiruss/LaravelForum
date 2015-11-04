<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateThreadRequest;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ThreadController extends BaseController
{
   /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create($id)
	{        
		try {
			$this->data['forum_id'] = App\Forum::findOrFail($id)->id;		
		} catch (ModelNotFoundException $e) {
			\Session::flash('flash_message','Forum does not exist');
			return redirect('/');
		}

		return view('forum.threads.create',$this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateThreadRequest $request)
	{
		try {
			App\Forum::findOrFail($request->forum_id);		
		} catch (ModelNotFoundException $e) {
			\Session::flash('flash_message','Forum does not exist');
			return redirect('/');
		}

		// replace non letter or digits with '-'
		$text = preg_replace('~[^\\pL\d]+~u', '-', $request->title);
		// trim
		$text = trim($text, '-');
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// lowercase
		$text = strtolower($text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		$user_id = \Auth::user()->id;
		$thread = App\Thread::create([
			'forum_id'=>$request->forum_id,
			'user_id'=>$user_id,
			'title'=>$request->title,
			'slug'=>$text
			]);

		App\Post::create([
			'user_id'=>\Auth::user()->id,
			'thread_id'=>$thread->id,
			'post'=>$request->post
			]);       

		return redirect('thread/'.$thread->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{		
		try {
			App\Thread::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			return redirect('/');
		}
		
		$this->data['posts'] = App\Thread::findOrFail($id)
						->posts()
						->select('posts.*','threads.forum_id')
						->join('threads','threads.id','=','posts.thread_id')
						->paginate(10);
		foreach ($this->data['posts'] as $post) {
			$post->user = App\Post::findOrFail($post->id)->author;
			$post->user->post_count = App\User::findOrFail($post->user->id)->posts()->count();
		}
		$this->data['forum'] = App\Forum::where('id',$this->data['posts'][0]->forum_id)->first();
		$this->data['thread'] = App\Thread::where('id',$id)->first();
		
		return view('forum.threads.show',$this->data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
