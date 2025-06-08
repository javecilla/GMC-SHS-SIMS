<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\StudentEnrollment;
use App\Models\SubjectEnrollment;
use App\Models\StudentGrade;
use App\Models\ScheduleEnrollment;
use App\Models\SectionEnrollment;
use App\Models\FacultyEvaluation;

class SchoolYear extends Model
{
    use HasFactory;

    protected $table = 'school_years';

    protected $fillable = [
        'school_year_name',
        'is_current',
    ];

    public $timestamps = true;

    public function studentEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SchoolYear and StudentEnrollment models.
         *
         * This relationship indicates that each SchoolYear record can be assigned to many StudentEnrollment.
         * The foreign key 'school_year' in the student_enrollments table references the primary key (id) of this school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentEnrollment::class, 'school_year');
    }

    public function subjectEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SchoolYear and SubjectEnrollment models.
         *
         * This relationship indicates that each SchoolYear record can be assigned to many SubjectEnrollment.
         * The foreign key 'school_year' in the subject_enrollments table references the primary key (id) of this school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SubjectEnrollment::class, 'school_year');
    }

    public function studentGrades(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SchoolYear and StudentGrade models.
         *
         * This relationship indicates that each SchoolYear record can be assigned to many StudentGrade.
         * The foreign key 'school_year' in the student_grades table references the primary key (id) of this school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentGrade::class, 'school_year');
    }

    public function scheduleEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SchoolYear and ScheduleEnrollment models.
         *
         * This relationship indicates that each SchoolYear record can be assigned to many ScheduleEnrollment.
         * The foreign key 'school_year' in the schedule_enrollment table references the primary key (id) of this school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(ScheduleEnrollment::class, 'school_year');
    }

    public function sectionEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SchoolYear and SectionEnrollment models.
         *
         * This relationship indicates that each SchoolYear record can be assigned to many SectionEnrollment.
         * The foreign key 'school_year' in the section_enrollment table references the primary key (id) of this school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SectionEnrollment::class, 'school_year');
    }

    public function facultyEvaluations(): HasMany
    {
        /**
         * Defines a one-to-many relationship between SchoolYear and FacultyEvaluation models.
         *
         * This relationship indicates that each SchoolYear record can be assigned to many FacultyEvaluation.
         * The foreign key 'school_year' in the faculty_evaluations table references the primary key (id) of this school_years table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(FacultyEvaluation::class, 'school_year');
    }
}