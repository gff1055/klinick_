<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\User;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	public function test_if_users_not_logged_in_are_redirected_to_the_login_route(){

		$response = $this->get('/user/settings/delete')->assertRedirect('/login');
	
	}


	public function test_if_users_logged_in_can_access_the_delete_link(){

		$user = factory(User::class)->create();

		$response = $this->actingAs($user)->get('/user/settings/delete')->assertStatus(200);
		$response = $this->actingAs($user)->delete("/user/delete")->assertStatus(200);
	
	}

}
