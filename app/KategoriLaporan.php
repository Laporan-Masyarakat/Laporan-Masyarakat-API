<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriLaporan extends Model
{
    protected $fillable = ['kategori_laporan'];

    public function laporan()
    {
        return $this->belongsTo('App\Laporan');
    }
}
