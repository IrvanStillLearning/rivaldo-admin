<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas'; 
    protected $guarded = ['id'];

    public function tempat_magang(){
        return $this->belongsTo(TempatMagang::class, 'tempat_magang_id', 'id');
    }
}
