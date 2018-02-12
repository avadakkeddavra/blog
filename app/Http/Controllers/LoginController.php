<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;


class LoginController extends Controller
{
	use AuthenticatesUsers;


	public function __construct()
	{
		$this->middleware('guest');
	}	


	public function index()
	{
		return view('login');
	}
	
	public function login($provider)
	{
		$userInfo = Socialite::driver($provider)->user();

		$user = User::firstOrCreate([
			'name' => $userInfo->nickname,
			'email' =>  $userInfo->email,
			'img' => $userInfo->avatar
		]);

		\Auth::loginUsingId($user->id, true);

		return redirect('/feed');
	}

}
