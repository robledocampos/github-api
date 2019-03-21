<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\GithubController;

class GithubControllerTest extends TestCase
{
    /**
     * @dataProvider users
     */
    public function testUser($user) {
        $response = Github::getUser($user);

        $this->assertIsArray($response);
        $this->assertIsNumeric($response['code']);
    }

    /**
     * @dataProvider users
     */
    public function testUserRepos($user) {
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
