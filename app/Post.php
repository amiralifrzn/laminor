<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public function category()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
