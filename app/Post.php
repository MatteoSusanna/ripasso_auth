<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['nome', 'slug', 'content', 'cover', 'vote'];

    public function tags(){
        return $this->belongsToMany('App\Category');
    }
}
