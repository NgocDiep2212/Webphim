<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function Movie(){
        //tra ve phim sap xep theo id(phim moi o truoc)
        return $this->hasMany(Movie::class)->orderBy('id','DESC');
        
    }
}
