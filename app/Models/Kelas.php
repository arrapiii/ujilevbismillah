<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "Kelas";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function guru(){
        return $this->belongsTo(Guru::class);
         // many to many 
        // misalnya setiap postingan milik 1 pengguna
    }
    public function walikelas(){
        return $this->belongsTo(walikelas::class);
         // many to many 
        // misalnya setiap postingan milik 1 pengguna
    }

    public function siswa(){
        return $this->hasMany(Siswa::class);
        // one to many
    }
}
