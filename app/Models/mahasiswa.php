<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /** @use HasFactory<\Database\Factories\MahasiswaFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'mahasiswas';


    public function dataprodi()
    {
        return $this->belongsto(Prodi::class, 'prodi_id');
    }


    public function datajurusan()
    {
        return $this->belongsto(Jurusan::class, 'jurusan_id');
    }


}
