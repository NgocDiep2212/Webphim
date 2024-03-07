<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuCau extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'yeucau';

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id')->where('users.status',1);
    }
}
