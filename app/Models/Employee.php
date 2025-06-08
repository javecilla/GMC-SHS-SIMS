<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\GenderEnum;
use App\Models\EmployeeAccount;
use App\Models\User;
use App\Models\StudentGrade;
use App\Models\ScheduleEnrollment;
use App\Models\SectionEnrollment;
use App\Models\EvaluationQuestion;
use App\Models\FacultyEvaluation;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_no',
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'gender',
        'birthdate',
        'birthplace',
        'contact_no',
        'nationality',
        'religion',
        'house_address',
        'barangay',
        'municipality',
        'province',
        'postal_code',
        'account',
    ];

    public $timestamps = true;

    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
            'gender' => GenderEnum::class,
        ];
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}" . ($this->extension_name ? " {$this->extension_name}" : ''));
    }

    public function account(): BelongsTo
    {
        /**
         * Defines a one-to-one relationship between Employee and User models.
         *
         * This relationship indicates that each Employee belongs to a single User account.
         * The foreign key 'account' in this employees table references the primary key (id) of the users table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        return $this->belongsTo(User::class, 'account');
    }

    public function employeeAccounts(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Employee and EmployeeAccount models.
         *
         * This relationship indicates that each Employee can have multiple EmployeeAccount records.
         * The foreign key 'employee' in the employee_accounts table references the primary key (id) of this employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->hasMany(EmployeeAccount::class, 'employee');
    }
    
    public function encodedGrades(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Employee (faculty) and StudentGrade models.
         *
         * This relationship indicates that each Employee (faculty) can encode multiple student grade records.
         * The foreign key 'encoded_by' in the student_grades table references the primary key (id) of this employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentGrade::class, 'encoded_by');
    }

    public function facultySchedules(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Employee (faculty) and ScheduleEnrollment models.
         *
         * This relationship indicates that each Employee (faculty) can have multiple schedules records.
         * The foreign key 'faculty' in the schedule_enrollments table references the primary key (id) of this employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(ScheduleEnrollment::class, 'faculty');
    }

    public function loadedSchedules(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Employee (academic coordinator) and ScheduleEnrollment models.
         *
         * This relationship indicates that each Employee (academic coordinator) can load multiple schedule records to faculty.
         * The foreign key 'loaded_by' in the schedule_enrollments table references the primary key (id) of this employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(ScheduleEnrollment::class, 'loaded_by');
    }

    public function advisorySections(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Employee (faculty) and SectionEnrollment models.
         *
         * This relationship indicates that each Employee (faculty) can be an adviser for multiple sections.
         * The foreign key 'adviser' in the section_enrollments table references the primary key (id) of this employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SectionEnrollment::class, 'adviser');
    }

    public function addedEvaluationQuestions(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Employee (e.g., administration, academic coordinator) and EvaluationQuestion models.
         *
         * This relationship indicates that each Employee (e.g., administration, academic coordinator) can create multiple evaluation question records.
         * The foreign key 'added_by' in the evaluation_questions table references the primary key (id) of this employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(EvaluationQuestion::class, 'added_by');
    }

    public function facultyEvaluations(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Employee and FacultyEvaluation models.
         *
         * This relationship indicates that each Employee (faculty) can be evaluate by multiple students.
         * The foreign key 'faculty' in the faculty_evaluations table references the primary key (id) of this employees table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(FacultyEvaluation::class, 'faculty');
    }
}
