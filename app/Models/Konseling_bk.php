<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konseling_bk extends Model
{
    use HasFactory;

    protected $table = "konseling_bks";
    protected $primaryKey = "id";
    protected $guarded = [];


    public function guru(){
        return $this->belongsTo(Guru::class);
         // many to many 
        // misalnya setiap postingan milik 1 pengguna
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class);
         // many to many 
        // misalnya setiap postingan milik 1 pengguna
    }

    public function wali_kelas(){
        return $this->belongsTo(WaliKelas::class , 'walas_id');
         // many to many 
        // misalnya setiap postingan milik 1 pengguna
    }

    public function layanan_bk(){
        return $this->belongsTo(Layanan_bk::class, 'layanan_id');
         // many to many 
        // misalnya setiap postingan milik 1 pengguna
    }
    


}
