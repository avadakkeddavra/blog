<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts as PostModel;
use App\Comments as CommentModel;

class HomeController extends Controller
{
    

    public function index()
    {

    	if(\Auth::guest())
    	{
    		return redirect('login');
    	}
		
		$posts = \Auth::user()->posts()->take(10)->orderBy('created_at','DESC')->get();  

	   	return view('home',['posts' => $posts]);
    }

    public function feed()
    {

		$posts = PostModel::take(10)->orderBy('created_at','DESC')->get();  

	   	return view('feeds',['posts' => $posts]);
    }

    public function ajaxGetNewPostsCount(Request $request)
    {
    	$posts = PostModel::where('created_at','>',$request->id)->count();

    	return response(['count' => $posts]);
    }

    public function uploadNewPosts(Request $request)
    {
        $posts = PostModel::where('created_at','>',$request->id)->get();

        return view('layouts.partials.posts',['posts' => $posts]);
    }

    public function loadmore(Request $request)
    {
        if($request->type == 'feed')
        {
            $posts = PostModel::where('created_at','<',$request->id)->take(10)->orderBy('created_at','DESC')->get();   
        }else{

            $posts = PostModel::where('created_at','<',$request->id)->where('user_id',\Auth::user()->id)->take(10)->orderBy('created_at','DESC')->get();
        }

        return view('layouts.partials.posts',['posts' => $posts]);
    }
}
