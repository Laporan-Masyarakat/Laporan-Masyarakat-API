<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'judul_laporan',
        'isi_laporan',
        'tgl_pengaduan',
        'lokasi_kejadian',
        'foto_laporan',
        'instansi_tujuan',
        'kategori_laporan',
        'status',
    ];

    public function status()
    {
        return $this->hasMany('App\Status', 'id', 'status');
    }
}
