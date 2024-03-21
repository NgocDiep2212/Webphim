<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;

    // public function movie(){
    //     //tra ve phim sap xep theo id(phim moi o truoc)
    //     return $this->hasMany(Movie::class)->orderBy('id','DESC');
        
    // }
    public function movie(){
        return $this->belongsToMany(Movie::class, 'movie_category', 'movie_id', 'category_id');
        
    }
    //ep
    // public function server(){
    //     return $this->belongsToMany(Linkmovie::class, 'episode_server','episode_id','server_id');
    // }

    public function movie_active_duyet(){
        //tra ve phim sap xep theo id(phim moi o truoc)
        return $this->movie()->where('movies.status',1)->where('movies.duyet',1);
        
    }
}
