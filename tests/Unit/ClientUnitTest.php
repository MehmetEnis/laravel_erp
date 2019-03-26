<?php

namespace Tests\Unit;

use Tests\TestCase;

class ClientUnitTest extends TestCase
{

    /**
     * Clients can have products
     *
     * @return void
     * @test
     */
    public function Client_Can_Have_Product()
    {
        $client = factory('App\Client')->create();
        $client->customer_product()->sync([61,62,63]);
        $this->assertEquals(3,$client->customer_product()->count());
    }

}