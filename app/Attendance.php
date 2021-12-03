<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = ['id','user_id','date','start','finish','attendance_info_id','branch_id', 'working_hours', 'images'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function attendance_info()
    {
        return $this->belongsTo(AttendanceInfo::class, 'attendance_info_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
