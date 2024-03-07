<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitiet_PQ extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'chitiet_phanquyen';
    public function admin(){
        return $this->belongsTo(Admin::class, 'id_admin', 'id');
    }
    public function nhanvien(){
        return $this->belongsTo(Admin::class, 'id_nhanvien', 'id');
    }
    public function role(){
        return $this->belongsTo(Role::class,'cv_nhanvien','role');
    }
}
