<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Product;
use Str;

class ProductUnitTest extends TestCase
{
    /**
     * Unit test to test creating a new Product
     *
     * @return void
     * @test
     */
    public function Product_Can_Be_Created()
    {
        $product = factory('App\Product')->create();
        $this->assertInstanceOf(Product::class, $product);
        $this->assertDatabaseHas('products', $product->toArray());
    }

}
