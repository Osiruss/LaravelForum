<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends BaseController
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
			$this->data['thread'] = App\Thread::findOrFail($id);		
		} catch (ModelNotFoundException $e) {
			\Session::flash('flash_message','Thread does not exist');
			return redirect('/');
		}
		
		return view('forum.posts.create',$this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PostRequest $request)
	{
		try {
			App\Thread::findOrFail($request->thread_id);
		} catch (ModelNotFoundException $e) {
			\Session::flash('flash_message','Thread does not exist');
			return redirect('/');
		}
		App\Post::create([
			'user_id'=>\Auth::user()->id,
			'thread_id'=>$request->thread_id,
			'post'=>$request->post
			]);
		return redirect('thread/'.$request->thread_id);
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
			App\Post::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			return redirect('/');
		}
		
		$this->data['post'] = App\Post::where('posts.id',$id)
							->join('users','users.id','=','posts.user_id')
							->join('threads','threads.id','=','posts.thread_id')
							->select('users.username','posts.*','users.created_at as user_join','threads.title')
							->first();
		return view('forum.posts.show',$this->data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$this->data['post'] = App\Post::findOrFail($id);
		$this->data['thread'] = App\Thread::findOrFail($this->data['post']->thread_id);

		if (!\Auth::hasPerm($this->data['post']->user_id)) {
			\Session::flash('flash_message', 'You do not have permission to edit this post.');
			return redirect('thread/'.$this->data['post']->thread_id);
		}

		return view('forum.posts.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(PostRequest $request, $id)
	{
		$post = App\Post::where('id',$id)->first();
		
		if (!\Auth::hasPerm($post->user_id)) {
			\Session::flash('flash_message', 'You do not have permission to edit this post.');
			return redirect('thread/'.$this->data['post']->thread_id);
		}

		$post->post = $request->post;
		$post->save();
		return redirect('thread/'.$post->thread_id);
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
