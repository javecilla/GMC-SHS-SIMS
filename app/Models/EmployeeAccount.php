<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\Campus;

class EmployeeAccount extends Model
{
    use HasFactory;

    protected $table = 'employee_accounts';

    //protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'employee', 'position', 'campus', 'is_default_account',
    ];

    public $timestamps = true;

    public function employee(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between EmployeeAccount and Employee models.
         *
         * This relationship indicates that each EmployeeAccount is owned by one Employee.
         * The foreign key 'employee' in this employee_accounts table references the primary key (id) of the employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Employee::class, 'employee');
    }

    public function position(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between EmployeeAccount and EmployeePosition models.
         *
         * This relationship indicates that each EmployeeAccount has a EmployeePosition.
         * The foreign key 'position' in this employee_accounts table references the primary key (id) of the employee_positions table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(EmployeePosition::class, 'position');
    }

    public function campus(): BelongsTo
    {
        /**
         * Defines a many-to-one relationship between EmployeeAccount and Campus models.
         *
         * This relationship indicates that each EmployeeAccount has Campus associated.
         * The foreign key 'campus' in this employee_accounts table references the primary key (id) of the campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(Campus::class, 'campus');
    }
}
