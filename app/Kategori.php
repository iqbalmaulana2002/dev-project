<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_barang';
    public $primaryKey = 'id_kategori';
    public $fillable = ['nama_kategori'];

    public function Barang(){
        return $this->belongsToMany('App\Barang');
    }

    public function pinjam(){
        return $this->hasMany('App\Pinjam', 'id_pinjam');
    }

    public function kembali(){
        return $this->hasMany('App\Kembali', 'id_kembali');
    }

    public function temporari(){
        return $this->hasMany('App\Temporari', 'id_temp');
    }
}
