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
        $response = GithubController::user($user);

        $this->assertInstanceOf("\Illuminate\Http\Response", $response);
    }

    /**
     * @dataProvider users
     */
    public function testUserRepos($user) {
        $response = GithubController::userRepos($user);

        $this->assertInstanceOf("\Illuminate\Http\Response", $response);
    }

    public function users() {
        return [
            ['robledocampos'],
            ['gilbarbara'],
            ['robledocampo']
        ];
    }
}
