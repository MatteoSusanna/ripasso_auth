<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['nome', 'slug', 'content', 'cover', 'vote', 'visionato'];

    public function categories(){
        return $this->belongsToMany('App\Category');
    }
}
