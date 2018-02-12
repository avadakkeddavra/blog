<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts as PostModel;


class PostsController extends Controller
{


	public function __construct()
	{
		$this->middleware('auth');
	}


    public function create(Request $request)
    {
    	$post = PostModel::create([
    		'name' => $request->title,
    		'text' => $request->text,
    		'user_id' => \Auth::user()->id,
    		'img' => $request->img,
    	]);

    	return view('layouts.partials.post',['post' => $post]);
    }

    public function delete(Request $request)
    {
    	$post = PostModel::where('id',$request->id)->first();

    	if(\Auth::user()->id == $post->user_id)
    	{
    		$post->delete();
    		return response()->json(['success' => true]);
    	}else{
    		return response()->json(['success'=>false]);
    	}
    }

    public function upload(Request $request)
    {
            $name = explode('/',$request->file('img')->getClientOriginalName());

            $request->file('img')->move(public_path('img/post_images'), $name[count($name)-1]);

            return response($name[count($name)-1]);
    }

}
