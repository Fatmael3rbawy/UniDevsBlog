<?php

namespace Database\Seeders;

use CommentSeeder;
use Illuminate\Database\Seeder;
use Modules\User\Models\User;
use PostSeeder;
use UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //    User::factory(5)->create();

    $this->call(UserSeeder::class);
    $this->call(PostSeeder::class);
    $this->call(CommentSeeder::class);


    }
}
