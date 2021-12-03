<?php

namespace App;

use App\Satuan;
use App\Category;
use App\BarangHarga;
use App\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';




    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function barangharga()
    {
        return $this->hasOne(BarangHarga::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id');
    }

}
