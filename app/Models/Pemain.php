<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
{
    protected $table = 'pemain';
    protected $primaryKey = 'id_pemain';

    protected $fillable = [
        'gambar',
        'nama_pemain',
        'cabang_olahraga',
        'klub',
        'usia',
    ];
}
