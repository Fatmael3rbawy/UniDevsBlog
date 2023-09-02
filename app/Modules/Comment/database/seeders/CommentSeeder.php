<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Modules\Comment\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('comments')->delete();
        
        //create comment on a post
        Comment::create([
            'content' => 'Great post',  
            'created_by' => \Modules\User\Models\User::all()->random()->id,
            'post_id' => \Modules\Post\Models\Post::all()->random()->id,
            'parent_id' => null
        ]);

        // create reply on a comment
        Comment::create([
            'content' => 'Great comment',  
            'created_by' => \Modules\User\Models\User::all()->random()->id,
            'post_id' => \Modules\Post\Models\Post::all()->random()->id,
            'parent_id' => \Modules\Comment\Models\Comment::all()->random()->id
        ]);
    }
}
