<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','HomeController@index')->name('home');
Route::get('/feed','HomeController@feed')->name('feed');

Route::get('/auth/{provider}',
    [ 
        '‘as’' => '‘socialite.auth’',
        function ( $provider ) {
            return \Socialite::driver( $provider )->redirect();
        }
    ]
);
Route::get('/auth/{provider}/callback','LoginController@login');

Route::get('/login','LoginController@index')->name('login');

Route::get('/logout',function(){
	\Auth::logout();
	return redirect('login');
});


Route::post('/post/create',"PostsController@create")->name('post.create');
Route::post('/post/delete',"PostsController@delete")->name('post.delete');
Route::post('/post/count','HomeController@ajaxGetNewPostsCount')->name('count');
Route::post('/post/loadmore','HomeController@loadmore')->name('loadmore');
Route::post('/feed/uploadNew','HomeController@uploadNewPosts')->name('new.posts');

Route::post('/post/upload',"PostsController@upload")->name('post.upload');
Route::post('/comments/create','CommentsController@create')->name('comment.create');
Route::post('/comments/delete','CommentsController@delete')->name('comment.delete');
