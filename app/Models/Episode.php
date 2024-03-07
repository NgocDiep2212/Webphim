<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public function movie(){
        return $this->belongsTo(Movie::class, 'movie_id');
    }
    //1 phim nhieu episode_server
    public function server(){
        return $this->belongsToMany(Linkmovie::class, 'episode_server','episode_id','server_id');
    }
    public function activeServer(){
        return $this->server()->where('linkmovie.status',1);
    }
    public function episode_server(){
        return $this->belongsTo(Episode_Server::class,'id','episode_id');
    }
    public function activeEpisodeServer(){
        return $this->server()->whereHas('activeEpisodeServer2');
    }
    public function countActiveEpisodeServer()
    {
        $activeEpisodeServers = $this->activeEpisodeServer()->get();

        return count($activeEpisodeServers);
    }
    
}
