<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';

    protected $guarded = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token','id_role'
    ];

    public function role(){
        return $this->belongsTo(Role::class,'id_role','role');
    }
    public function nguoithem(){
        return $this->belongsTo(Chitiet_PQ::class, 'id', 'id_nhanvien');
    }
    public function nguoiThemPhim(){
        return $this->belongsTo(Chitiet_ThemPhim::class, 'id', 'admin_id');
    }
}

