<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['kategori'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
