<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuThich extends Model
{
    protected $table = 'yeuthich';
    public $timestamps = false;
    use HasFactory;

    public function movie(){
        return $this->belongsTo(Movie::class, 'movie_id', 'id')->where('movies.status',1);
    }

    public function movie_sum(){
        return $this->movie();
    }
}
