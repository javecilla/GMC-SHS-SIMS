<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\EmployeeAccount;
use App\Models\StudentEnrollment;
use App\Models\Room;
use App\Models\ScheduleEnrollment;
use App\Models\SectionEnrollment;
use App\Models\FacultyEvaluation;

class Campus extends Model
{
    use HasFactory;

    protected $table = 'campuses';

    protected $fillable = [
        'campus_name',
        'campus_code',
        'deped_school_id',
        'shs_permit_no',
        'full_address',
        'contact_no',
    ];

    public $timestamps = true;

    public function employeeAccounts(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Campus and EmployeeAccount models.
         *
         * This relationship indicates that each Campus can be assigned for many faculty accounts.
         * The foreign key 'campus' in the employee_accounts table references the primary key (id) of this campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->hasMany(EmployeeAccount::class, 'campus');
    }

    public function studentEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Campus and StudentEnrollment models.
         *
         * This relationship indicates that each Campus can be assigned for many student enrollments.
         * The foreign key 'campus' in the student_enrollments table references the primary key (id) of this campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentEnrollment::class, 'campus');
    }

    public function rooms(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Campus and Room models.
         *
         * This relationship indicates that each Campus can be assigned for many rooms.
         * The foreign key 'campus' in the rooms table references the primary key (id) of this campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(Room::class, 'campus');
    }

    public function scheduleEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Campus and ScheduleEnrollment models.
         *
         * This relationship indicates that each Campus can be assigned for many schedule enrollments.
         * The foreign key 'campus' in the schedule_enrollments table references the primary key (id) of this campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(ScheduleEnrollment::class, 'campus');
    }

    public function sectionEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Campus and SectionEnrollment models.
         *
         * This relationship indicates that each Campus can be assigned for many section enrollments.
         * The foreign key 'campus' in the section_enrollments table references the primary key (id) of this campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SectionEnrollment::class, 'campus');
    }

    public function facultyEvaluations(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Campus and FacultyEvaluation models.
         *
         * This relationship indicates that each Campus can be assigned for many faculty evaluations.
         * The foreign key 'campus' in the faculty_evaluations table references the primary key (id) of this campuses table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(FacultyEvaluation::class, 'campus');
    }
}
