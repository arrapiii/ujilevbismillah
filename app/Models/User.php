<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";
    protected $primaryKey = "id";
    // protected $guarded = [];

    protected $fillable = [
        'name',
        'nisn_nip',
        'level',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function guru(){
        return $this->hasOne(Guru::class);
        // one to one
    }

    public function siswa(){
        return $this->hasOne(siswa::class);
        // one to one
    }

    public function walikelas(){
        return $this->hasOne(walikelas::class);
        // one to one 
    }

    
}