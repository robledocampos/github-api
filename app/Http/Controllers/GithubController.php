<?php

namespace App\Http\Controllers;

use App\Github;
use Illuminate\Http\Request;

class GithubController extends Controller
{

    public function user($user){
        header('Content-Type:application/json');
        $response = Github::getUser($user);

        self::buildResponse($response);
    }

    public function userRepos($user){
        header('Content-Type:application/json');
        $response = Github::getUserRepos($user);

        print_r($response); die;
    }

    private static  function buildResponse($response) {

        if (isset($response['body'])) {
            echo (\GuzzleHttp\json_encode($response['body']));
        }
    }
}
