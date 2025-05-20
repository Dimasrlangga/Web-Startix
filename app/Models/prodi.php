<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    /** @use HasFactory<\Database\Factories\ProdiFactory> */
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function dataprodi()
    {
        return $this->hasmany(mahasiswa::class, 'id');
    }
}
