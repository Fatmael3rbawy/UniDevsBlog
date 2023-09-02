<?php

namespace Modules\Comment\Repositories;

use App\Repositories\BaseRepository;
use Modules\Comment\Models\Comment;

class CommentRepository extends BaseRepository
{
   

    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
     
   
}