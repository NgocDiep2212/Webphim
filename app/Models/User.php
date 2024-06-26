<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'users';
    protected $connection = 'mysql';
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hoadon(){
        return $this->belongsTo(HoaDon::class, 'id', 'user_id');
    }

    public function chuaDenHan()
    {
        return $this->belongsTo(HoaDon::class, 'id', 'user_id')->where('expired_at', '>=', Carbon::now()->format('Y-m-d'));
    }

    public function is_admin()
    {
        return false;
    }
}
