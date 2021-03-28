<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'judul_laporan',
        'id_user',
        'isi_laporan',
        'tgl_pengaduan',
        'lokasi_kejadian',
        'foto_laporan',
        'instansi_tujuan',
        'kategori_laporan',
        'status',
    ];

    public function statuslaporan()
    {
        return $this->hasMany('App\Status', 'id', 'status');
    }

    public function laporankategori()
    {
        return $this->hasMany('App\KategoriLaporan', 'id', 'kategori_laporan');
    }

    public function tanggapan()
    {
        return $this->belongsTo('App\Tanggapan');
    }
}
