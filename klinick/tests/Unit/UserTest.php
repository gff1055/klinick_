<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\UsersController;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_if_only_users_logged_can_access_delete_link(){
		$response = $this->get('/user/settings/auth_data')->assertRedirect('/login');
		$response = $this->get('/user/settings/delete')->assertRedirect('/login');
    }
}
