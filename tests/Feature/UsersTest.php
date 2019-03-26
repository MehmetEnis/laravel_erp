<?php

namespace Tests\Feature;

use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * ONLY Admin or Simple Users can create Clients
     *
     * @return void
     * @test
     */
    public function Non_Admin_User_Cannot_See_UserActionLogPage()
    {
        $this->actingAs(factory('App\User')->create());
        $response = $this->get('admin/user_actions');
        $response->assertStatus(401);
    }

    /**
     * ONLY Admin or Simple Users can create Clients
     *
     * @return void
     * @test
     */
    public function Admin_User_Can_See_UserActionLogPage()
    {
        // Only Role 1 / Admin / can visit user_actions
        $this->actingAs(factory('App\User')->make(['role_id' => 1]));
        $response = $this->get('admin/user_actions');
        $response->assertStatus(200);

    }

}