<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Github;

class GithubTest extends TestCase
{
    /**
     * @dataProvider users
     */
    public function testGetUser($user) {
        $response = Github::getUser($user);

        $this->assertIsArray($response);
        $this->assertIsNumeric($response['code']);
    }

    /**
     * @dataProvider users
     */
    public function testGetUserRepos($user) {
        $response = Github::getUserRepos($user);

        $this->assertIsArray($response);
        $this->assertIsNumeric($response['code']);
    }

    public function users() {
        return [
            ['robledocampos'],
            ['gilbarbara'],
            ['robledocampo']
        ];
    }
}
