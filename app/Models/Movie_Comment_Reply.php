<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Comment_Reply extends Model
{
    protected $table = 'movie_comment_replies';
    public $timestamps = false;
    use HasFactory;

    public function user_cmt(){
        return $this->belongsTo(User::class,'user_cmt_id','id');
    }
    public function user_reply(){
        return $this->belongsTo(User::class,'user_reply_id','id');
    }
    public function movie_comment(){
        return $this->belongsTo(Movie_Comment::class, 'cmt_id', 'id');
    }
}
