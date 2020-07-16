<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisDonatur extends Model
{
    protected $table = 'jenisdonaturs';
    protected $fillable = ['jns_donatur'];

    public function anggota()
    {
    	return $this->belongsTo(Anggota::class);
    }
}
