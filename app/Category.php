<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['nome'];

    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
