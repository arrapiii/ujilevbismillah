<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petakerawanan extends Model
{
    use HasFactory;

    protected $table = "petakerawanans";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function jenispetakerawanan(){
        return $this->hasMany(JenisPetaKerawanan::class);
        // one to many
    }
}