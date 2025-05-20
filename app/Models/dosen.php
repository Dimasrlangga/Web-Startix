<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dosen extends Model
{
    /** @use HasFactory<\Database\Factories\DosenFactory> */
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function datajurusan()
    {
        return $this->belongsto(jurusan::class, 'jurusan_id');
    }
}
