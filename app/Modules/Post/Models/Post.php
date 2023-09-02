<?php

namespace Modules\Post\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Modules\Comment\Models\Comment;
use Modules\User\Models\User;

class Post extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'photo','created_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::Deleted(function ($row) {
            if ($row->photo)
                Storage::delete('/public/'.$row->photo);

        });
       
    }

    public function setPhotoAttribute($value)
    {
        if ($value) {
            if (isset($this->attributes['photo']))
                Storage::delete('/public/'.$this->attributes['photo']);
            $img = time() . md5(uniqid()) . "." . $value->guessExtension();
            $path = $value->storeAs('posts', $img, 'public');
            $this->attributes['photo'] = $path;
        }
    }

    function user()  {
        return $this->belongsTo(User::class,'created_by');
    }

    function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id');
        
    }


   
}
