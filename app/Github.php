<?php

namespace App;

use App\Libraries\ApiClient;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class Github extends Model
{
    const API_URL = "https://api.github.com/users/";
    const REPOS_PER_PAGE = 30;

    /**
     * Retrieves user data from github api
     *
     * @param $user
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getUser($user) {
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        try {
            $result = $client->request('GET', self::API_URL.$user);
        } catch (Exception $exception) {

            return self::buildErrorResponse();
        }
        $response['code'] = $result->getStatusCode();
        if ($response['code'] == 200) {
            $userData = \GuzzleHttp\json_decode($result->getBody());
            $response['body'] = [
                'id' => $userData->id,
                'login' => $userData->login,
                'name' => $userData->name,
                'avatar_url' => $userData->avatar_url,
                'html_url' => $userData->html_url
            ];
        }

        return $response;
    }

    /**
     * Retrieves user's repo list from github api
     *
     * @param $user
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getUserRepos($user) {
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        try {
            $page = 1;
            do {
                $result = $client->request('GET', self::API_URL.$user."/repos", ['query' => ['page' => $page]]);
                $response['code'] = $result->getStatusCode();
                if ($response['code'] == 200) {
                    $repos = \GuzzleHttp\json_decode($result->getBody());
                    if (empty($repos)) {
                        break;
                    } else {
                        foreach ($repos as $repo) {
                            $response['body'][] = [
                                'id' => $repo->id,
                                'name' => $repo->name,
                                'description' => $repo->description,
                                'html_url' => $repo->html_url
                            ];
                        }
                        if (count($repos) < self::REPOS_PER_PAGE) {
                            break;
                        }
                    }
                } else {
                    break;
                }
                $page++;
            } while(true);
        } catch (Exception $exception) {

            return self::buildErrorResponse();
        }

        return $response;
    }

    /**
     * @return mixed
     * @codeCoverageIgnore
     */
    private static function buildErrorResponse() {
        $response['code'] = 500;
        $response['body'] = "Try again later :/";

        return $response;
    }
}
