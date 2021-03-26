<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'nik',
        'tgl_pengaduan',
        'isi_laporan',
        'foto_laporan',
        'status',
    ];
}
