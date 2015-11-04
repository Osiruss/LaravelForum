<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProfileRequest;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		var_dump(\Input::all());
		//paginate
		//tiny avatars?
		$this->data['users'] = App\User::all();
		return view('forum.users.index',$this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
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
			$this->data['user'] = App\User::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			\Session::flash('flash_message','User does not exist.');
			return redirect('/');
		}

		$this->data['profile'] = App\User::findOrFail($id)->profile;
		$this->data['post_count'] = App\User::findOrFail($id)->posts()->count();
		$this->data['posts'] = App\User::findOrFail($id)
								->posts()
								->select('posts.*','threads.title')
								->join('threads','threads.id','=','posts.thread_id')
								->orderBy('posts.created_at','desc')
								->limit(5)
								->get();
		return view('forum/users/show',$this->data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if (!\Auth::hasPerm($id)) {
			\Session::flash('flash_message','You do not have permission to edit this profile.');
			return redirect('user/'.$id);
		}

		try {
			$this->data['user'] = App\User::findOrFail($id);
			$this->data['profile'] = App\User::findOrFail($id)->profile;
		} catch (ModelNotFoundException $e) {
			\Session::flash('flash_message','User does not exist.');
			return redirect('/');
		}

		return view('forum.users.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProfileRequest $request, $id)
	{
		$profile = App\User::findOrFail($id)->profile;
		if (!\Auth::hasPerm($id)) {
			\Session::flash('flash_message','You do not have permission to edit this profile.');
			return redirect('user/'.$id);
		}
		if ($request->file('avatar')) {
			//get avatar and reference it
			$file = \Input::file('avatar');

			//filename for resized avatar
			$filename = 'av_'.$id.'.'.$file->getClientOriginalExtension();

			//image instantiations
			$img = \Image::make($file->getRealPath());

			//resize image with aspect ratio constraint
			$img->resize(150,150, function($constraint){
				$constraint->aspectRatio();
				$constraint->upsize();
			});

			//save in avatar directory
			$img->save('img/avatars/'.$filename);

			//destroy source
			$img->destroy();

			//save reference
			$profile->avatar = $filename;
		}

		if($request->bio) {
			$profile->bio = $request->bio;
		}

		$profile->save();
		return redirect('user/'.$id);
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
