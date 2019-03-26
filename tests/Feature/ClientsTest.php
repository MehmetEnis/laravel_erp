<?php

namespace Tests\Feature;

use Tests\TestCase;

class ClientsTest extends TestCase
{
    /**
     * ONLY Admin or Simple Users can create Clients
     *
     * @return void
     * @test
     */
    public function Non_Authenticated_User_Cannot_Create_Client()
    {
        $this->actingAs(factory('App\User')->create());
        $client = factory('App\Client')->make();
        $response = $this->post('admin/clients',$client->toArray());
        $response->assertStatus(401);
    }

    /**
     * ONLY Admin or Simple Users can create Clients
     *
     * @return void
     * @test
     */
    public function Authenticated_User_Can_Create_Client()
    {
        // Role 2 will also create, but not 3 or 4 ....
        $this->actingAs(factory('App\User')->make(['role_id' => 1]));
        $client = factory('App\Client')->make();
        $response = $this->post('admin/clients',$client->toArray());
        $response->assertStatus(302);
        $response->assertRedirect('admin/clients/');
        $this->assertDatabaseHas('clients', $client->toArray());
    }
}
