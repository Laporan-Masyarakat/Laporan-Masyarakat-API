<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $fillable = ['id_pengaduan', 'isi_tanggapan', 'id_user'];

    public function id_pengaduan()
    {
        return $this->hasMany('App\Laporan', 'id', 'id_pengaduan');
    }
}
