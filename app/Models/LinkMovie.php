<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkMovie extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'linkmovie';
    protected $filtable = [
        'title','description','status'
    ];
    
    public function episode(){
        return $this->belongsTo(Episode_Server::class,'id','server_id');
    }
    public function sodes(){
        return $this->belongsToMany(Episode::class,'episode_server','server_id','episode_id');
    }
    public function activeEpisodeServer2(){
        return $this->episode()->where('linkmovie.status',1);
    }
}
