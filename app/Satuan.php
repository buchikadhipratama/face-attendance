<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuans';
    // protected $fillable = ['nama_satuan','terkecil','isi','sub_satuan'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'satuan_id');
    }
}
