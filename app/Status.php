<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function laporan()
    {
        return $this->belongsTo('App\Laporan');
    }
}
