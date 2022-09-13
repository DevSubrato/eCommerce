<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
 

class GithubController extends Controller
{
    public function github_redirect()
    {
        return Socialite::driver('github')->redirect();
    }
    public function github_callback()
    {
        $user = Socialite::driver('github')->user();
        print_r($user);
    }

}
