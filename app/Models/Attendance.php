<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Attendance extends Model
{
    use HasApiTokens, SoftDeletes;
    
    protected $fillable = ['date', 'check_in', 'check_out', 'status', 'late_reason', 'employee_id'];
    protected $table = 'employees';
    protected $primaryKey = 'id';

}
