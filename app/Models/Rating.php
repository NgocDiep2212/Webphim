<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    public $timestamps = false;
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function movie(){
        return $this->belongsTo(Movie::class,'movie_id','id');
    }
}
