<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function activeCategory(){
        return $this->category()->where('categories.status',1);
    }
    // public function activeMovieCategory(){
    //     return $this->activeCategory()->where('movies.status',1);
    // }
    public function country(){
        return $this->belongsTo(Country::class,'country_id')->where('status',1);
    }
    public function activeCountry(){
        return $this->country()->where('countries.status',1);
    }
    public function genre(){
        return $this->belongsTo(Genre::class,'genre_id')->where('status',1);
    }
    public function activeGenre(){
        return $this->genre()->where('genres.status',1);
    }
    //1 phim nhieu the loai
    public function movie_genre(){
        return $this->belongsToMany(Genre::class,'movie_genre', 'movie_id', 'genre_id');
    }
    public function activeMovieGenre(){
        return $this->movie_genre()->where('genres.status',1);
    }
    //1 phim nhieu danh mục
    public function movie_category(){
        return $this->belongsToMany(Category::class,'movie_category', 'movie_id', 'category_id');
    }

    public function activeMovieCategory(){
        return $this->movie_category()->where('categories.status',1);
    }

    //1 phim nhieu danh mục
    // public function movie_cate(){
    //     return $this->belongsTo(Movie_Category::class, 'id', 'movie_id');
    // }

    //1 phim nhieu the loai
    public function movie_cate(){
        return $this->belongsToMany(Category::class,'movie_category', 'movie_id', 'category_id');
    }

    public function activeMovieCate(){
        return $this->movie_cate()->where('categories.status',1)->where('movie.status',1); 
    }
    //1 phim nhieu tap
    public function episode(){
        return $this->hasMany(Episode::class);
    }
    public function activeMovieEpisodeServer(){
        return $this->episode()->whereHas('activeEpisodeServer');
    }

    public function movie_history(){
        return $this->belongsTo(Chitiet_Themphim::class, 'id', 'movie_id');
    }

    
}
