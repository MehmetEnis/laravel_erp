<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Str;

class UserUnitTest extends TestCase
{
    /**
     * Unit test to test creating a new User
     *
     * @return void
     * @test
     */
    public function User_Can_Be_Created()
    {
        $user = factory('App\User')->create();
        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', $user->toArray());
    }

}
