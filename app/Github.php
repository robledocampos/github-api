<?php

namespace App;

use App\Libraries\ApiClient;
use Illuminate\Database\Eloquent\Model;

class Github extends Model
{
    const API_URL = "https://api.github.com/users/";

    public static function getUser($user) {
        $apiClient = new ApiClient(self::API_URL, true);
        $result = $apiClient->call($user);

        return $result;
    }

    public static function getUserRepos($user) {
        $apiClient = new ApiClient(self::API_URL, true);
        $result = $apiClient->call($user."/repos?page=1");

        return $result;
    }
}
