<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;

    protected $table = "wali_kelas";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
         // many to many 
        // misalnya setiap postingan milik 1 pengguna
    }

    public function kelas(){
        return $this->hasOne(kelas::class);
        // one to one
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
