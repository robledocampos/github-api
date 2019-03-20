<?php

namespace App\Http\Controllers;

use App\Github;
use Illuminate\Http\Request;

class GithubController extends Controller
{

    public function user($user){
        $response = Github::getUser($user);

        print_r($response); die;
    }

    public function userRepos($user){
        $response = Github::getUserRepos($user);

        print_r($response); die;
    }
}
