<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Guru extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "gurus";
    protected $primaryKey = "id";
    protected $fillable = [
        'nip',
        'foto',
        'namaguru',
        'agama',
        'tempatlahir',
        'tanggallahir',
        'jeniskelamin',
        'email',
        'password',
    ];

    // protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function kelas(){
        return $this->hasMany(Kelas::class);
         // many to many 
        // misalnya setiap postingan milik 1 pengguna
    }

    public function user(){
        return $this->belongsTo(User::class);
         // many to many 
        // misalnya setiap postingan milik 1 pengguna
    }

    public function konseling_bk(){
        return $this->hasMany(Konseling_bk::class);
        // one to many
    }
    
    public function kerawanan()
    {
        return $this->hasMany(Kerawanan::class);
        // one to many
    }
}
