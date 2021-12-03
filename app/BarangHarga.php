<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangHarga extends Model
{
    use HasFactory;

    protected $table = 'barang_harga';

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function satuan()
    {
        return $this->hasMany(Satuan::class, 'satuan_id');
    }
}
