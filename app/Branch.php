<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'branches';
    protected $fillable = ['branch_name','alamat','phone','status'];

    public function attendance()
    {
        return $this -> hasMany(Attendance::class, 'branch_id');
    }

}
