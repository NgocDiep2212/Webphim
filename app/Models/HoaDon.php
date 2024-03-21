<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HoaDon extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'hoadonvip';

    public function goivip(){
        return $this->belongsTo(GoiVip::class,'goi_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
