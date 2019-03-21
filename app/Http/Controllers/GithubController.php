<?php

namespace App\Http\Controllers;

use App\Github;
use Illuminate\Http\Request;

class GithubController extends Controller
{

    /**
     * @param $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public static function user($user){
        $response = Github::getUser($user);

        return self::buildResponse($response);
    }

    /**
     * @param $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public static function userRepos($user){
        $response = Github::getUserRepos($user);

        return self::buildResponse($response);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @codeCoverageIgnore
     */
    public static function methodNotAllowed() {

        return response("", 405);
    }

    /**
     * @param $response
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @codeCoverageIgnore
     */
    private static function buildResponse($response) {
        $response['body'] = isset($response['body']) ? \GuzzleHttp\json_encode($response['body']) : "";

        return response($response['body'], $response['code'])
            ->header('Content-Type', 'application/json');
    }
}
