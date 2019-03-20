<?php

namespace App;

use App\Libraries\ApiClient;
use Illuminate\Database\Eloquent\Model;

class Github extends Model
{
    const API_URL = "https://api.github.com/users/";

    public static function getUser($user) {
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $result = $client->request('GET', self::API_URL.$user);

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

    public static function getUserRepos($user) {
        $apiClient = new ApiClient(self::API_URL, true);
        $result = $apiClient->call($user."/repos?page=1");

        return $result;
    }
}
