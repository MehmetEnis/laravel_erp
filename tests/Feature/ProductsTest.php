<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * Simple User can create a product
     *
     * @return void
     * @test
     */
    public function User_Can_Create_Product()
    {
        $this->actingAs(factory('App\User')->make(['role_id' => 1]));
        $product = factory('App\Product')->make();
        $response = $this->post('admin/products',$product->toArray());
        $response->assertStatus(302);
        $this->assertDatabaseHas('products', $product->toArray());
    }
}
