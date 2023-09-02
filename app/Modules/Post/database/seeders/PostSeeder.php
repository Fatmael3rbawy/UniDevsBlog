<?php

use Illuminate\Database\Seeder;
use Modules\Post\Models\Post;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();

        Post::create([
            'title' => 'First Post',
            'content' => 'This post is about programming',
           'uuid' => DB::raw('(UUID())') ,
           'created_by' => \Modules\User\Models\User::all()->random()->id,
        ]);
    }
}
