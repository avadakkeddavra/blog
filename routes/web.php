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

ROute::get('/','HomeCOntroller@inedx')->name('home');