<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Category extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'movie_category';

    public function category(){
        return $this->belongsTo(Category::class, 'id', 'id_category');
    }
}
