<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Department extends Model
{
    use HasApiTokens, SoftDeletes;
    
    protected $fillable = ['name'];
    protected $table = 'employees';
    protected $primaryKey = 'id';

    /**
     * Get the employee associated with the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class, 'foreign_key', 'local_key');
    }
}
