<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrator (can create other users)',],
            ['id' => 2, 'title' => 'Regular user',],

        ];

        foreach ($items as $item) {
            Role::create($item);
        }
    }
}
