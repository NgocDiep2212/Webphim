<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitiet_Duyetphim extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'chitiet_duyetphim';

    public function movie(){
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }
    public function activeMovie(){
        return $this->belongsTo(Movie::class, 'movie_id', 'id')->where('movies.status',1);
    }
    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
