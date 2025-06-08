<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\EmployeeAccount;

class EmployeePosition extends Model
{
    use HasFactory;

    protected $table = 'employee_positions';

    protected $fillable = [
        'position_name'
    ];

    public $timestamps = true;

    public function employeeAccounts(): HasMany
    {
        /**
         * Defines a one-to-many relationship between EmployeePosition and EmployeeAccount models.
         *
         * This relationship indicates that each EmployeePosition can be assigned to multiple employee accounts.
         * The foreign key 'position' in the employee_accounts table references the primary key (id) of this employee_positions table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->hasMany(EmployeeAccount::class, 'position');
    }
}
