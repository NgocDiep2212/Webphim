<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Comment extends Model
{
    protected $table = 'movie_comments';
    public $timestamps = false;
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function movie_comment_reply(){
        return $this->hasMany(Movie_Comment_Reply::class, 'cmt_id', 'id');
    }
}
