<?php

namespace App\Http\Controllers;

use App\Github;
use Illuminate\Http\Request;

class GithubController extends Controller
{

    public function user($user){
        $response = Github::getUser($user);

        return self::buildResponse($response);
    }

    public function userRepos($user){
        $response = Github::getUserRepos($user);

        return self::buildResponse($response);
    }

    private static  function buildResponse($response) {
        $response['body'] = isset($response['body']) ? \GuzzleHttp\json_encode($response['body']) : "";

        return response($response['body'], $response['code'])
            ->header('Content-Type', 'application/json');
    }
}
