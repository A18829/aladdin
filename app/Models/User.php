<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

   

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function permissions()
    {
        return $this->hasMany(UserPermission::class);
    }


     public $timestamps = false;

    // Đặt tên bảng nếu khác với tên mặc định
    protected $table = 'users';

    // Nếu bạn có cột tự động tăng, không cần khai báo
    protected $fillable = ['id','name','email','level', 'status','password'];
}
