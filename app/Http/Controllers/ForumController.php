<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ForumController extends BaseController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$forum_groups = App\Forum_group::all();
		$forums = App\Forum::all();

		foreach ($forum_groups as $group) {
			$arr = [];
			foreach ($forums as $forum) {
				if ($group->id == $forum->forum_group_id) {
					$arr[] = $forum;
				}
			}
			$group->forums = $arr;
			foreach ($group->forums as $forum) {
				$forum->post_count = App\Post::join('threads','threads.id','=','posts.thread_id')
											->join('forums','threads.forum_id','=','forums.id')
											->where('threads.forum_id','=',$forum->id)
											->count();
				$forum->thread_count = App\Thread::where('forum_id','=',$forum->id)->count();

				$forum->latest = App\Post::select('users.username','posts.*','threads.title')
										->join('threads','threads.id','=','posts.thread_id')
										->join('forums','threads.forum_id','=','forums.id')
										->join('users','users.id','=','posts.user_id')
										->where('forums.id','=',$forum->id)
										->orderBy('posts.created_at','desc')
										->first();
			}
		}

		$this->data['forum_groups'] = $forum_groups;
		return view('forum.index', $this->data);
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
			App\Forum::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			return redirect('/');
		}
		
		$this->data['threads'] = App\Thread::where('threads.forum_id','=',$id)
							->join('users','users.id','=','threads.user_id')
							->select('users.username','threads.*')
							->orderBy('threads.updated_at','desc')
							->paginate(15);

		foreach ($this->data['threads'] as $thread) {
			$thread->latest = App\Post::where('posts.thread_id','=',$thread->id)
									->orderBy('posts.id','desc')
									->join('users','users.id','=','posts.user_id')
									->first();
			foreach ($this->data['threads'] as $thread) {
				$thread->post_count = App\Post::where('posts.thread_id','=',$thread->id)
											->count();
			}
		}
		$this->data['forum'] = App\Forum::findOrFail($id);

		return view('forum.show',$this->data);
	}

}
