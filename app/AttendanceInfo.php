<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceInfo extends Model
{
    use HasFactory;
    protected $table = 'attendance_info';

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'attendance_info_id', 'id');
    }
}
