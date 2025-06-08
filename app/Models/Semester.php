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

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester_name',
        'semester_code',
    ];

    public $timestamps = true;

    public function studentEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Semester and StudentEnrollment models.
         *
         * This relationship indicates that each Semester record can be assigned to many StudentEnrollment.
         * The foreign key 'semester' in the student_enrollments table references the primary key (id) of this semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentEnrollment::class, 'semester');
    }

    public function subjectEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Semester and SubjectEnrollment models.
         *
         * This relationship indicates that each Semester record can be assigned to many SubjectEnrollment.
         * The foreign key 'semester' in the subject_enrollments table references the primary key (id) of this semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SubjectEnrollment::class, 'semester');
    }

    public function studentGrades(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Semester and StudentGrade models.
         *
         * This relationship indicates that each Semester record can be assigned to many StudentGrade.
         * The foreign key 'semester' in the student_grades table references the primary key (id) of this semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(StudentGrade::class, 'semester');
    }

    public function scheduleEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Semester and ScheduleEnrollment models.
         *
         * This relationship indicates that each Semester record can be assigned to many ScheduleEnrollment.
         * The foreign key 'semester' in the schedule_enrollments table references the primary key (id) of this semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(ScheduleEnrollment::class, 'semester');
    }

    public function sectionEnrollments(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Semester and SectionEnrollment models.
         *
         * This relationship indicates that each Semester record can be assigned to many SectionEnrollment.
         * The foreign key 'semester' in the section_enrollments table references the primary key (id) of this semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(SectionEnrollment::class, 'semester');
    }

    public function facultyEvaluations(): HasMany
    {
        /**
         * Defines a one-to-many relationship between Semester and FacultyEvaluation models.
         *
         * This relationship indicates that each Semester record can be assigned to many FacultyEvaluation.
         * The foreign key 'semester' in the faculty_evaluations table references the primary key (id) of this semesters table.
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        return $this->HasMany(FacultyEvaluation::class, 'semester');
    }
}