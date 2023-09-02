<?php

namespace Modules\Post\Repositories;

use App\Repositories\BaseRepository;
use Modules\Post\Models\Post;

class PostRepository extends BaseRepository
{
   

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
     
   function checkifUserHasPost($post_id, $user_id) {
     return $this->model->where('created_by',$user_id)->find($post_id);


   }
}