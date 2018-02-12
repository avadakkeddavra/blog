<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments as CommentsModel;

class CommentsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function create(Request $request)
    {
    	$comment = CommentsModel::create([
    		'text' => $request->text,
    		'post_id' => $request->post_id,
    		'user_id' => \Auth::user()->id,
    		'parent_id' => $request->parent_id
    	]);

    	return view('layouts.partials.comment',['comment' => $comment]);
    }
    public function delete(Request $request)
    {
    	$comment = CommentsModel::where('id',$request->id)->first();

    	if(\Auth::user()->id == $comment->user_id)
    	{
    		$comment->delete();
    		return response()->json(['success' => true]);
    	}else{
    		return response()->json(['success'=>false]);
    	}
    }
}
