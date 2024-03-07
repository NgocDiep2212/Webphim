<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode_Server extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'episode_server';
    //tap phim thuoc 1 server
    public function server(){
        return $this->belongsTo(Server::class, 'id', 'id_server');
    }
}
