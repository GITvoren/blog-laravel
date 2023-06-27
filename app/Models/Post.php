<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Establishes that this 'posts' table has a relationship with the 'users' table
    // We can later on call $posts->user to get the user that authored a specific post
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function likes(){
        return $this->hasMany('App\Models\PostLike');
    }

    public function comments(){
        return $this->hasMany('App\Models\PostComments');
    }
}