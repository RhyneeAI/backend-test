<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Payroll extends Model
{
    use HasApiTokens, SoftDeletes;
    
    protected $fillable = ['period_month', 'period_year', 'gross_salary', 'deduction', 'net_salary', 'notes', 'status', 'generated_by', 'employee_id'];
    protected $table = 'payrolls';
    protected $primaryKey = 'id';

    /**
     * Get the user that owns the Payroll
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by', 'id');
    }

    /**
     * Get the employee that owns the Payroll
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
