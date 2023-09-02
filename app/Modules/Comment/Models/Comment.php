<?php

namespace Modules\Comment\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Modules\Post\Models\Post;
use Modules\User\Models\User;

class Comment extends Model
{
    // use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'post_id','created_by','parent_id',
    ];

    function user()  {
        return $this->belongsTo(User::class,'created_by');
    }

    function post() {
        return $this->belongsTo(Post::class);
    }
   
    function parent() {
        return $this->belongsTo(Comment::class ,'parent_id');
    }

    function replies() {
        return $this->hasMany(Comment::class ,'parent_id');
        
    }
}
